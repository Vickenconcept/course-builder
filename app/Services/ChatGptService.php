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

    public function generateContent($inputData)
    {
        $url = 'https://api.openai.com/v1/chat/completions';
        // dd($inputData);
        $response = $this->httpClient->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'max_tokens'=>3500,  
                'temperature'=>0.8, 
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a knowledgeable assistant that provides detailed explanations about topics.'],
                    ['role' => 'user', 'content' => $inputData],
                ],
                // 'stream' => True,
            ],
        ]);

        $content = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

        // dd($content);
        return $content;
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
