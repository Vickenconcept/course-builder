<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\ChatGptService;

class ContentGenerator extends Component
{

    public $action  = '';
    public $subheading = '';
    public $content;
    public $cachedCourseOutline;

    // public function generateContent()
    // {
    //     // Generate your content here
    //     $this->generatedContent = "This is the generated content.";
    // }
    public function mount($cachedCourseOutline)
    {
        $this->cachedCourseOutline = $cachedCourseOutline;
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
        return view('livewire.content-generator');
    }
}
