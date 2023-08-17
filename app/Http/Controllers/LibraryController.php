<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Book;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class LibraryController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $books = Book::whereHas('user', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->latest()->get();
        return view('users.book-library', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create-course');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // 'content' => 'required',
            'content' => 'required'

        ]);
        // dd($validatedData);

        $library = auth()->user()->library()->create($validatedData);

        return back()->with('success', 'Course save successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Library $lesson_architect)
    // {
    //     $user = Auth::user();

    //     $library = Library::where('id', $lesson_architect->id)
    //         ->where('user_id', $user->id)
    //         ->firstOrFail();

    //     return view('users.create-course', compact('library'));
    // }

    public function show(Library $lesson_architect)
    {
        $user = Auth::user();

        $library = Library::whereHas('course.user', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->where('id', $lesson_architect->id)->firstOrFail();

        return view('users.create-course', compact('library'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Library $library)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        $library->delete();


        return redirect()->back()->with('success', 'course deleted successfully.');
    }
}
