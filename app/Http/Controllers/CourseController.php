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

    public function __construct()
    {
        // $this->middleware('auth')->except('share');
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
        // $freeLessonCount = $course->settings->free_lessons_count;
        return view('pages.courses.preview', compact('course'));
    }
    public function share($slug)
    {
        // $course = Course::where('slug', $slug)->firstOrFail();
        $course = Course::where('slug', $slug)
            ->firstOrFail();
        $freeCourse = $course->coursesettings->free_lessons_count;
        return view('pages.courses.embed_show', compact('course', 'freeCourse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('pages.courses.edit', compact('course'));
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
    public function destroy($id)
    {
        $content = Course::find($id);
        $content->delete();

        return redirect()->to('course')->with('success', 'Course deleted successfully.');
    }
}
