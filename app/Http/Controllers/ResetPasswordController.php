<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('auth.password_reset'); // Create this blade view
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('success', 'Email does not exist.');
        }
        
        if (auth()->check()) {
            if ($email != auth()->user()->email) {
                return redirect()->back()->with('success', 'Not allowed, Not your email');
            }
        }

        $user->password = bcrypt($password);
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Password changed. Please log in.');
    }
}
