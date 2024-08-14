<?php

namespace App\Http\Controllers;

use App\Components\GetAddressData;
use Illuminate\Http\Request;

class YandexApiController extends Controller
{
    public function getAddressInfo(Request $req)
    {
        $addressData = new GetAddressData();
        $res = $addressData->client->request('GET', '/3.0/items', [
            'query' => [
                'key' => config('app.2gis_api_key'),
                'q' => $req->input('addressName'),
                'fields' => 'items.adm_div',
                'page_size' => 5
            ]
        ]);
        $resArray =json_decode($res->getBody()->getContents(), true);
        $result = ['query' => $req->input('addressName')];
        if ($resArray['meta']['code'] === 404) {
            $result['items'] = 'error';
        }
        else {
            foreach ($resArray['result']['items'] as $item) {
                $result['items'][] = [
                    'district' => $item['adm_div'][count($item['adm_div']) - 1]['name'],
                    'name' => array_key_exists('address_name', $item) ? $item['address_name'] : 'None'
                ];
            }
        }
        return view('welcome', compact('result'));
    }
}
