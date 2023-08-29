<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Retrieve the course associated with the user by its ID
        $courses = $user->courses()->latest()->get();
        // dd($courses);
        return view('users.users-dashoard', compact('courses'));   
    }
}
