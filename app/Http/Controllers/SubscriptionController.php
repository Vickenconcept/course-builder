<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    public function index()
    {

        $admin =  User::where('is_admin', 'super_admin')->first();
        return view('admin.subscribe', compact('admin'));
    }

    public function updateSubscription(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        $user->subscribed = '1';
        $user->update();

        return response()->json(['message' => 'Subscription updated successfully']);
    }

    public function SavePaypalDetail(Request $request)
    {

        $data = $request->validate([
            'super_admin_paypal_client_id' => 'required',
            'subscriptiion_amount' => 'sometimes'
        ]);

        $user = auth()->user();
        $user->super_admin_paypal_client_id = $data['super_admin_paypal_client_id'];
        if ($data['subscriptiion_amount']) {
            # code...
            $user->subscriptiion_amount = $data['subscriptiion_amount'];
        }
        $user->update();

        return back()->with('success', 'saved successfully');
    }

    public function SaveStripDetail(Request $request)
    {
        $data = $request->validate([
            'super_admin_strip_secret' => 'required',
            'super_admin_strip_key' => 'required',
            'subscriptiion_amount' => 'sometimes'
        ]);

        $user = auth()->user();
        $user->super_admin_strip_key = $data['super_admin_strip_key'];
        $user->super_admin_strip_secret = $data['super_admin_strip_secret'];
        if ($data['subscriptiion_amount']) {
            $user->subscriptiion_amount = $data['subscriptiion_amount'];
        }
        $user->update();

        return back()->with('success', 'saved successfully');
    }

    public function processStripePayment(Request $request)
    {
        $admin =  User::where('is_admin', 'super_admin')->first();

        Stripe::setApiKey($admin->super_admin_strip_secret);
        // Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = (float) $request->amount * 100;
        $charge = Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Example charge',
        ]);

        $user = auth()->user();


        $user->subscribed = '1';
        $user->update();

        return redirect('dashboard');
        // return response()->json(['message' => 'Payment successful']);
    }
}
