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
            SUM(CASE WHEN email_verified_at IS NULL THEN 1 ELSE 0 END) as unverified_users
        ')->first();

        // $users = User::latest()->get();
        $users = User::where('is_admin', 'admin')->latest()->get();

        return view('dashboard', compact('users', 'userStats'));
    }




    // ...

    public function update($user, Request $request)
    {

        // $user = auth()->user(); // Retrieve the currently authenticated user
        $foundUser = User::find($user); // Find a user by their ID

        // dd($user);
        // dd($foundUser->is_admin);
        // $user->update(['is_admin' => $request->has('user_type') ? 'admin' : 'user']);

     
        $foundUser->update(['is_admin' => 1]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User type updated to admin.');
    }
}
