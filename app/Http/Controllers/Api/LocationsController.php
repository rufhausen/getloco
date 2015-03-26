<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\GeoData;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function __construct(GeoData $geodata)
    {
        \Debugbar::disable();
        $this->geodata = $geodata;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $locations = \App\Location::all();

        $response = [
            'status' => 'ok',
            'data'   => $locations
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = \Request::all();
        $address = implode('+', $input);
        $data = $this->geodata->getData($address)['results'][0];
        //dd($data);
        $formatted_address = $data['formatted_address'];
        $latitude = $data['geometry']['location']['lat'];
        $longitude = $data['geometry']['location']['lng'];

        $location = \App\Location::create(
            [
                'parent_id'         => $input['parent_id'],
                'name'              => $input['name'],
                'street_address'    => $input['street_address'],
                'city'              => $input['city'],
                'state_province'    => $input['state_province'],
                'postal_code'       => $input['postal_code'],
                'formatted_address' => $formatted_address,
                'latitude'          => $latitude,
                'longitude'         => $longitude
            ]
        );

        $response = ['status' => 'ok'];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $location = \App\Location::find($id);
        $parent = \App\Location::find($location->parent_id);
        $children = \App\Location::whereParentId($location->id)->get();

        $response = [
            'status' => 'ok',
            'data'   =>
                [
                    'location' => $location,
                    'parent'   => $parent,
                    'children' => $children
                ]
        ];

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->input();
        $address = implode('+', $input);
        $data = $this->geodata->getData($address)['results'][0];
        $formatted_address = $data['formatted_address'];
        $latitude = $data['geometry']['location']['lat'];
        $longitude = $data['geometry']['location']['lng'];


        $location = \App\Location::find($id);
        if ( ! $location) {
            $response = ['status' => 'not ok', 'message' => 'record not found'];
        }
        else {
            $location->name = $request->input('name');
            $location->parent_id = $request->input('parent_id');
            $location->street_address = $request->input('street_address');
            $location->city = $request->input('city');
            $location->state_province = $request->input('state_province');
            $location->postal_code = $request->input('postal_code');
            $location->formatted_address = $formatted_address;
            $location->latitude = $latitude;
            $location->longitude = $longitude;
            $location->save();

            $response = ['status' => 'ok', 'data' => $location];
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        \App\Location::destroy($id);

        $response = ['status' => 'ok'];

        return response()->json($response);
    }

    public function common()
    {
        //Kludgy
        $id1 = \Request::segment(5);
        $id2 = \Request::segment(6);
        $id1_parents = \App\Location::whereId($id1)->lists('parent_id');
        $id2_parents = \App\Location::whereId($id2)->lists('parent_id');

        if ( ! $id1_parents || ! $id2_parents) {
            $response = ['status' => 'not ok'];
        }
        else {
            $common = array_unique(array_merge($id1_parents, $id2_parents), SORT_REGULAR);

            $data = null;

            if (count($common) == 1) {
                $id = $common[0];

                $data = \App\Location::find($id);
            }

            $response = [
                'status' => 'ok',
                'data'   => $data
            ];
        }

        return response()->json($response);


    }

}
