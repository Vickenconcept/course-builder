<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;

// Example of GetResponse service methods
class GetResponseService
{
    private $apiKey;
    private $apiBaseUrl = 'https://api.getresponse.com/v3';


    public function createLead($data)
    {
    }
    public function getAudience($apiKey)
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $this->apiBaseUrl . '/campaigns', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Auth-Token' => 'api-key ' . $apiKey,
                ],
            ]);
            dd($response);

            $audiences = json_decode($response->getBody(), true);
            $audienceIds = [];

            foreach ($audiences as $audience) {
                $audienceId = $audience["campaignId"];
                $name = $audience["name"];
                // Store the audience ID in the array
                $audienceIds[] = [
                    'audienceId' => $audienceId,
                    'name' => $name,
                ];
            }
            return $audienceIds;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // echo 'Error: ' . $e->getMessage();

            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorMessage = $response->getBody()->getContents();
           
            if ($statusCode === 400) {
                //
                return null;
            } 
            else {
                // Handle other error codes
                return back()->with('success', 'An error occurred: ' . $e->getMessage());
            }

        }
    }
    public function createContact($apiKey, $audience = null, $name, $email)
    {
        $audiencesEndpoint = '/campaigns';
        $client = new \GuzzleHttp\Client();
       

        try {
            $response = $client->request('POST', $this->apiBaseUrl . '/contacts', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Auth-Token' => 'api-key ' . $apiKey,
                ],

                'json' => [
                    "name" => $name,
                    "email" => $email,
                    "dayOfCycle" => "0",
                    "campaign" => [
                        "campaignId" => $audience
                    ],
                    // "customFieldValues" => [
                    //     [
                    //         "customFieldId" => $customField[1]['customFieldId'],
                    //         "value" => [
                    //             $customField[1]['customFieldValue'] = 'hello'
                    //         ]
                    //     ]
                    // ],
                    "ipAddress" => $this->getIpAddress(),
                  
                ]
            ]);

            $audiences = json_decode($response->getBody(), true);

            return $audiences;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // echo 'Error: ' . $e->getMessage();

            redirect()->back()->with('success', 'Get Response Api key Not configured');
        }
    }

    public function getTags($apiKey)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', $this->apiBaseUrl . '/tags', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Auth-Token' => 'api-key ' . $apiKey,
                ],
            ]);

            $res = json_decode($response->getBody(), true);

            $tagIds = [];

            foreach ($res as $tag) {
                $tagId = $tag["tagId"];
                $name = $tag["name"];
                // Store the tag ID in the array
                $tagIds[] = [
                    'tagId' => $tagId,
                    'name' => $name,
                ];
            }
            return $tagIds;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function getCustomFields($apiKey)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', $this->apiBaseUrl . '/custom-fields', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-Auth-Token' => 'api-key ' . $apiKey,
                ],
            ]);

            $res = json_decode($response->getBody(), true);


            $customFieldsArray = [];

            foreach ($res as $customField) {
                $customFieldId = $customField["customFieldId"];
                $customFieldName = $customField["name"];
                $customFieldValue = $customField["values"];

                // Store customFieldId and customFieldName in the array
                $customFieldsArray[] = [
                    "customFieldId" => $customFieldId,
                    "customFieldName" => $customFieldName,
                    "customFieldValue" => $customFieldValue
                ];
            }

            // Print the resulting array
            return $customFieldsArray;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function updateLead($leadId)
    {
    }
    public function getIpAddress()
    {
        $ip = Request::ip();
        return $ip;
        // $ip now contains the user's IP address
    }
}
