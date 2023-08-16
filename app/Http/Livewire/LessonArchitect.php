<?php

namespace App\Http\Livewire;

// use Illuminate\Http\Request;
use App\Services\ChatGptService;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Events\JobCompleted;
use Illuminate\Support\Facades\Bus;
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
    // public $modifiedOutline = [];

    // foreach ($outline as $subtopic) {
    //     // $prefixedSubtopic = "Explain $subtopic in detail";
    //     $prefixedSubtopic = "for this topic '$this->topic' please provide the actual content or write-ups for $subtopic , What I need is the real course not the draft or outline give at list six long paragraphs for $subtopic";
    //     $detailedExplanation = $chatGptService->generateContent($prefixedSubtopic);
    //     $detailedExplanations[] = $detailedExplanation;
    // }

    public function store(Request $request, ChatGptService $chatGptService)
    {
        $initialOutline = "Generate 10 array of ten subheadings starting from Introduction and ending with conclusion on the topic " .
            $this->topic . "  return the response in one dimensional array of the format []. do say anything else just all i need is the array";

        $generatedOutline = $chatGptService->generateContent($initialOutline);

        $this->outline = $generatedOutline;
    }


    public function generateFinalResponse(Request $request, ChatGptService $chatGptService)
    {

        $maxRequestsPerMinute = 45; // Example rate limit: 45 requests per minute
        $throttlePeriod = 60 / $maxRequestsPerMinute;
        $modifiedOutline = $request->all();
        $this->outline =  $modifiedOutline["serverMemo"]["data"]["outline"];

        $outline = json_decode($this->outline);
        $detailedExplanations = [];

        // foreach ($outline as $subtopic) {
        //     // $prefixedSubtopic = "Explain $subtopic in detail";
        //     $prefixedSubtopic = "for this topic '$this->topic' please provide the actual content or write-ups for $subtopic , What I need is the real course not the draft or outline give at list six long paragraphs for $subtopic";
        //     $detailedExplanation = $chatGptService->generateContent($prefixedSubtopic);
        //     $detailedExplanations[] = $detailedExplanation;
        //     return $this->content = json_encode($detailedExplanations); 
        // }

        foreach ($outline as $subtopic) {
            $prefixedSubtopic = "for this topic '$this->topic' please provide the actual content or write-ups for $subtopic , What I need is the real course not the draft or outline give at least six long paragraphs for $subtopic";

            dispatch(function () use ($chatGptService, $prefixedSubtopic, $subtopic) {
                $detailedExplanation = $chatGptService->generateContent($prefixedSubtopic);

                // Dispatch the JobCompleted event
                event(new \App\Events\JobCompleted($subtopic, $detailedExplanation, true));

                // Store the result or perform any other desired actions
                $detailedExplanations[] = $detailedExplanation;
            });
        }
        return response()->json(['message' => 'Jobs are being processed.']);


        // Compile the responses and send to the view
        $compiledContent = [
            'modifiedOutline' => $modifiedOutline,
            'detailedExplanations' => $detailedExplanations,
        ];


        $request->session()->put('compiledContent', $compiledContent);
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
