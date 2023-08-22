<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;
use App\Services\KeyWordSearch;
use App\Services\BookService;


class SearchController extends Controller
{

    protected $keyWordSearch;
    protected $bookService;

    public function __construct(KeyWordSearch $keyWordSearch,BookService $bookService)
    {
        $this->keyWordSearch = $keyWordSearch;
        $this->bookService = $bookService;
    }

    public function index()
    {
        return view('users.search');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $query = $request->input('query');

        
        $result = $this->keyWordSearch->keyWordSearch($query);
        // $stats = $this->keyWordSearch->stats($query);
        // dd($stats);
        $titles = $result[0];
        $total_search = $result[1];
        $trend = $this->bookService->googleTrend($query);
        $request->session()->put('query', $query);
        return view('users.search', compact('titles', 'total_search','trend'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Search $search)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Search $search)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Search $search)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Search $search)
    {
        //
    }
}
