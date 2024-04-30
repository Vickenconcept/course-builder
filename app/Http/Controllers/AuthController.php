<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

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

       $user = User::create($data);
       
        Mail::to($data['email'])->send(new WelcomeMail($data['password']));
        event(new Registered($user));

        return to_route('login');
    }
    public function registerAdmin(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $data['is_admin'] = 'super_admin';
        $data['subscribed'] = '1';

        User::create($data);
        Mail::to($data['email'])->send(new WelcomeMail($data['password']));

        return to_route('login');
    }




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
        
        if ($redirectRoute) {
            session()->forget('pending_subscription_route');

            return redirect($redirectRoute);
        }

        return redirect()->route('dashboard.index');
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
