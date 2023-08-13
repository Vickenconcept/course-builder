<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;


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
    //             'messages' => [
    //                 ['role' => 'system', 'content' => 'You are'],
    //                 ['role' => 'user', 'content' => $inputData],
    //             ],
    //         ],
    //     ]);
        
    //     $content = json_decode($response->getBody(), true)['choices'][0]['message']['content'];
        
    //     return $content;
    // }

    public function generateContent($inputData)
    {
        // Use the input data as the cache key
        $cacheKey = 'openai_response_' . md5($inputData);

        // Check if the response is cached
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $url = 'https://api.openai.com/v1/chat/completions';

        $response = $this->httpClient->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are'],
                    ['role' => 'user', 'content' => $inputData],
                ],
            ],
        ]);

        $content = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

        $cacheDuration = 60;
        // Cache the response for a specified duration (in minutes)
        Cache::put($cacheKey, $content, $cacheDuration);

        return $content;
    }
}
