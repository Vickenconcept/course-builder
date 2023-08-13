<?php

namespace App\Http\Controllers;

use App\Models\PlatformResearch;
use App\Services\BookService;
use Illuminate\Http\Request;

class PlatformResearchController extends Controller
{

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.users.platform-research');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = $request->input('category');
        $platform = $request->input('platform');
        // $query = $platform .' '. $category;
        $query = 'books for ' . $category . ' in '. $platform;
        // dd($query);
        // $query = $request->input('query');
        $startIndex = $request->input('startIndex', 0); // Default startIndex is 0
        $maxResults = $request->input('maxResults', 40); // Default maxResults is 30
        
        $books = $this->bookService->searchBooks($query, $startIndex, $maxResults);
        // dd($books);
        return view('pages.users.platform-research', compact('books', 'query','platform'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Platformresearch $platformresearch)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platformresearch $platformresearch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platformresearch $platformresearch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platformresearch $platformresearch)
    {
        //
    }
}
