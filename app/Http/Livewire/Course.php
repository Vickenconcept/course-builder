<?php

namespace App\Http\Livewire;

use Livewire;
use App\Services\ChatGptService;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Events\JobCompleted;
use App\Models\Course as ModelsCourse;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


class Course extends Component
{
    public $content;
    // public $cachedCourseOutline;
    public $topic = '';
    public $presentation;
    public $outline;
    public $level;
    public $modules;
    public $formatting;
    public $time;
    public $courseOutline;
    public $courseId;
    public $isLoading = false; 
    

    public function emptyInput()
    {
        return empty($this->topic);
    }

    public function store(Request $request, ChatGptService $chatGptService)
    {
        $this-> isLoading = true;
        $query = "Generate 10 array of ten subheadings starting from Introduction and ending with conclusion on the topic " .
            $this->topic . " , while writing the subheadings,  add the " . $this->topic . " as a key word in the subheadings  . And also  write the course overview for the topic, return the response in an  array of the format ['subheadings' => ['','','', '',..],'course-overview' => ['the course over view will go in here']]. do not say anything else just all i need is the array.";
        // $query = "Generate 10 array of ten subheadings starting from Introduction and ending with conclusion on the topic " .
        //     $this->topic . " . and also  write the course overview for the topic, return the response in an  array of the format ['subheadings' => ['','','', '',..],'course-overview' => ['the course over view will go in here']]. do not say anything else just all i need is the array.";
            $user = auth()->user();
        $generatedOutlineAndDescription = $chatGptService->generateContent($query);
        $courseOutlineAndDescription = json_decode($generatedOutlineAndDescription, true);

        $lesson = $courseOutlineAndDescription['subheadings']  ?? [];
        $courseOverview = $courseOutlineAndDescription['course-overview']  ?? [];
        $courseDescription = implode("\n", $courseOverview);
    
        $course =$user->courses()->create([
            'description' => $courseDescription,
            'title' => $this->topic ?? 'topic',
        ]);
        
        
        $this->content = $lesson;
        $this->courseId = $course->id;
        $this-> isLoading = false;
        
        foreach ( $lesson as $key => $lesson) {
            $course->lessons()->create([
                'title' => $lesson,
                // 'description' => $textareainputvalue,
            ]);
        }
        
    }
   
    

    public function render()
    {
        return view('livewire.course');
    }
}
