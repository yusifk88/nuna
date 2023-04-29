<?php

namespace App\Services;

use GuzzleHttp\Client;

class Payswitch
{

    public static function getBalance()
    {
        $client = new Client([
            'base_uri' => 'https://prod.theteller.net/',
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);

        $response = $client->get('merchants/TTM-00007872/balance');

        return collect(json_decode($response->getBody()->getContents()));
    }

}
