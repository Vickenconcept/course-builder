<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\MailChimpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{
  

    public function index()
    {
       
       
        return view('users.setting');
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


        $encryptedApiKey = Crypt::encryptString($validatedData['mailchimp_api_key']);

        $user = auth()->user();

        $user->setting()->create([
            'mailchimp_api_key' => $encryptedApiKey,
            'mailchimp_prefix_key' => $validatedData['mailchimp_prefix_key'],
        ]);

        return back()->with('success', 'created successfully');
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);


        return view('pages.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courseresearch $courseresearch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $content = Course::find($id);
        $content->delete();

        return redirect()->to('course')->with('success', 'Course deleted successfully.');
    }
}