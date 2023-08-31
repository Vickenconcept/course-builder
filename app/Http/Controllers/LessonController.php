<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Lesson $lesson)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $lesson)
    {
        
        $lesson = Lesson::findOrFail($lesson);
        $newData = $request->input('lesson');
        
        $lesson->update(['title' => $newData]);
        return redirect()->back()->with('success', 'updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($lesson)
    {
        $user = auth()->user();
        $course = $user->courses()->whereHas('lessons', function ($query) use ($lesson) {
            $query->where('lessons.id', $lesson);
        })->first();

        if ($course) {
            $lesson = $course->lessons()->find($lesson);

            if ($lesson) {
                $lesson->delete();
                return redirect()->back()->with('success', 'Lesson deleted successfully.');
            }
        }

        return redirect()->route('course')->with('error', 'Lesson not found.');
    }
}
