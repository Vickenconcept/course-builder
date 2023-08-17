<?php

namespace App\Http\Livewire;

use Livewire;
use App\Services\ChatGptService;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Events\JobCompleted;
use App\Models\Library;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LessonArchitect extends Component
{
    public $content;
    public $topic;
    public $presentation;
    public $outline;
    public $level;
    public $modules;
    public $formatting;
    public $time;
    public $inputData;
    protected $listeners = ['generateFinalResponse', 'contentGenerated'];

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
        // $course->save();
        $outline = [
            "subheadings" => $subheadings,
            "course overview" => $courseOverview,
        ];
        $this->outline = $subheadings;
    }


    public function generateFinalResponse(Request $request, ChatGptService $chatGptService)
    {
        $modifiedOutline = $request->all();
        $this->outline =  $modifiedOutline["serverMemo"]["data"]["outline"];
        $outline = $this->outline;
        $user = auth()->user();
        $topicModel = $user->course()->where('topic', $this->topic)->first();


        $prefixedSubtopic = "for this topic '$this->topic' please provide the actual content or write-ups for " . json_encode($outline) . " , What I need is the real course not the draft or outline give at least three long paragraphs for " . json_encode($outline) . " . for each outline subtopic break into a new line. ";

        $formatted_string = "";
        foreach ($outline as $index => $outline) {
            $formatted_string .= ($index + 1) . ". " . $outline . "\n";
        }
        dispatch(function () use ($chatGptService, $prefixedSubtopic, $user, $formatted_string, $topicModel) {

            $detailedExplanation = $chatGptService->generateContent($prefixedSubtopic);

                $topicModel ? $topicModel->library()->create(['content' =>$formatted_string ."\n\n". $detailedExplanation,]) : '';
            
            // return redirect()->route('content-planner.index');

            $this->emit('contentGenerated',  $detailedExplanation);
        })->retry(3);

        return response()->json(['message' => 'Jobs are being processed.']);
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
