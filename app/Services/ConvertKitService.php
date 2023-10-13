<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;

// Example of convertkitService service methods
class ConvertKitService
{
    public function getList($apikey){

        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.convertkit.com/v3/forms?api_key='. $apikey);
        // $responseBody = $response->getBody()->getContents();
        $res = json_decode($response->getBody(), true);


        dd($res);
        $converData = [];

        // Iterate over the data and extract IDs and names
        foreach ($res as $form) {
            foreach ($form as $conv) {
                // dd($conv['id']);
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