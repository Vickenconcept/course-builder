<?php

namespace App\Http\Controllers;

use App\Models\Courseresearch;
use App\Models\PlatformResearch;
use App\Services\BookService;
use Illuminate\Http\Request;

class ResearchController extends Controller
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
        return view('users.research');
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
        $category = $request->input('category');
        $platform = $request->input('platform');
        $title = $request->input('search_title');
        session(['last_selected_option1' => $platform]);
        session(['last_selected_option2' => $category]);
        // $query = $platform .' '. $category;
        $query = 'books for ' . $title . ' under ' .$category. ' in '. $platform;
        // dd( session('last_selected_option1'));
        // $query = $request->input('query');
        $startIndex = $request->input('startIndex', 0); // Default startIndex is 0
        $maxResults = $request->input('maxResults', 40); // Default maxResults is 30
        
        $books = $this->bookService->searchBooks($query, $startIndex, $maxResults);
        // dd($books);
        return view('users.research', compact('books', 'query','platform'));
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
    public function destroy($id)
    {
       
    }
}
