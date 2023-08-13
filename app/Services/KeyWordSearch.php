<?php

namespace App\Services;


// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KeyWordSearch
{


    protected $baseUrl = 'https://serpapi.com/search.json';
    // protected $apiKey = env('SERP_API_KEY');
    
    public function keyWordSearch($query)
    {

        $url = $this->baseUrl . '?q=' . urlencode($query) . '&location=Austin,+Texas,+United+States&hl=en&gl=us&google_domain=google.com&num=10&source=keyword_data&api_key='.env('SERP_API_KEY');
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
           
            return [$titles,$totla_search];
            };
            return [null, 0]; 

        }


    public function autoComplete($query)
    {
        // $url = $this->baseUrl . '?engine=google_autocompleteq=' . urlencode($query) . '&cp=1&location=Austin,+Texas,+United+States&hl=en&gl=us&google_domain=google.com&num=10&source=keyword_data&api_key=827e17fbbe531f5c030693ac5abb732586873089f7fd7ebecee99332fadc9040';
        $url = 'https://serpapi.com/search.json?engine=google_autocomplete&q='.  urlencode($query) .'&cp=1&client=chrome&hl=en&gl=us&api_key='. $this->apiKey ;
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
}
