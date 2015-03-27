<?php namespace App\Services;

/**
 * Created by PhpStorm.
 * User: gtaylor
 * Date: 3/25/15
 * Time: 3:10 PM
 */

use GuzzleHttp\Client;

class GeoData
{

    public function __construct()
    {
        $this->client = new Client([
            'base_url' => 'https://maps.googleapis.com/maps/api/geocode/json',
            'defaults' => [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'query'   => [
                    'key' => env('GOOGLE_API_KEY'),
                ]
            ]
        ]);
    }

    public function getData($address)
    {

        $response = $this->client->get('?address=' . $address);

        if ($response->getStatusCode() == '200')
        {
            return $response->json();
        }
    }

}
