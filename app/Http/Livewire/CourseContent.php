<?php

namespace App\Http\Livewire;

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

    public function mount()
    {
        $this->cachedCourseOutline = session('courseOutline');
        dd($this->cachedCourseOutline);

    }
    public function aiCourseGenerator(Request $request, ChatGptService $chatGptService)
    {
        $this->subheading ;
        $this->action ;
        $query = $this->action . " '" . $this->subheading . "' ";
        dd($query);
        $response = $chatGptService->generateContent($query);
        $this->content = $response;

        
    }
    public function render()
    {
        return view('livewire.course-content');
    }
}
