<?php

namespace App\Http\Livewire;

use App\Services\ChatGptService;
use Livewire\Component;

class Modal extends Component
{


     public $modalData, $title , $action ,$generatedResponse,$lesson;
     protected $listeners = ['showModal' => 'accepDataValue'];
     public $uniqueId;

     public function mount($title,$lesson )
     {
         $this->title = $title;
         $this->lesson = $lesson;
         $this->uniqueId = uniqid();
     }
     public function accepDataValue($data)
     {
        $this->modalData = $data['message'];

    }
    
    public function regenerate( ChatGptService $chatGptService){
        
        $query  = "Generate an extensive and explanatory content for this subtopic " .$this->title." , return the response in a html format without head tag, html tag abd body tag, please do add <br> tag after every <p> and  where needed ." ;
        $response = $chatGptService->generateContent($query);
        $this->generatedResponse = $response;


    }
    public function aiCourseGenerator( ChatGptService $chatGptService)
    {
        // $query = $this->modalData . " '" . $this->title . "' ";
        $query  = "Generate an extensive and explanatory content for this subtopic " .$this->title." , return the response in a html format without head tag, html tag abd body tag, please do add <br> tag after every <p> and  where needed ." ;
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
