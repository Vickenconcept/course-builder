<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\MailChimpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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


        $encryptedApiKey = $validatedData['mailchimp_api_key'];
        // $encryptedApiKey = Crypt::encryptString($validatedData['mailchimp_api_key']);

        $user = auth()->user();

        // dd($encryptedApiKey);
        $user->setting()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'mailchimp_api_key' => $encryptedApiKey,
                'mailchimp_prefix_key' => $validatedData['mailchimp_prefix_key'],
            ]
        );

        return back()->with('success', 'created successfully');
    }
    public function saveGetResponseData(Request $request)
    {
        $validatedData = $request->validate([
            'get_response_api_key' => 'required',
        ]);


        $user = auth()->user();

        if ($user->setting()) {
            # code...
            $user->setting()->updateOrCreate(
                ['user_id' => $user->id],
                ['get_response_api_key' => $validatedData['get_response_api_key']]
            );
            
            return back()->with('success', 'created successfully');
        }

    }
    public function saveConvert(Request $request)
    {
        $validatedData = $request->validate([
            'convert_api_key' => 'required',
        ]);


        $user = auth()->user();

        if ($user->setting()) {
            # code...
            $user->setting()->updateOrCreate(
                ['user_id' => $user->id],
                ['convert_api_key' => $validatedData['convert_api_key']]
            );
            
            return back()->with('success', 'ConvertKIt Data Created');
        }

    }


    public function paypalData(Request $request)
    {
        $validatedData = $request->validate([
            'paypal_api_username' => 'required',
            'paypal_api_password' => 'required',
            'paypal_api_secret' => 'required',
        ]);

        $user = auth()->user();

        $user->setting()->updateOrCreate(
            [],
            [
                'paypal_api_username' => $validatedData['paypal_api_username'],
                'paypal_api_password' => $validatedData['paypal_api_password'],
                'paypal_api_secret' => $validatedData['paypal_api_secret'],
            ]
        );


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
