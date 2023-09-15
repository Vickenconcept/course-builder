<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subscribe;
use App\Models\User;
use App\Services\MailChimp;
use App\Services\MailChimpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $mailchimpService;

    public function __construct(MailChimpService $mailchimpService)
    {

        $this->mailchimpService = $mailchimpService;
    }


    public function index()
    {
        // return view('pages.courses.subscribe');
        return null;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // public function paymentData(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         // 'password' => 'string',
    //     ]);

    //     $newUser = User::create($data);
    //     Auth::login($newUser);
    //     return redirect()->back();
    // }

    public function paymentData(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'is_admin' => 'string',
        ]);
        if (!$request->has('is_admin')) {
            $data['is_admin'] = 'user';
        }

        $existingUser = User::where('email', $data['email'])->first();

        if ($existingUser) {
            // User already exists, log them in
            Auth::login($existingUser);
        } else {
            // User does not exist, create a new user
            $newUser = User::create($data);
            Auth::login($newUser);
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {

        $user = User::where('email', $request->input('email'))->first();
        
        // If the user exists, log them in
        if ($user) {
            Auth::login($user);

            $courseId = $request->input('courseId');
            $email = $request->input('email');
            $name = $request->input('name');
            $list_id = $request->input('list_id');
            $user = User::where('email', $email)->first();
            $courseModel = new Course;
    
            $course = $courseModel->newQueryWithoutScopes()->find($courseId);
    
            if ($user && $course) {
    
                $courseCreator = $course->user;
    
                if ($courseCreator->first()->setting) {
                    $response = $this->mailchimpService
                        ->subscribe($email, $courseCreator
                            ->first()->setting->mailchimp_api_key, $courseCreator
                            ->first()->setting->mailchimp_prefix_key, $list_id);
    
                    $course->user()->sync([$user->id], false);
                    // dd($courseCreator->first()->setting);
    
                    return redirect()->route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]);
                } else {
                    $course->user()->attach($user->id);
                }
            } else {
    
                return  response('course not found');
            }
            
        }
        // If the user doesn't exist, register them
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' => 'string',
        ]);
        dd($user);
      
        if (!$request->has('is_admin')) {
            $data['is_admin'] = 'user';
        }

        $newUser = User::create($data);

        // Log the newly registered user in
        Auth::login($newUser);

        // subscribe the user
        $courseId = $request->input('courseId');
        $email = $request->input('email');
        $name = $request->input('name');
        $list_id = $request->input('list_id');
        $user = User::where('email', $email)->first();
        $courseModel = new Course;

        $course = $courseModel->newQueryWithoutScopes()->find($courseId);

        if ($user && $course) {

            $courseCreator = $course->user;

            if ($courseCreator->first()->setting) {
                $response = $this->mailchimpService
                    ->subscribe($email, $courseCreator
                        ->first()->setting->mailchimp_api_key, $courseCreator
                        ->first()->setting->mailchimp_prefix_key, $list_id);

                $course->user()->sync([$user->id], false);
                // dd($courseCreator->first()->setting);

                return redirect()->route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]);
            } else {
                $course->user()->attach($user->id);
            }
        } else {

            return  response('course not found');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $intent = auth()->user()->createSetupIntent();
        $courseModel = new Course;
        $course = $courseModel->newQueryWithoutScopes()
            ->find($id);
        if (!$course) {
            abort(404);
        }
        $list_id = $course->list_id;

        // dd( $course->list_id);

        return view('pages.courses.subscribe', compact('course', 'list_id'));
        // return view('pages.courses.subscribe', compact('course' ,'list_id', 'intent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscribe $subscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscribe $subscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscribe $subscribe)
    {
        //
    }
}
