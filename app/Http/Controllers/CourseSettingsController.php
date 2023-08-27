<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSettings;
use App\Services\MailChimpService;
use Illuminate\Http\Request;

class CourseSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $mailChimpService;

     public function __construct(MailChimpService $mailChimpService)
     {
         $this->mailChimpService = $mailChimpService;
     }
     
    public function index()
    {
        return view('pages.courses.settings');
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
        $validatedData = $request->validate([
            'free_lessons_count' => 'required',

        ]);

        $user = auth()->user();


        // $course = $user->courses();

        // $user->courses()->first()->courseSettings()->create($validatedData);
        // $user->courses->courseSettings()->updateOrCreate([], $validatedData);
        // foreach ($user->courses as $course) {
        //     $course->courseSettings()->updateOrCreate([], $validatedData);
        // }

        return back()->with('success', 'updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = auth()->user();

        $course = $user->courses()->findorfail($id);
        $freeLessonCount = $course->courseSettings->free_lessons_count;

        $lists = $this->mailChimpService
            ->getAllLists($user
                ->setting->mailchimp_api_key, $user
                ->setting->mailchimp_prefix_key);
                
                // dd($lists->lists[0]->id);

        return view('pages.courses.settings', compact('freeLessonCount', 'id', 'course','lists'));
    }

    public function saveSetting(Request $request, $courseId)
    {
        $list_id = $request->input('list_id');
        
        $user = auth()->user();
        $course = $user->courses()->where('courses.id', $courseId)->update(['list_id' => $list_id]);
        return redirect()->back()->with('success', 'List Updated');


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseSettings $courseSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $courseId)
    {

        $num = $request->input('free_lessons_count');
        $validatedData = $request->validate([
            'free_lessons_count' => 'required',

        ]);

        $newFreeLessonsCount = 9;
        // $course = Course::find($courseId);
        $user = auth()->user();
        $course = $user->courses()->findOrFail($courseId); 

        // $lesson  =$this->lesson->update([
        //     'content' => $this->content,
        // ]);
        // dd($num);

        $course->courseSettings()->update([
            'free_lessons_count' => $num,
        ]);
        return back()->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseSettings $courseSettings)
    {
        //
    }
}
