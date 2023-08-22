<?php

namespace App\Http\Controllers;

use App\Models\Courseresearch;
use Illuminate\Http\Request;
use App\Services\BookService;
// use App\Exports\BookExport;
// use Maatwebsite\Excel\Facades\Excel;

class ScoreController extends Controller
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
        return view('users.course-research');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    // public function export(Request $request)
    // {
    //     // $query = $request->input('query');
    //     $query = $request->session()->get('query');
    //     $startIndex = $request->input('startIndex', 0);
    //     $maxResults = $request->input('maxResults', 30);

    //     $books = $this->bookService->searchBooks($query, $startIndex, $maxResults);

    //     return Excel::download(new BookExport($books), 'books.xlsx');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $defaultQuery = 'kids art book';
        $query = $request->input('query', $defaultQuery);
        $startIndex = $request->input('startIndex', 0); // Default startIndex is 0
        $maxResults = $request->input('maxResults', 30); // Default maxResults is 30
        // dd($defaultQuery);
        
        $books = $this->bookService->searchBooks($query, $startIndex, $maxResults);
        $trend = $this->bookService->googleTrend($query);
        $request->session()->put('query', $query);
        // dd($trend);
        return view('users.course-research', compact('books', 'query', 'trend'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Courseresearch $courseresearch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courseresearch $courseresearch)
    {
        return view('users.edit-course');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courseresearch $courseresearch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courseresearch $courseresearch)
    {
        //
    }
}
