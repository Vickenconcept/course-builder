<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\ChatGptService;
use Illuminate\Support\Facades\Cache;

class CourseContent extends Component
{
    public $cachedCourseOutline = [];
    public $action  = '';
    public $subheading = '';
    public $content;
    public $title;
    public $courseId;
    public $course;
    public $isLoading = false; 
    public $textareaData = '';
    
    // dd( $response);
    // public $textareaInputValue = '';
    


    public function mount($course)
    {
        $this->courseId = $this->course->id;
        $this->title = $this->course->title;
        $this->course = $course;
        $this->textareaData = $this->course::where('id', $this->courseId)->firstOrFail()->content;
    }
    public function setButtonValue($action)
    {
        $this->action = $action;
    }
    public function addToTextarea()
    {
        
        $this->textareaData .= $this->content;
        
    }
    public function regenerate(ChatGptService $chatGptService){
        $this->content = '';
        // $this-> isLoading = true;
        $this->subheading  = $this->title;
        $this->action;
        $query = $this->action . " '" . $this->subheading . "' ";
        $response = $chatGptService->generateContent($query);
        // dd($response);
        $this->content = $response;
        // $this-> isLoading = false;

    }

    public function aiCourseGenerator( ChatGptService $chatGptService)
    {
        // $this-> isLoading = true;
        $this->subheading  = $this->title;
        $this->action;
        $query = $this->action . " '" . $this->subheading . "' ";
        $response = $chatGptService->generateContent($query);
        // dd($response);
        $this->content = $response;
        // $this-> isLoading = false;
    }

    public function updateDatabase()
    {
       
        if(! empty($this->textareaData)){
            $this->course->where('id', $this->courseId)
            ->update(['content' => $this->textareaData]);
            
        }

    }
    public function render()
    {
        return view('livewire.course-content');
    }
}
