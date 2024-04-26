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
    public function store( Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'category' => 'required',
            'rating' => 'required',
            'subtitle' => 'required',
            'isbn' => 'required',
            'pages' => 'required',
            'infolink' => 'required',

        ]);

         auth()->user()->courseresearches()->create($validatedData);

        return back()->with('success', 'course added successfully');
    }

   
    public function create(Request $request)
    {
        $defaultQuery = 'kids art book';

        $query = $request->input('query') ?? 'books';
        $startIndex = $request->input('startIndex', 0); 
        $maxResults = $request->input('maxResults', 40);
        $sortBy = $request->input('sortBy'); 
        $filterBy = $request->input('filterBy');
        $rating = (int) $request->input('rating');
        
        $books = $this->bookService->searchBooks($query, $startIndex, $maxResults,$sortBy,$filterBy, $rating);
        $trend = $this->bookService->googleTrend($query);
        $request->session()->put('query', $query);

        return view('users.course-research', compact('books', 'query', 'trend'));
    }

   
    public function edit(Courseresearch $courseresearch)
    {
        return view('users.edit-course');
    }


    public function destroy($id)
    {
        $content = Courseresearch::find($id);
        $content->delete();

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }
}
