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
    
    public function regenerate( ChatGptService $chatGptService){
        
        $query  = "write an intro about this subtopic " .$this->title ;
        $response = $chatGptService->generateContent($query);
        $this->generatedResponse = $response;


    }
    public function aiCourseGenerator( ChatGptService $chatGptService)
    {
        // $query = $this->modalData . " '" . $this->title . "' ";
        // $query  = "generate a course body for this subtopic $this->title. dont exceed fifty seconds while executing";
        $query  = "write an brief intro about this subtopic " .$this->title." , return the response in a html format, add </br> after every <p> and  where needed . remember to remove the htm, head, and body tag." ;
        $response = $chatGptService->generateContent($query);
 
        $this->generatedResponse = $response;

    }
    public function sendModalResponse()
    {
       $this->emit('addToTextarea',  $this->generatedResponse, $this->lesson->id);
   
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
