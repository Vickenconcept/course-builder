<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Courseresearch;
use Illuminate\Http\Request;
use App\Services\BookService;
// use App\Exports\BookExport;
// use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
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
    public function show($slug)
    {
        // $course = Course::findOrFail($slug); 
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('pages.courses.preview', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id); 

        return view('pages.courses.index', compact('course'));
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
