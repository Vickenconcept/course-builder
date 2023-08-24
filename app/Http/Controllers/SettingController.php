<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        return view('users.setting');;
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
            'mailchimp_api_key' => 'required',
            'mailchimp_prefix_key' => 'required',

        ]);

        $user = auth()->user();


         $user->setting()->create($validatedData);

        // $user->courses()->first()->courseSettings()->create($validatedData);
        // $user->courses->courseSettings()->updateOrCreate([], $validatedData);
        // foreach ($user->courses as $course) {
        //     $course->courseSettings()->updateOrCreate([], $validatedData);
        // }

        return back()->with('success', 'created successfully');
    }

}
