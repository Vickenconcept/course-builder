<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subscribe;
use App\Models\User;
use App\Services\ConvertKitService;
use App\Services\GetResponseService;
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
        return null;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


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
            Auth::login($existingUser);
        } else {
            $newUser = User::create($data);
            Auth::login($newUser);
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */


    public function getResponse(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        
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
                   
                    $getResponseService = app(GetResponseService::class);

                    $subscribe = $getResponseService->createContact($courseCreator->first()->setting->get_response_api_key, $course->get_response_id, $name, $email);
    
                    $course->user()->sync([$user->id], false);
    
                    return redirect()->route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]);
                } else {
                    $course->user()->attach($user->id);
                }
            } else {
    
                return  response('course not found');
            }
            
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' => 'string',
        ]);
      
        if (!$request->has('is_admin')) {
            $data['is_admin'] = 'user';
        }

        $newUser = User::create($data);

        Auth::login($newUser);


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
               

                $getResponseService = app(GetResponseService::class);
                $subscribe = $getResponseService->createContact($courseCreator->first()->setting->get_response_api_key, $course->get_response_id, $name, $email);

                $course->user()->sync([$user->id], false);

                return redirect()->route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]);
            } else {
                $course->user()->attach($user->id);
            }
        } else {

            return  response('course not found');
        }


    }
    public function convertkit(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        
        if ($user) {
            Auth::login($user);

            $courseId = $request->input('courseId');
            $email = $request->input('email');
            $name = $request->input('name');
            $convert_id = $request->input('convert_id');
            $user = User::where('email', $email)->first();
            $courseModel = new Course;
    
            $course = $courseModel->newQueryWithoutScopes()->find($courseId);
    
            if ($user && $course) {
    
                $courseCreator = $course->user;
    
                if ($courseCreator->first()->setting) {
                   
                    $convertKitService = app(ConvertKitService::class);
                    $convert = $convertKitService->addEmail($courseCreator->first()->setting->convert_api_key,$convert_id, $email);
                    $course->user()->sync([$user->id], false);
    
                    return redirect()->route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]);
                } else {
                    $course->user()->attach($user->id);
                }
            } else {
    
                return  response('course not found');
            }
            
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' => 'string',
        ]);
      
        if (!$request->has('is_admin')) {
            $data['is_admin'] = 'user';
        }

        $newUser = User::create($data);

        Auth::login($newUser);

        $courseId = $request->input('courseId');
        $email = $request->input('email');
        $name = $request->input('name');
        $convert_id = $request->input('convert_id');
        $user = User::where('email', $email)->first();
        $courseModel = new Course;
        $course = $courseModel->newQueryWithoutScopes()->find($courseId);
        
        if ($user && $course) {

            $courseCreator = $course->user;

            if ($courseCreator->first()->setting) {
               

                $convertKitService = app(ConvertKitService::class);
                $convert = $convertKitService->addEmail($courseCreator->first()->setting->convert_api_key,$convert_id, $email);

                $course->user()->sync([$user->id], false);

                return redirect()->route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]);
            } else {
                $course->user()->attach($user->id);
            }
        } else {

            return  response('course not found');
        }


    }
    public function store(Request $request)
    {

        $user = User::where('email', $request->input('email'))->first();

        
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
      
        if (!$request->has('is_admin')) {
            $data['is_admin'] = 'user';
        }

        $newUser = User::create($data);

        Auth::login($newUser);

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
        $courseModel = new Course;
        $course = $courseModel->newQueryWithoutScopes()
            ->find($id);
        if (!$course) {
            abort(404);
        }
        $list_id = $course->list_id;

        return view('pages.courses.subscribe', compact('course', 'list_id'));
    }

   
}
