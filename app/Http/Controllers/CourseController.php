<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseIpAddress;
use App\Models\CourseSettings;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Cloudinary\Uploader;
use App\Services\BookService;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

// use App\Exports\BookExport;
// use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }


    public function store(Request $request)
    {
       $course_id =  $request->input('course_id');
        $title = $request->input('title');

        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
        ]);
        
        $user = auth()->user();
        $course = $user->courses()->where('courses.id', $validatedData['course_id'])->firstOrFail();

        $createdLesson =  $course->lessons()->create([
            'title' =>  $validatedData['title'],
        ]);
       
    
        return redirect()->back()->with('success','Lesson created successfully');
    }

    public function show($slug)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $course = $user->courses()->where('slug', $slug)->firstOrFail();
        } else {
            return redirect()->route('login');
        }

        return view('pages.courses.preview', compact('course'));
    }

    public function share($id, $slug)
    {
        $courseModel = new Course;

        $query = $courseModel->newQueryWithoutScopes()
            ->where('slug', $slug);

        $course = $query->firstOrFail();

        $isSubscribed = false;
        $user = auth()->user();
        if ($user) {
            $isSubscribed = $user->courses->contains('id', $course->id);
        }

        $freeCourse = $course->coursesettings->free_lessons_count;
        $hasIpAddressAccess = $this->hasIpAddressAccess($course->id);

        return view('pages.courses.embed_show', compact('course', 'freeCourse', 'isSubscribed', 'hasIpAddressAccess'));
    }

    private function hasIpAddressAccess($courseId)
    {
        $ipAddress = request()->ip();
        $ipRecord = CourseIpAddress::where('course_id', $courseId)
            ->where('ip_address', $ipAddress)
            ->first();

        return $ipRecord !== null;
    }




    public function edit($id)
    {
        $user = auth()->user();

        $course = $user->courses()->findOrFail($id);

        return view('pages.courses.edit', compact('course'));
    }



    public function update(Request $request, $courseId)
    {
        $user = auth()->user();
        $course = $user->courses()->findOrFail($courseId);
        $newData = $request->input('updateTitle');


        $course->update(['title' => $newData]);
        return redirect()->back()->with('success', 'updated succesfully');
    }
    public function updateDescription(Request $request, $courseId)
    {

        $user = auth()->user();
        $course = $user->courses()->findOrFail($courseId);
        $newData = $request->input('updateDescription');


        $course->update(['description' => $newData]);
        return redirect()->back()->with('success', 'updated succesfully');
    }


    public function courseImage(Request $request, $image)
    {
        $user = auth()->user();
        $course = $user->courses()->findOrFail($image);

        if ($request->hasFile('localImage')) {
                $response = cloudinary()->upload($request->file('localImage')->getRealPath())->getSecurePath();
        

            $course->course_image = null;

            $course->course_image = $response;
        } else {
            $imageUrl = $request->input('courseImage');

            if ($imageUrl) {
                $course->course_image = null;

                $course->course_image = $imageUrl;
            }
        }

        $course->update();

        return redirect()->back()->with('success', 'Course Image updated');
    }


    public function coursePrice(Request $request, $course)
    {

        $selectedOption = $request->input('price-option');
        $user = auth()->user();

        $course = $user->courses()->find($course);

        if ($selectedOption === 'custom') {
            $customPrice = $request->input('custom-price');

            $course->price = $customPrice;
            $course->update();
        } else {
            $course->price = $selectedOption;
            $course->update();
        }

        return redirect()->back()->with('success', 'Price updated successfully.');
    }


    public function destroy($id)
    {
        $user = auth()->user();

        $course = $user->courses()->find($id);
        $course->delete();

        return redirect()->to('course')->with('success', 'Course deleted successfully.');
    }
}
