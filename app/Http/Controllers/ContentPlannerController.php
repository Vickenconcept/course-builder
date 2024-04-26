<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ContentPlanner;
use App\Models\Course;
use App\Models\Courseresearch;
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
    public function index()
    {
        $researches = Courseresearch::latest()->get();
        $books = Book::latest()->get();
        $user = auth()->user();

        $courses = $user->courses()->latest()->get();

        return view('users.content-planner', compact('courses', 'researches', 'books'));
    }


    public function create()
    {
        return view('users.create-course');
    }


    public function store(Request $request, ChatGptService $chatGptService)
    {
        $mytextarea = $request->input('mytextarea') ?? '';
        $content = auth()->user()->contentPlanner()->create(['content' => $mytextarea]);
        $request->session()->put('content', $content);
        // return back()->with('success', 'Course save successfully');
    }


    public function exportText(Request $request)
    {
        $defaultQuery = 'kids art book';
        $jsonData = $request->session()->get('content') ?? $defaultQuery;

        $data = json_decode($jsonData, true);

        $content = $data['content'] ?? null;

        $textData = strip_tags($content);
        $textData = html_entity_decode($textData);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($textData);

        $filename = 'exported_text.docx';

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }



    public function show($hashedId)
    {
        $hashids = new Hashids();
        $contentId = $hashids->decode($hashedId)[0]; 
        $content = ContentPlanner::findOrFail($contentId);
        return view('users.shared.show', compact('content'));
    }
    
    public function destroy($id)
    {
        $content = ContentPlanner::find($id);
        $content->delete();

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }
}
