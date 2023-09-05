<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $data['is_admin'] = 'admin';

        User::create($data);
        return to_route('login');
    }


    // public function login(Request $request): RedirectResponse
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);


    //     if(!Auth::attempt($credentials)) 
    //         return back()->withErrors(['email' => 'Invalid credentials']);

    //    return to_route('dashboard.index');
    // }


    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $redirectRoute = session('pending_subscription_route');
        // dd($redirectRoute);
        
        if ($redirectRoute) {
            // Clear the stored subscription route from session
            session()->forget('pending_subscription_route');

            // Redirect the user to the pending subscription route
            return redirect($redirectRoute);
        }

        return redirect()->route('dashboard.index');
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        // Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
