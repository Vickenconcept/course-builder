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

            $courseModel = new Course;
            $course = $courseModel->newQueryWithoutScopes()
                ->find($request->query('courseId'));



            if ($course) {
                $owner = $course->user;

                $settings = $owner->first()->setting;

                if (!$settings) {
                    return redirect()->back()->with('error', 'No PayPal settings found for the course owner.');
                }

                $paypalApiUsername = $settings->paypal_api_username;
                $paypalApiPassword = $settings->paypal_api_password;
                $paypalApiSecret = $settings->paypal_api_secret;

                if (empty($paypalApiUsername) || empty($paypalApiPassword) || empty($paypalApiSecret)) {
                    return redirect()->back()->with('error', 'PayPal API credentials are missing or incorrect.');
                }


                config([
                    'paypal.live.username' => $paypalApiUsername,
                    'paypal.live.password' => $paypalApiPassword,
                    'paypal.live.secret' => $paypalApiSecret,
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

        try {
            $provider = new ExpressCheckout;

            $response = $provider->setExpressCheckout($data);

            $response = $provider->setExpressCheckout($data, true);
            // dd($response);

            if ($response['ACK'] === 'Success') {
                return redirect($response['paypal_link']);
                // return redirect()->away($response['paypal_link']);
            } 
            elseif($response['ACK'] === 'Failure') {
                $errMsg = $response['L_LONGMESSAGE0'];
                return back()->with('success', $errMsg . '. Please try again.');
            }
           
        // } catch (\Exception $e) {
        //     return back()->with('success', 'An error occurred. Please try again later.');
        }
        catch (\Exception $e) {
            $errorMessage = 'An error occurred. Please try again later.';
            
            // Check if the error is related to a restricted account
            if (strpos($e->getMessage(), 'Account is restricted') !== false) {
                $errorMessage = 'Your PayPal account is restricted. Please contact PayPal support for assistance.';
            }
            
            return back()->with('success', $errorMessage);
        }
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return view('users.cancle');
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

            return view('users.success');
            dd('Your payment was successfully. You can create success page here.');
        }

        return view('errors.custom_error');
        dd('Something is wrong.');
    }
}
