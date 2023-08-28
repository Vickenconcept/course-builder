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

        $course = $user->courses()->find($courseId);

        if ($course) {
            $course->courseSettings->checkout_option = $request->input('checkout_option');
            $course->courseSettings->update();

            return redirect()->back()->with('success', ' updated successfully');
        } else {
            return redirect()->route('courses.index')->with('error', 'Course not found');
        }
    }

    public function coursePrice(Request $request, $course)
    {

        $selectedOption = $request->input('price-option');
        $user = auth()->user();
        
        $course = $user->courses()->find($course);
        
        if ($selectedOption === 'custom') {
            $customPrice = $request->input('custom-price');
            // dd($customPrice);
            
            
            $course->price = $customPrice;
            $course->update();
        }else{
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
