<?php

namespace App\Http\Livewire;

// use Illuminate\Http\Request;
use App\Services\ChatGptService;
use Livewire\Component;
use Illuminate\Http\Request;
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

    public function store(Request $request, ChatGptService $chatGptService)
    {
        $this->inputData = ' Generate a html formated response for a comprehensive '. $this->topic .' course that covers '. $this->presentation . ', suitable for '.($this->level ?? ''). ' learners. The course will run for '. ($this->time ?? '') .' and include '. ($this->modules ?? '') .'. the html formatting will exclude (doctype,html,head,body) tags.';
                   
        $this->content = $chatGptService->generateContent($this->inputData);
        // session(json_encode(['content' =>  $this->content]));
        $request->session()->put('content', json_encode(['content' => $this->content]));
        $sessionContent = session('content');
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
