<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Exports\BookExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Http;

class BookController extends Controller
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
        return view('users.books');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $defaultQuery = 'kids art book';
        $query = $request->input('query', $defaultQuery);
        $startIndex = $request->input('startIndex', 0); // Default startIndex is 0
        $maxResults = $request->input('maxResults', 30); // Default maxResults is 30

        // Ensure $query is set in the session
        $request->session()->put('query', $query);

        // Fetch books based on the provided query
        $books = $this->bookService->searchBooks($query, $startIndex, $maxResults);

        // Pass the data to the view
        return view('users.books', compact('books', 'query'));
    }


    public function export(Request $request)
    {
        // $query = $request->input('query');
        $query = $request->session()->get('query');
        $startIndex = $request->input('startIndex', 0);
        $maxResults = $request->input('maxResults', 30);

        $books = $this->bookService->searchBooks($query, $startIndex, $maxResults);

        return Excel::download(new BookExport($books), 'books.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'

        ]);
        // dd($validatedData);

        $library = auth()->user()->book()->create($validatedData);

        return back()->with('success', 'Book save successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $$user = Auth::user();

        // $books = Book::where('id', $lesson_architect->id)
        //     ->where('user_id', $user->id)
            // ->firstOrFail();
            $books = $user->books;
        return view('users.book-library', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
    }
}
