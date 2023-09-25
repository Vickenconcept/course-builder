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

        // Get the user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email does not exist.');
        }

        // Update the user's password
        $user->password = bcrypt($password);
        $user->save();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Password changed. Please log in.');
    }
}
