<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;


class ChatGptService
{
    protected $httpClient;
    protected $apiKey;


    public function __construct()
    {
        $this->httpClient = new Client();
        $this->apiKey = env('OPENAI_API_KEY');
    }

    // public function generateContent($inputData)
    // {

    //     $url = 'https://api.openai.com/v1/chat/completions';
    //     // dd($inputData);
    //     $response = $this->httpClient->post($url, [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . $this->apiKey,
    //             'Content-Type' => 'application/json',
    //         ],
    //         'json' => [
    //             'model' => 'gpt-3.5-turbo',
    //             'max_tokens' => 3500,
    //             'temperature' => 0.8,
    //             'messages' => [
    //                 ['role' => 'system', 'content' => 'You are a knowledgeable assistant that provides detailed explanations about topics.'],
    //                 ['role' => 'user', 'content' => $inputData],
    //             ],
    //         ],
    //     ]);

    //     $content = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

    //     return $content;
    // }

    public function generateContent($inputData)
    {
        $url = 'https://api.openai.com/v1/chat/completions';
        $maxRetries = 3;
        $retryDelay = 5; // seconds

        for ($retry = 0; $retry < $maxRetries; $retry++) {
            try {
                $response = $this->httpClient->post($url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'model' => 'gpt-3.5-turbo',
                        'messages' => [
                            ['role' => 'system', 'content' => 'You are a knowledgeable assistant that provides detailed explanations about topics.'],
                            ['role' => 'user', 'content' => $inputData],
                        ],
                    ],
                ]);

                $content = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

                return $content;
            } catch (ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 429) {
                    // Handle the 429 error (Too Many Requests)
                    if ($retry < $maxRetries - 1) {
                        Log::info("Rate limit exceeded. Retrying in {$retryDelay} seconds.");
                        sleep($retryDelay);
                    } else {
                        Log::error("API request failed: Rate limit exceeded after retries.");
                    }
                } else {
                    // Handle other errors
                    Log::error("API request failed: " . $e->getMessage());
                    break;
                }
            }
        }

        return 'system busy'; 
        // return null; 
    }





    //     public function generateContent($inputData)
    //     {

    //         $cacheKey = 'openai_response_' . md5($inputData);


    //         if (Cache::has($cacheKey)) {
    //             return Cache::get($cacheKey);
    //         }

    //         $url = 'https://api.openai.com/v1/chat/completions';

    //         $response = $this->httpClient->post($url, [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $this->apiKey,
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => [
    //                 'model' => 'gpt-3.5-turbo',
    //                 'messages' => [
    //                     ['role' => 'system', 'content' => 'You are'],
    //                     ['role' => 'user', 'content' => $inputData],
    //                 ],
    //             ],
    //         ]);

    //         $content = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

    //         $cacheDuration = 60;

    //         Cache::put($cacheKey, $content, $cacheDuration);

    //         return $content;
    //     }
}
