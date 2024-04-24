<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $courses = $user->courses()->latest()->get();
        return view('users.users-dashoard', compact('courses'));   
    }
}
