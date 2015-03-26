<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LocationApi;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct(LocationApi $location)
    {
        $this->location = $location;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $locations = $this->location->getAll();

        return view('location.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->location->store($request->input());

        return redirect()->to('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $location = $this->location->getById($id);

        return view('location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $location = $this->location->getById($id)['location'];
        $locations = $this->location->getAll();

        return view('location.edit', compact('location','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->location->update($id, $request->except('_token'));

        return redirect()->to('/')->withInfo('updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->location->delete($id);

        return redirect()->back()->withSuccess('Location deleted');
    }

}
