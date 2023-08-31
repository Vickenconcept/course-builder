<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSettings;
use Illuminate\Http\Request;
use App\Services\BookService;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

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
        //
    }


    public function show($slug)
    {
        // $course = Course::findOrFail($slug); 
        $user = auth()->user();
        $course = $user->courses()->where('slug', $slug)->firstOrFail();
        // $freeLessonCount = $course->settings->free_lessons_count;
        return view('pages.courses.preview', compact('course'));
    }

    public function share($slug)
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

        return view('pages.courses.embed_show', compact('course', 'freeCourse', 'isSubscribed'));
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
    // public function courseImage(Request $request, $image)
    // {

    //    $user = auth()->user();
    //     $course = $user->courses()->findOrFail($image);
    //     $image = $request->input('courseImage');
    //     $course->course_image = $image;
    //     $course->update();
    //     return redirect()->back()->with('success', 'Book Cover updated');

    // }

    public function courseImage(Request $request, $image)
    {
        $user = auth()->user();
        $course = $user->courses()->findOrFail($image);

        $imageUrl = $request->input('courseImage');

        // Download the image using Laravel's HTTP client
        $response = Http::get($imageUrl);

        if ($response->successful()) {
            // Create an Intervention Image instance from the downloaded content
            $image = Image::make($response->body());
            
            // Resize the image to your desired dimensions
            $image->fit(1200, 630); // Adjust dimensions as needed
            
            // Create the customized_images folder if it doesn't exist
            $customImagePath = 'customized_images/';
            if (!File::exists(public_path($customImagePath))) {
                File::makeDirectory(public_path($customImagePath));
            }
            
            // Generate a unique filename for the resized image
            // dd($customImagePath);
            $filename = uniqid() . '.jpg';

            // Save the resized image to the customized_images folder
            $image->save(public_path($customImagePath . $filename));

            // Update the course with the customized image path
            $course->course_image = $customImagePath . $filename;
            $course->save();

            return redirect()->back()->with('success', 'Course Image updated');
        } else {
            return redirect()->back()->with('error', 'Failed to download the image.');
        }
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

        // dd($selectedOption);

        return redirect()->back()->with('success', 'Price updated successfully.');
    }


    // public function purchase(Request $request, Product $product)
    // {
    //     $user          = $request->user();
    //     $paymentMethod = $request->input('payment_method');

    //     try {
    //         $user->createOrGetStripeCustomer();
    //         $user->updateDefaultPaymentMethod($paymentMethod);
    //         $user->charge($product->price * 100, $paymentMethod);
    //     } catch (\Exception $exception) {
    //         return back()->with('error', $exception->getMessage());
    //     }

    //     return back()->with('message', 'Product purchased successfully!');
    // }




    public function destroy($id)
    {
        // $content = Course::find($id);
        $user = auth()->user();

        $course = $user->courses()->find($id);
        $course->delete();

        return redirect()->to('course')->with('success', 'Course deleted successfully.');
    }
}
