<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use App\Services\ChatGptService;
use Livewire\Component;

class TextEditor extends Component
{
    public $lesson, $content, $text, $chatGptService, $generatedResponse;
    public $action1 ="write an intro summary for this module based on this title";
    public $action2 ="Generate key ideas (below) for this module";
    protected $listeners = ['addToTextarea'];


   
    public function mount($lesson)
    {
        $this->lesson = $lesson;
        $this->content = $lesson->content;
  
    }

    public function updateDatabase()
    {
        if (
            $this->lesson->content === $this->content ||
            $this->content === null || $this->content === ""
        ) return;

        $lesson  =$this->lesson->update([
            'content' => $this->content,
        ]);
    }

    public function sendData($message)
    {
        $this->emit('showModal', ['message' => $message]);
    }

    
    public function addToTextarea( $data, $lessonId)
    { 
        // dd($lessonId);
        if ($this->lesson->id == $lessonId) {
            $this->content .= $data;
        }
        
    }
  

    public function render()
    {
        return view('livewire.text-editor');
    }
}



