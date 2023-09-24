<?php

namespace App\Http\Controllers;

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
        $password = $request->input('password');
        $request->validate([
            'password' => 'required|min:8'
        ]);
        $user = auth()->user();
        $user->password  = bcrypt($password);
        $user->update();
        Auth::logout();
        return redirect()->to('login')->with('success', 'password changed. Login');
    }
}
