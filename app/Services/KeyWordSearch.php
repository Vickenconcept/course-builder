<?php

namespace App\Services;


// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ClientException;

class KeyWordSearch
{


    protected $baseUrl = 'https://serpapi.com/search.json';
    // protected $apiKey = env('SERP_API_KEY');

    public function keyWordSearch($query)
    {

        $url = $this->baseUrl . '?q=' . urlencode($query) . '&location=Austin,+Texas,+United+States&hl=en&gl=us&ww_domain=google.com&num=10&source=keyword_data&api_key=' . env('SERP_API_KEY');
        $response = Http::get($url);
        if ($response->ok()) {


            $searches = $response->json();

            $totla_search = $searches['search_information']['total_results'];

            $searches = $searches['organic_results'];
            $titles = array_map(function ($searches) {
                return $searches['title'];
            }, $searches);

            return [$titles, $totla_search];
        };
        return [null, 0];
    }


    public function autoComplete($query)
    {
        $url = 'https://serpapi.com/search.json?engine=google_autocomplete&q=' .  urlencode($query) . '&cp=1&client=chrome&hl=en&gl=us&api_key=' . $this->apiKey;
        $response = Http::get($url);

        $results = [];
        if ($response->ok()) {

            $search = $response->json();
            $suggestion1 = $search['suggestions'][0]['value'];
            $suggestion2 = $search['suggestions'][1]['value'];
            $suggestion3 = $search['suggestions'][2]['value'];

            $result  = [
                'suggestion1',
                'suggestion2',
                'suggestion3',

            ];

        }
        return $results = $result;
    }

    public function stats($query)
    {
        $client = new \GuzzleHttp\Client();

        try {
        $response = $client->request('GET', 'https://seo-keyword-research.p.rapidapi.com/keynew.php?keyword=' . urlencode($query) . '&country=in', [
            'timeout' => 20,
            'headers' => [
                'X-RapidAPI-Host' => 'seo-keyword-research.p.rapidapi.com',
                'X-RapidAPI-Key' =>  env('X_RapidAPI_Key'),
                
            ],
        ]);

        echo $response->getBody();
        
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            echo 'Error occurred: ' . $e->getMessage();
        }
        
    }
    
}
