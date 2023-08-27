<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSettings;
use Illuminate\Http\Request;
use App\Services\BookService;
// use App\Exports\BookExport;
// use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{

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
        $user = auth()->user();
        $course = $user->courses()->where('slug', $slug)->firstOrFail();
        // $freeLessonCount = $course->settings->free_lessons_count;
        return view('pages.courses.preview', compact('course'));
    }
    // public function share($slug)
    // {

    //     $course = Course::where('slug', $slug)->firstOrFail();
    //     $freeCourse = $course->coursesettings->free_lessons_count;
    //     return view('pages.courses.embed_show', compact('course', 'freeCourse'));
    // }

    // public function share($slug)
    // {
    //     // Create an instance of the Course model
    //     $courseModel = new Course;

    //     // Create a fresh query builder instance without any global scopes
    //     $query = $courseModel->newQueryWithoutScopes()
    //         ->where('slug', $slug);

    //     // Retrieve the course
    //     $course = $query->firstOrFail();

    //     $freeCourse = $course->coursesettings->free_lessons_count;
    //     return view('pages.courses.embed_show', compact('course', 'freeCourse'));
    // }

    public function share($slug)
    {
        // Create an instance of the Course model
        $courseModel = new Course;

        // Create a fresh query builder instance without any global scopes
        $query = $courseModel->newQueryWithoutScopes()
            ->where('slug', $slug);

        // Retrieve the course
        $course = $query->firstOrFail();

        // Check if the user is authenticated
        $isSubscribed = false;
        $user = auth()->user();
        if ($user) {
            $isSubscribed = $user->courses->contains('id', $course->id);
        }

        $freeCourse = $course->coursesettings->free_lessons_count;

        return view('pages.courses.embed_show', compact('course', 'freeCourse', 'isSubscribed'));
    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the course associated with the user by its ID
        $course = $user->courses()->findOrFail($id);

        return view('pages.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    // $data = $request->validate([
    //     'checkout_option' => 'required|in:email,payment',
    // ]);
    public function update(Request $request, $courseId)
    {

        $user = auth()->user();

        $course = $user->courses()->find($courseId);

        if ($course) {
           $course->courseSettings->checkout_option = $request->input('checkout_option');
           $course->courseSettings->update();

            return redirect()->back()->with('success', ' updated successfully');
        } else {
            return redirect()->route('courses.index')->with('error', 'Course not found');
        }
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $content = Course::find($id);
        $user = auth()->user();

        $course = $user->courses()->find($id);
        $course->delete();

        return redirect()->to('course')->with('success', 'Course deleted successfully.');
    }
   
    
}
