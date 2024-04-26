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
        $startIndex = $request->input('startIndex', 0); 
        $maxResults = $request->input('maxResults', 30); 
        $sortBy = $request->input('sortBy'); 

        $request->session()->put('query', $query);

        $books = $this->bookService->searchBooks($query, $startIndex, $maxResults,$sortBy);

        return view('users.books', compact('books', 'query'));
    }


    public function export(Request $request)
    {
        $query = $request->session()->get('query');
        $startIndex = $request->input('startIndex', 0);
        $maxResults = $request->input('maxResults', 30);

        if ($query) {
            $books = $this->bookService->searchBooks($query, $startIndex, $maxResults);
            return Excel::download(new BookExport($books), 'books.xlsx');
        }
        return back()->with('success', 'No data to be exported');
    }
  

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'category' => 'required',
            'rating' => 'required',
            'author' => 'required',
            'pages' => 'required',
            'published_date' => 'required',
            'infolink' => 'required',
            
        ]);
        
         auth()->user()->book()->create($validatedData);

        return back()->with('success', 'Book save successfully');
    }


    public function show(Book $book)
    {
        $$user = Auth::user();
            $books = $user->books;
        return view('users.book-library', compact('books'));
    }

   
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }

}
