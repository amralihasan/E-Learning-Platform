<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\UserAssessment;
use App\Models\UserAssessmentAnswer;
use App\Services\LevelUnlockService;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class AssessmentPage extends Component
{
    public $assessmentId;
    public $assessment;
    public $userAssessment;
    public $currentSection = 'reading';
    public $currentQuestionIndex = 0;
    public $answers = [];
    public $sections = ['reading', 'listening', 'grammar'];
    public $questionsBySection = [];
    public $currentQuestions = [];

    public function mount($id)
    {
        $this->assessmentId = $id;
        $this->assessment = Assessment::with(['questions.answers'])->findOrFail($id);
        
        // Check if user already has an assessment
        $this->userAssessment = UserAssessment::where('user_id', Auth::id())
            ->where('assessment_id', $id)
            ->whereNull('completed_at')
            ->first();

        if (!$this->userAssessment) {
            // Create new user assessment
            $this->userAssessment = UserAssessment::create([
                'user_id' => Auth::id(),
                'assessment_id' => $id,
                'started_at' => now(),
                'max_score' => $this->assessment->questions->sum('points'),
            ]);
        }

        // Group questions by section
        foreach ($this->sections as $section) {
            $this->questionsBySection[$section] = $this->assessment->questions
                ->where('section', $section)
                ->sortBy('order')
                ->values();
        }

        $this->loadCurrentSection();
    }

    public function loadCurrentSection()
    {
        $this->currentQuestions = $this->questionsBySection[$this->currentSection] ?? [];
        $this->currentQuestionIndex = 0;
        
        // Load existing answers
        foreach ($this->currentQuestions as $question) {
            $existingAnswer = UserAssessmentAnswer::where('user_assessment_id', $this->userAssessment->id)
                ->where('question_id', $question->id)
                ->first();
            
            if ($existingAnswer) {
                $this->answers[$question->id] = $existingAnswer->answer_id;
            }
        }
    }

    public function selectSection($section)
    {
        $this->currentSection = $section;
        $this->loadCurrentSection();
    }

    public function selectAnswer($questionId, $answerId)
    {
        $this->answers[$questionId] = $answerId;
        
        // Save answer
        $question = AssessmentQuestion::find($questionId);
        $answer = $question->answers->find($answerId);
        
        UserAssessmentAnswer::updateOrCreate(
            [
                'user_assessment_id' => $this->userAssessment->id,
                'question_id' => $questionId,
            ],
            [
                'answer_id' => $answerId,
                'is_correct' => $answer ? $answer->is_correct : false,
            ]
        );
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->currentQuestions) - 1) {
            $this->currentQuestionIndex++;
        } else {
            // Move to next section
            $currentSectionIndex = array_search($this->currentSection, $this->sections);
            if ($currentSectionIndex < count($this->sections) - 1) {
                $this->selectSection($this->sections[$currentSectionIndex + 1]);
            }
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        } else {
            // Move to previous section
            $currentSectionIndex = array_search($this->currentSection, $this->sections);
            if ($currentSectionIndex > 0) {
                $this->selectSection($this->sections[$currentSectionIndex - 1]);
                $this->currentQuestionIndex = count($this->currentQuestions) - 1;
            }
        }
    }

    public function submitAssessment()
    {
        // Calculate score
        $totalScore = 0;
        $maxScore = 0;
        
        foreach ($this->assessment->questions as $question) {
            $maxScore += $question->points;
            $userAnswer = UserAssessmentAnswer::where('user_assessment_id', $this->userAssessment->id)
                ->where('question_id', $question->id)
                ->first();
            
            if ($userAnswer && $userAnswer->is_correct) {
                $totalScore += $question->points;
            }
        }

        // Calculate percentage
        $percentage = $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0;
        $recommendedLevel = $this->calculateLevel($percentage);

        // Update user assessment
        $this->userAssessment->update([
            'completed_at' => now(),
            'score' => $totalScore,
            'max_score' => $maxScore,
            'recommended_level' => $recommendedLevel,
        ]);

        // Unlock levels based on score using LevelUnlockService
        $user = Auth::user();
        $levelUnlockService = new LevelUnlockService();
        $unlockedLevels = $levelUnlockService->unlockLevelsBasedOnScore($user, $percentage, $this->userAssessment->id);

        // Update user
        $user->starting_level = $recommendedLevel;
        $user->has_completed_onboarding = true;
        $user->save();

        return redirect()->route('assessment.results', $this->userAssessment->id);
    }

    private function calculateLevel($percentage)
    {
        if ($percentage >= 90) return 'C2';
        if ($percentage >= 80) return 'C1';
        if ($percentage >= 70) return 'B2';
        if ($percentage >= 60) return 'B1';
        if ($percentage >= 50) return 'A2';
        return 'A1';
    }

    public function getProgressProperty()
    {
        $totalQuestions = $this->assessment->questions->count();
        $answeredQuestions = count($this->answers);
        return $totalQuestions > 0 ? ($answeredQuestions / $totalQuestions) * 100 : 0;
    }

    public function render()
    {
        $currentQuestion = $this->currentQuestions[$this->currentQuestionIndex] ?? null;
        
        return view('livewire.assessment-page', [
            'currentQuestion' => $currentQuestion,
        ]);
    }
}
