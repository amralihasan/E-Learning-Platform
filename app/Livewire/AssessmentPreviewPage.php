<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Assessment;

#[Layout('components.layouts.app')]
class AssessmentPreviewPage extends Component
{
    public $assessmentId;
    public $assessment;
    public $currentSection = 'reading';
    public $sections = ['reading', 'listening', 'grammar'];
    public $questionsBySection = [];

    public function mount($id)
    {
        $this->assessmentId = $id;
        $this->assessment = Assessment::with(['questions.answers'])->findOrFail($id);

        // Group questions by section
        foreach ($this->sections as $section) {
            $this->questionsBySection[$section] = $this->assessment->questions
                ->where('section', $section)
                ->sortBy('order')
                ->values();
        }
    }

    public function selectSection($section)
    {
        $this->currentSection = $section;
    }

    public function render()
    {
        $currentQuestions = $this->questionsBySection[$this->currentSection] ?? [];
        
        return view('livewire.assessment-preview-page', [
            'currentQuestions' => $currentQuestions,
        ]);
    }
}
