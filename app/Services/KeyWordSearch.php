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

        $url = $this->baseUrl . '?q=' . urlencode($query) . '&location=Austin,+Texas,+United+States&hl=en&gl=us&google_domain=google.com&num=10&source=keyword_data&api_key=' . env('SERP_API_KEY');
        // $url = 'https://serpapi.com/search.html?engine=google_trends&q=Coffee&api_key=827e17fbbe531f5c030693ac5abb732586873089f7fd7ebecee99332fadc9040&search_metadata.prettify_html_file=true';
        $response = Http::get($url);
        // dd($response->json());
        if ($response->ok()) {


            $searches = $response->json();

            // dd($searches);
            // dd($searches);  
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
        // $url = $this->baseUrl . '?engine=google_autocompleteq=' . urlencode($query) . '&cp=1&location=Austin,+Texas,+United+States&hl=en&gl=us&google_domain=google.com&num=10&source=keyword_data&api_key=827e17fbbe531f5c030693ac5abb732586873089f7fd7ebecee99332fadc9040';
        $url = 'https://serpapi.com/search.json?engine=google_autocomplete&q=' .  urlencode($query) . '&cp=1&client=chrome&hl=en&gl=us&api_key=' . $this->apiKey;
        $response = Http::get($url);

        $results = [];
        if ($response->ok()) {

            $search = $response->json();
            // dd($search);
            $suggestion1 = $search['suggestions'][0]['value'];
            $suggestion2 = $search['suggestions'][1]['value'];
            $suggestion3 = $search['suggestions'][2]['value'];

            $result  = [
                'suggestion1',
                'suggestion2',
                'suggestion3',

            ];

            //  return $result;
        }
        return $results = $result;
    }

    public function stats($query)
    {
        $client = new \GuzzleHttp\Client();

        try {
        // $response = $client->request('GET', 'https://seo-keyword-research.p.rapidapi.com/keynew.php?keyword=email%20marketing&country=in', [
        $response = $client->request('GET', 'https://seo-keyword-research.p.rapidapi.com/keynew.php?keyword=' . urlencode($query) . '&country=in', [
            'timeout' => 20,
            'headers' => [
                'X-RapidAPI-Host' => 'seo-keyword-research.p.rapidapi.com',
                // 'X-RapidAPI-Key' => 'd3beb4b3dfmsh3407fbcc0da6bc9p1b5fb8jsn9915cf83e826',
                'X-RapidAPI-Key' => 'e0d7e2fe6amsh4de2c5cde3f2bc3p18c21bjsnf2bed94be3b9',
                
            ],
        ]);

        echo $response->getBody();
        
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle the exception (e.g., log, return an error response)
            echo 'Error occurred: ' . $e->getMessage();
        }
        
    }
    
}
