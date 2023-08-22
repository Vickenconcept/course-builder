<?php

namespace App\Http\Livewire;

use App\Services\ChatGptService;
use Livewire\Component;

class Modal extends Component
{


     public $modalData, $title , $action ,$generatedResponse,$lesson;
     protected $listeners = ['showModal' => 'accepDataValue'];

     public function mount($title,$lesson )
     {
         $this->title = $title;
         $this->lesson = $lesson;
     }
     public function accepDataValue($data)
     {
        $this->modalData = $data['message'];

    }

    // public function addToTextarea()
    // {
    //     $this->textareaData .= $this->content;
    // }
    
    public function regenerate( ChatGptService $chatGptService){
        
        $query  = "generate a course body for this subtopic $this->title. dont exceed fifty seconds while executing";
        $response = $chatGptService->generateContent($query);
        $this->generatedResponse = $response;


    }
    public function aiCourseGenerator( ChatGptService $chatGptService)
    {
        // $query = $this->modalData . " '" . $this->title . "' ";
        // $query  = "generate a course body for this subtopic $this->title. dont exceed fifty seconds while executing";
        $query  = "write an intro abiut this subtopic " .$this->title ;
        $response = $chatGptService->generateContent($query);
 
        $this->generatedResponse = $response;

    }
    public function sendModalResponse()
    {
        // dd($this->lesson->id);
       $this->emit('addToTextarea',  $this->generatedResponse, $this->lesson->id);
   
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
