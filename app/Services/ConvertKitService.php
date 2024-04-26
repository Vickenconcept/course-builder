<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;

class ConvertKitService
{
    public function getList($apikey){

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.convertkit.com/v3/forms?api_key='. $apikey);
        $res = json_decode($response->getBody(), true);

        $converData = [];

        foreach ($res as $form) {
            foreach ($form as $conv) {
                $converData[] = [
                    'id' => $conv['id'],
                    'name' => $conv['name']
                ];
            }
        }
        return $converData;
    }
    public function addEmail($apiKey, $formId, $email)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.convertkit.com/v3/forms/'.$formId.'/subscribe', [
            'headers' => [
                "Content-Type" => 'application/json, charset=utf-8',
            ],
            'json' => [
                "api_key" => $apiKey,
                "email"=> $email
            ]
        ]);
        $responseBody = $response->getBody()->getContents();
        return $responseBody;
    }
}