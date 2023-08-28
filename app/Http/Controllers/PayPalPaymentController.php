<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalPaymentController extends Controller
{
    public function payment(Request $request)
    {

        // $courseId = $request->query('course_id');
        $price =  (int) $request->query('price');
        $title = $request->query('title');
        $courseId = $request->query('courseId');

        // Store the course ID in the session
        if ($courseId) {
            session(['course_id' => $courseId]);

        }
        // dd((string) $price);

       
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
                return redirect()->route('courses.share', ['course_slug' => $course->slug]);
            }

            dd('Your payment was successfully. You can create success page here.');
        }

        dd('Something is wrong.');
    }
}
