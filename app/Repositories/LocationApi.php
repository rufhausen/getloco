<?php namespace App\Repositories;

/**
 * Created by PhpStorm.
 * User: gtaylor
 * Date: 3/25/15
 * Time: 6:57 PM
 */

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LocationApi
{
    public function __construct()
    {
        $this->client = new Client([
            'base_url' => \Request::root() . '/api/v1/',
            'defaults' => [
                'query' => [
                    //'key' => '',
                ]
            ]
        ]);
    }

    public function getAll()
    {
        $request = $this->client->get('locations');
        $locations = $request->json()['data'];

        return $locations;
    }

    public function getById($id)
    {
        $response = $this->client->get('locations/' . $id);

        $location = $response->json()['data'];

        return $location;
    }

    public function store($input)
    {
        $this->client->post('locations', [
                'body' => $input
            ]
        );
    }

    public function update($id, $input)
    {
        $this->client->put('locations/' . $id, [
                'body' => $input
            ]
        );
    }

    public function delete($id)
    {
        $this->client->delete($id);
    }
}