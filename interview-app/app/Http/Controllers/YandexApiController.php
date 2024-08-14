<?php

namespace App\Http\Controllers;

use App\Components\GetAddressData;
use App\Models\UserQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YandexApiController extends Controller
{
    public function getAddressInfo(Request $req)
    {
        $req->validate(['addressName' => [
            'required',
            'bail',
            'min:5'
    ]]);
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
                    'district' => array_key_exists('adm_div', $item) ? $item['adm_div'][count($item['adm_div']) - 1]['name'] : 'None',
                    'name' => array_key_exists('address_name', $item) ? $item['address_name'] : 'None'
                ];
            }
        }

        $validated = \validator(['query' => $req->input('addressName')], ['query' => 'unique:App\Models\UserQuery,query']);
        if ($validated->passes()) {
            UserQuery::create([
                'user_id' => Auth::id(),
                'query' => $req->input('addressName')
            ]);
        }
        return view('welcome', compact('result'));
    }
}
