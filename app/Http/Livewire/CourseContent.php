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

    public function mount()
    {
        $this->cachedCourseOutline = session('courseOutline');

    }
    public function aiCourseGenerator(Request $request, ChatGptService $chatGptService)
    {
        $this->subheading ;
        $this->action ;
        $query = '';
        dd($this->action  , $this->subheading );
        $generatedOutline = $chatGptService->generateContent($query);
        
    }
    public function render()
    {
        return view('livewire.course-content');
    }
}
