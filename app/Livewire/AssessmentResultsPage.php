<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\UserAssessment;

#[Layout('components.layouts.app')]
class AssessmentResultsPage extends Component
{
    public $userAssessmentId;
    public $userAssessment;

    public function mount($id)
    {
        $this->userAssessmentId = $id;
        $this->userAssessment = UserAssessment::with(['assessment.questions', 'answers'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);
    }

    public function getSectionScoresProperty()
    {
        $scores = [
            'reading' => ['score' => 0, 'max' => 0],
            'listening' => ['score' => 0, 'max' => 0],
            'grammar' => ['score' => 0, 'max' => 0],
        ];

        foreach ($this->userAssessment->assessment->questions as $question) {
            $scores[$question->section]['max'] += $question->points;
            
            $userAnswer = $this->userAssessment->answers->where('question_id', $question->id)->first();
            if ($userAnswer && $userAnswer->is_correct) {
                $scores[$question->section]['score'] += $question->points;
            }
        }

        return $scores;
    }

    public function startLearning()
    {
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        $sectionScores = $this->sectionScores;
        $percentage = $this->userAssessment->max_score > 0 
            ? ($this->userAssessment->score / $this->userAssessment->max_score) * 100 
            : 0;

        return view('livewire.assessment-results-page', [
            'sectionScores' => $sectionScores,
            'percentage' => $percentage,
        ]);
    }
}
