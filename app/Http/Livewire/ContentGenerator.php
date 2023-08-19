<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContentGenerator extends Component
{

    public function generateContent()
    {
        // Generate your content here
        $this->generatedContent = "This is the generated content.";
    }

    public function render()
    {
        return view('livewire.content-generator');
    }
}
