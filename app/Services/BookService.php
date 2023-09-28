<?php

namespace App\Services;


// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class BookService
{

    protected $baseUrl = 'https://www.googleapis.com/books/v1/volumes';
    protected $cacheDuration = 60;

    public function searchBooks($query, $startIndex = 0, $maxResults = 10, $sortBy = null, $filterBy = null , $rating = null)
    {
        $cacheKey = 'book_search_' . md5($query . $startIndex . $maxResults . $sortBy . $filterBy .$rating);

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        $url = $this->baseUrl . '?q=' . urlencode($query) . '&startIndex=' . $startIndex . '&maxResults=' . $maxResults;
        $response = Http::get($url);
        // $response = Http::timeout(10)->get($url);
        

        if ($response->ok()) {
            $bookdata = $response->json()['items'] ?? [];
            $books = [];
            foreach ($bookdata as $bookdata) {
                $book = [
                    'thumbnail' => $bookdata['volumeInfo']['imageLinks']['thumbnail'] ?? '',
                    's_thumbnail' => $bookdata['volumeInfo']['imageLinks']['smallThumbnail'] ?? '-',
                    'title' => $bookdata['volumeInfo']['title'] ?? '-',
                    'isbn' => $bookdata['volumeInfo']['industryIdentifiers'][0]['identifier'] ?? '-',
                    'subtitle' => $bookdata['volumeInfo']['subtitle'] ?? '-',
                    'page_count' => $bookdata['volumeInfo']['pageCount'] ?? '-',
                    'description' => $bookdata['volumeInfo']['description'] ?? '-',
                    'category' => $bookdata['volumeInfo']['categories'][0] ?? '-',
                    'rating' => $bookdata['volumeInfo']['averageRating'] ?? '-',
                    'author' => $bookdata['volumeInfo']['authors'][0] ?? '-',
                    'infoLink' => $bookdata['volumeInfo']['infoLink'] ?? '-',
                    'published_date' => $bookdata['volumeInfo']['publishedDate'] ?? '-',
                    'previewLink' => $bookdata['volumeInfo']['previewLink'] ?? '-',
                    'price' => round(($bookdata['volumeInfo']['pageCount'] ?? 0) / 12),
                    'niche' => $bookData['niche'] ?? '-',
                    'sub-category' => $bookData['sub-category'] ?? '-',
                    'topic' => $bookData['topic'] ?? '-',
                    'duration' => $bookData['duration'] ?? '-',
                ];
                $books[] = $book;
            }
            // dd($books);

            if ($sortBy) {
                $books = collect($books)->sortBy($sortBy);
            }
            if ($filterBy) {
                $books = array_filter($books, function ($book) use ($filterBy) {
                    return $book['category'] === $filterBy;
                });
            }
            if ($rating) {
                $books = array_filter($books, function ($book) use ($rating) {
                    return $book['rating'] === $rating;
                });
            }
            Cache::put($cacheKey, $books, $this->cacheDuration);
            return $books;
        }
    }
    public function googleTrend($query)
    {
        
        $apiKey = env('SERP_API_KEY');
        $url = 'https://serpapi.com/search.json?engine=google_trends&q=' . urlencode($query) . '&data_type=TIMESERIES&api_key=' . $apiKey;
        $response = Http::retry(3, 1000)->get($url);
        // $response = Http::get($url);
        if ($response->ok()) {
            $responseData = $response->json();
            if (isset($response->json()['interest_over_time']['timeline_data']) ) {
                $trendData = $response->json()['interest_over_time']['timeline_data'];
                

                $timelineData = $trendData;

                // Calculate average interest
                $totalInterest = 0;
                $totalValues = count($timelineData);
                
                foreach ($timelineData as $data) {
                    $totalInterest += $data['values'][0]['value'];
                }
                // dd($totalInterest);

                $averageInterest = $totalInterest / $totalValues;

                $peakInterest = 0; // Initialize with a default value
                foreach ($trendData as $entry) {
                    $value = $entry['values'][0]['value'];
                    if ($value > $peakInterest) {
                        $peakInterest = $value;
                    }
                }

                $weightForAverageInterest = 0.6;
                $weightForPeakInterest = 0.5;
                $normalizedAverage = ($averageInterest / 100) * $weightForAverageInterest;
                $normalizedPeak = ($peakInterest / 100) * $weightForPeakInterest;

                $opportunityScore = $normalizedAverage + $normalizedPeak;

                foreach ($trendData as $data) {
                    $datesArray[] = $data['date'];
                    $valuesArray[] = $data['values']['0']['value'];
                }
                $sum = array_sum($valuesArray);
                $totalStudents = ($sum * $sum) - 1000000;
                $totalBooks = 100;
                $average = $sum / $totalBooks + 10;
                // dd($average);

                $combinedArray = [
                    'dates' => $datesArray,
                    'searchVolumes' => $valuesArray,
                    'averagePrice' => $average,
                    'totalStudents' => $totalStudents,
                    'opportunityScore' => $opportunityScore,
                    'courseNum' => $totalInterest,
                ];
                return $combinedArray;
            }else{

                return "Data not found!";
            }
        }
        return 'no result for this search';
    }
}
