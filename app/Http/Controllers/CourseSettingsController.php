<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSettings;
use App\Services\ConvertKitService;
use App\Services\GetResponseService;
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
        try {
            $lists = null;
            $convert = null;
            $getrepsonseAudience = null;
            
            if (optional($user)->setting && optional($user)->setting->mailchimp_api_key && optional($user)->setting->mailchimp_prefix_key) {
                $lists = $this->mailChimpService->getAllLists(optional($user)->setting->mailchimp_api_key, optional($user)->setting->mailchimp_prefix_key);
            }
            
            
            if (optional($user->setting)->convert_api_key) {
                $convertKitService = app(ConvertKitService::class);
                $convert = $convertKitService->getList(optional($user)->setting->convert_api_key);
            }
            // dd(optional($user)->setting);


            if (optional($user->setting)->get_response_api_key) {
                $getResponseService = app(GetResponseService::class);
                $getrepsonseAudience = $getResponseService->getAudience(optional($user)->setting->get_response_api_key);
                if (!is_null($getrepsonseAudience) && is_iterable($getrepsonseAudience)) {
                }
            }


            return view('pages.courses.settings', compact('freeLessonCount', 'id', 'course', 'lists', 'convert', 'getrepsonseAudience'));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle 401 Unauthorized error
            return back()->with('success', 'Authentication failed. Please check your API key and authentication process.');
        // } catch (\Exception $e) {
        //     // Handle other exceptions
        //     $errorMessage = $e->getMessage();

        //     // Handle other exceptions
        //     dd($errorMessage);
        //     return back()->with('success', 'An error occurred. Please try again later.');
            // return back()->with('success', 'An error occurred. Please try again later.');
        }
    }

    public function saveSetting(Request $request, $courseId)
    {
        $list_id = $request->input('list_id');
        $esp = $request->input('esp');

        $user = auth()->user();
        $course = $user->courses()->where('courses.id', $courseId)->update([
            'esp' => $esp,
            'list_id' => $list_id
        ]);
        return redirect()->back()->with('success', 'List Updated');
    }

    public function saveGetResponseId(Request $request, $courseId)
    {
        $get_response_id = $request->input('get_response_id');
        $esp = $request->input('esp');

        $user = auth()->user();
        $course = $user->courses()->where('courses.id', $courseId)->update([
            'esp' => $esp,
            'get_response_id' => $get_response_id
        ]);
        return redirect()->back()->with('success', 'Audience Updated');
    }
    public function convertKit(Request $request, $courseId)
    {
        $convert_id = $request->input('convert_id');
        $esp = $request->input('esp');

        $user = auth()->user();
        $course = $user->courses()->where('courses.id', $courseId)->update([
            'esp' => $esp,
            'convert_id' => $convert_id
        ]);
        return redirect()->back()->with('success', 'Audience Updated');
    }

    public function checkout(Request $request, $courseId)
    {
        $user = auth()->user();

        $course = $user->courses()->find($courseId);

        session(['checkout_option' =>  $request->input('checkout_option')]);
        if ($course) {
            $course->courseSettings->checkout_option = $request->input('checkout_option');
            $course->courseSettings->update();

            return redirect()->back()->with('success', ' updated successfully');
        } else {
            return redirect()->route('courses.index')->with('error', 'Course not found');
        }
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

        $user = auth()->user();
        $course = $user->courses()->findOrFail($courseId);

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
