<?php

namespace App\Http\Livewire;

use Livewire;
use App\Services\ChatGptService;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Events\JobCompleted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


class LessonArchitect extends Component
{
    public $content ;
    public $cachedCourseOutline;
    public $topic;
    public $presentation;
    public $outline;
    public $level;
    public $modules;
    public $formatting;
    public $time;
    public $inputData;
    public $courseOutline;
    protected $listeners = ['generateFinalResponse', 'contentGenerated'];

    public function __construct()
    {
        $this->cachedCourseOutline = session('courseOutline');
    }

    public function store(Request $request, ChatGptService $chatGptService)
    {
        $initialOutline = "Generate 10 array of ten subheadings starting from Introduction and ending with conclusion on the topic " .
            $this->topic . " . and also  write the course overview for the topic, return the response in an  array of the format ['subheadings' => ['','','', '',..],'course overview' => ['the course over view will go in here']]. do not say anything else just all i need is the array.";

        $generatedOutline = $chatGptService->generateContent($initialOutline);

        $generatedOutline = json_decode($generatedOutline, true);
        $subheadings = $generatedOutline['subheadings']  ?? [];
        $courseOverview = $generatedOutline['course overview']  ?? [];
        $courseOverviewString = implode("\n", $courseOverview);

        $user = auth()->user();
        $user->course()->create([
            'topic' => $this->topic ?? 'topic',
            'overview' => $courseOverviewString,
        ]);

        $outline = [
            "subheadings" => $subheadings,
            "course overview" => $courseOverview,
        ];
        // dd($this->cachedCourseOutline);
        // $formattedLessons = [];
        // foreach ($subheadings as $key => $subheading) {
        //     $formattedLessons[] = ($key + 1) . '. ' . ucfirst($subheading);
        // }
        // dd($subheadings);
        // $this->emit('generateFinalResponse',);
        $this->content = $subheadings ;
    }


    public function generateFinalResponse(Request $request)
    {
        $modifiedOutline = $request->all();
        $this->courseOutline =  $modifiedOutline["serverMemo"]["data"]["content"];
        // Cache::put('course_outline', $this->courseOutline, 60);
        session(['courseOutline' => $this->courseOutline]);
         return Redirect::to('/content-outline');

            // if ($topicModel) {
            //     $topicModel->library()->create(['content' => $formatted_string . "\n\n" . $detailedExplanation]);
            // }

        
    }






    public function contentGenerated($detailedExplanation)
    {
        $this->content = $detailedExplanation;
        dd($this->content);
    }


    public function generateExportLink()
    {
        $content = session('content');

        $exportUrl = route('export-text', ['content' => $content]);

        return $exportUrl;
    }

    public function render()
    {
        return view('livewire.lesson-architect');
    }
}
