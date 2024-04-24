<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KeyWordSearch;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SuggestionController extends Controller
{
    protected $cacheDuration = 60;
    
    public function suggestions(Request $request)
    {
        $defaultQuery = 'kids art book';
        $keyword = $request->input('keyword',$defaultQuery);
    
        $apiKey = env('SERP_API_KEY');

        $apiUrl = 'https://serpapi.com/search.json?engine=google_autocomplete&q=' . urlencode($keyword) . '&client=chrome&hl=en&gl=us&api_key=' . $apiKey;

        $cacheKey = 'book_sugestion_' . md5($keyword);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
    
        $response = Http::get($apiUrl);
        if ($response->ok()) {
            $searchData  = $response->json();
            $keywordSuggestions = $searchData['suggestions'];
            
            $values = [];
            foreach ($keywordSuggestions as $suggestion) {
                $values[] = $suggestion['value'];
            }
            
            Cache::put($cacheKey, $values, $this->cacheDuration);
            return response()->json(['values' => $values]);
        }

        return response()->json(['error' => 'Failed to fetch suggestions'], 500);
    }
}    
