<?php

namespace App\Components;

use GuzzleHttp\Client;

class GetAddressData
{
    public $client;

    /**
     * @param $client
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://catalog.api.2gis.com/']);
    }
}
