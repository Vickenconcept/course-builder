<?php

namespace App\Http\Controllers;

use App\Models\ContentPlanner;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\ChatGptService;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Hashids\Hashids;


class ContentPlannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $libraries = Library::whereHas('user', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->latest()->get();

        $contents = ContentPlanner::whereHas('user', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->latest()->get();
        return view('users.content-planner', compact('libraries', 'contents'));
    }


    public function create()
    {
        return view('users.create-course');
    }


    public function store(Request $request, ChatGptService $chatGptService)
    {
        $mytextarea = $request->input('mytextarea');
        $content = auth()->user()->contentPlanner()->create(['content' => $mytextarea]);
        $request->session()->put('content', $content);
        // return view('users.content-planner');

        return redirect('content-planner')->with('success', 'Course save successfully');
        // return back()->with('success', 'Course save successfully');
    }


    public function exportText(Request $request)
    {
        $defaultQuery = 'kids art book';
        $jsonData = $request->session()->get('content') ?? $defaultQuery;

        $data = json_decode($jsonData, true);

        $content = $data['content'] ?? null;

        $textData = strip_tags($content); // Remove HTML tags
        $textData = html_entity_decode($textData); // Convert HTML entities to characters

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($textData);

        $filename = 'exported_text.docx';

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    /**
     * Display the specified resource.
     */
    // public function show(ContentPlanner $content_planner)
    // {
    //     $content = ContentPlanner::findOrFail($content_planner->id);
    //     return view('users.shared.show', compact('content'));
    // }

    public function show($hashedId)
    {
        $hashids = new Hashids();
        $contentId = $hashids->decode($hashedId)[0]; // Get the first decoded ID
        $content = ContentPlanner::findOrFail($contentId);
        return view('users.shared.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContentPlanner $contentPlanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContentPlanner $contentPlanner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $content = ContentPlanner::find($id);
        $content->delete();

        // Additional code or redirect if needed

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }
}
