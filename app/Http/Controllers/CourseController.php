<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseIpAddress;
use App\Models\CourseSettings;
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
        //
    }


    public function show($slug)
    {
        // $user = auth()->user();

        // $course = $user->courses()->where('slug', $slug)->firstOrFail();
        if (auth()->check()) {
            $user = auth()->user();
            $course = $user->courses()->where('slug', $slug)->firstOrFail();
            // Rest of your code
        } else {
            // Handle the case where the user is not authenticated
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

        // dd( $course->courseSettings->checkout_option);

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

    // public function courseImage(Request $request, $image)
    // {

    //     $user = auth()->user();
    //     $course = $user->courses()->findOrFail($image);
    //     $image = $request->input('courseImage');
    //     $course->course_image = $image;
    //     $course->update();
    //     return redirect()->back()->with('success', 'Book Cover updated');
    // }

    // public function courseImage(Request $request, $image)
    // {
    //     $user = auth()->user();
    //     $course = $user->courses()->findOrFail($image);

    //     // Check if a local image file is uploaded
    //     if ($request->hasFile('localImage')) {
    //         // Validate and store the uploaded image
    //         $request->validate([
    //             'localImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add suitable validation rules
    //         ]);

    //         // Store the image in a storage folder or public directory
    //         $imagePath = $request->file('localImage')->store('images', 'public');

    //         // Update the course's image with the local image path
    //         $course->course_image = $imagePath;
    //         // dd($course->course_image = $imagePath);
    //     } else {
    //         // Check if an image URL is provided
    //         $imageUrl = $request->input('courseImage');

    //         if ($imageUrl) {
    //             // Validate the URL or perform additional checks if needed
    //             // Update the course's image with the URL
    //             $course->course_image = $imageUrl;
    //         }
    //     }

    //     // Update the course
    //     $course->update();

    //     return redirect()->back()->with('success', 'Book Cover updated');
    // }


    public function courseImage(Request $request, $image)
    {
        $user = auth()->user();
        $course = $user->courses()->findOrFail($image);

        
        
        
        if ($request->hasFile('localImage')) {
            // Validate and store the uploaded image
            // $request->validate([
                //     'localImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                // ]);
                
                // // Store the image in a storage folder or public directory
                // $imagePath = $request->file('localImage')->store('images', 'public');
                // // dd( $imagePath);
                $response = cloudinary()->upload($request->file('localImage')->getRealPath())->getSecurePath();
        
                // dd($response);


            $course->course_image = null;

            $course->course_image = $response;
        } else {
            // Check if an image URL is provided
            $imageUrl = $request->input('courseImage');

            if ($imageUrl) {
                $course->course_image = null;

                $course->course_image = $imageUrl;
            }
        }

        // Update the course
        $course->update();

        return redirect()->back()->with('success', 'Course Image updated');
    }


    // public function courseImage(Request $request, $image)
    // {
    //     $user = auth()->user();
    //     $course = $user->courses()->findOrFail($image);

    //     $imageUrl = $request->input('courseImage');

    //     // Download the image using Laravel's HTTP client
    //     $response = Http::get($imageUrl);

    //     if ($response->successful()) {
    //         // Create an Intervention Image instance from the downloaded content
    //         $image = Image::make($response->body());

    //         // Resize the image to your desired dimensions
    //         $image->fit(1200, 630); // Adjust dimensions as needed

    //         // Create the customized_images folder if it doesn't exist
    //         $customImagePath = 'customized_images/';
    //         if (!File::exists(public_path($customImagePath))) {
    //             File::makeDirectory(public_path($customImagePath));
    //         }

    //         // Generate a unique filename for the resized image
    //         // dd($customImagePath);
    //         $filename = uniqid() . '.jpg';

    //         // Save the resized image to the customized_images folder
    //         $image->save(public_path($customImagePath . $filename));

    //         // Update the course with the customized image path
    //         $course->course_image = $customImagePath . $filename;
    //         $course->save();

    //         return redirect()->back()->with('success', 'Course Image updated');
    //     } else {
    //         return redirect()->back()->with('error', 'Failed to download the image.');
    //     }
    // }

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
