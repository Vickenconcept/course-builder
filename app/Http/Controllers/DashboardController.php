<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\JobCompleted;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userStats = User::selectRaw('
        COUNT(*) AS total_users,
        SUM(CASE WHEN email_verified_at IS NOT NULL THEN 1 ELSE 0 END) as verified_users,
        SUM(CASE WHEN email_verified_at IS NULL THEN 1 ELSE 0 END) as unverified_users,
        SUM(CASE WHEN subscribed = "1" THEN 1 ELSE 0 END) AS subscribed_users,
        SUM(CASE WHEN subscribed = "0" THEN 1 ELSE 0 END) AS unsubscribed_users
    ')->first();

        $users = User::where('is_admin', 'admin')->latest()->paginate(20);

        return view('dashboard', compact('users', 'userStats'));
    }


    public function update($user, Request $request)
    {
        $foundUser = User::find($user);

        $foundUser->update(['is_admin' => 1]);

        return redirect()->back()->with('success', 'User type updated to admin.');
    }

    public function use_paypal()
    {
        $user = auth()->user();

        if ($user->use_paypal == 0) {
            $user->use_paypal = '1';
        } else {
            $user->use_paypal = '0';
        }
        $user->update();
        return back()->with('success', 'updated successfully');
    }
    public function use_stripe()
    {
        $user = auth()->user();

        if ($user->use_stripe == 0) {
            $user->use_stripe = '1';
        } else {
            $user->use_stripe = '0';
        }
        $user->update();
        return back()->with('success', 'updated successfully');
    }
}
