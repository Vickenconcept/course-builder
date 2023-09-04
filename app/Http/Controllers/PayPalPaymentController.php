<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalPaymentController extends Controller
{
    public function payment(Request $request)
    {
        try {

            // $course = Course::find($request->query('courseId')); 
            $courseModel = new Course;
            $course = $courseModel->newQueryWithoutScopes()
                ->find($request->query('courseId'));

            // // $course = $user->courses()->findOrFail($id);
            // if ($course) {
            //     $owner = $course->user; // Assuming there's a relationship between Course and User

            //     $settings =$owner->first()->setting;

            //     $paypalApiUsername = $settings->paypal_api_username;
            //     $paypalApiPassword = $settings->paypal_api_password;
            //     $paypalApiSecret = $settings->paypal_api_secret;

            //     config([
            //         'paypal.sandbox.username' => $paypalApiUsername,
            //         'paypal.sandbox.password' => $paypalApiPassword,
            //         'paypal.sandbox.secret' => $paypalApiSecret ,
            //     ]);

            //     // Use $owner as needed
            // } else {
            //     return redirect()->back()->with('success', 'paypal keys incorrect');
            // }

            if ($course) {
                $owner = $course->user; // Assuming there's a relationship between Course and User

                // Retrieve the owner's settings
                $settings = $owner->first()->setting;

                if (!$settings) {
                    return redirect()->back()->with('error', 'No PayPal settings found for the course owner.');
                }

                $paypalApiUsername = $settings->paypal_api_username;
                $paypalApiPassword = $settings->paypal_api_password;
                $paypalApiSecret = $settings->paypal_api_secret;

                // Check if any of the PayPal API credentials is empty or null
                if (empty($paypalApiUsername) || empty($paypalApiPassword) || empty($paypalApiSecret)) {
                    return redirect()->back()->with('error', 'PayPal API credentials are missing or incorrect.');
                }


                config([
                    'paypal.sandbox.username' => $paypalApiUsername,
                    'paypal.sandbox.password' => $paypalApiPassword,
                    'paypal.sandbox.secret' => $paypalApiSecret,
                ]);
            } else {
                return redirect()->back()->with('error', 'Course not found.');
            }
        } catch (\TypeError $e) {
            // Handle the error gracefully
            // Log the error
            logger()->error('Caught a TypeError: ' . $e->getMessage());

            // Redirect the user to an error page or do some other action
            return redirect()->back()->with('error', 'An unexpected error occurred.');
        }

        // Use $owner as needed



        // $courseId = $request->query('course_id');
        $price =  (int) $request->query('price');
        $title = $request->query('title');
        $courseId = $request->query('courseId');

        // Store the course ID in the session
        if ($courseId) {
            session(['course_id' => $courseId]);
        }


        $data = [];
        $data['items'] = [
            [
                'name' => $title,
                'price' => $price,
                'desc'  => 'Description for ItSolutionStuff.com',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $price;

        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);

        $response = $provider->setExpressCheckout($data, true);
        // dd($response);

        // return redirect()->away($response['paypal_link']);
        return redirect($response['paypal_link']);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {

        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $courseId = session('course_id');
            if ($courseId) {
                $courseModel = new Course;
                $course = $courseModel->newQueryWithoutScopes()->find($courseId);
                $user = auth()->user();
                // dd($user->name);

                // Redirect the user to the course page
                $course->user()->sync([$user->id], false);
                return redirect()->route('courses.share', ['courseId' => $course->id, 'course_slug' => $course->slug]);
            }

            dd('Your payment was successfully. You can create success page here.');
        }

        dd('Something is wrong.');
    }
}
