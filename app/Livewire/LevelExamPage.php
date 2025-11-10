<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\LevelExam;
use App\Models\LevelExamQuestion;
use App\Models\UserLevelExam;
use App\Services\LevelUnlockService;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class LevelExamPage extends Component
{
    public $level;
    public $levelExam;
    public $userExam;
    public $currentSection = 'reading';
    public $currentQuestionIndex = 0;
    public $answers = [];
    public $sections = ['reading', 'listening', 'grammar'];
    public $questionsBySection = [];
    public $currentQuestions = [];

    public function mount($level)
    {
        $this->level = $level;
        $this->levelExam = LevelExam::with(['questions.answers'])
            ->where('level', $level)
            ->where('is_active', true)
            ->firstOrFail();

        // Check if user already has an exam attempt
        $this->userExam = UserLevelExam::where('user_id', Auth::id())
            ->where('level_exam_id', $this->levelExam->id)
            ->whereNull('completed_at')
            ->first();

        if (!$this->userExam) {
            // Create new user exam
            $this->userExam = UserLevelExam::create([
                'user_id' => Auth::id(),
                'level_exam_id' => $this->levelExam->id,
                'level' => $level,
                'started_at' => now(),
                'max_score' => $this->levelExam->questions->sum('points'),
            ]);
        }

        // Group questions by section
        foreach ($this->sections as $section) {
            $this->questionsBySection[$section] = $this->levelExam->questions
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
    }

    public function selectSection($section)
    {
        $this->currentSection = $section;
        $this->loadCurrentSection();
    }

    public function selectAnswer($questionId, $answerId)
    {
        $this->answers[$questionId] = $answerId;
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->currentQuestions) - 1) {
            $this->currentQuestionIndex++;
        } else {
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
            $currentSectionIndex = array_search($this->currentSection, $this->sections);
            if ($currentSectionIndex > 0) {
                $this->selectSection($this->sections[$currentSectionIndex - 1]);
                $this->currentQuestionIndex = count($this->currentQuestions) - 1;
            }
        }
    }

    public function submitExam()
    {
        // Calculate score
        $totalScore = 0;
        $maxScore = $this->userExam->max_score;

        foreach ($this->levelExam->questions as $question) {
            $answerId = $this->answers[$question->id] ?? null;
            if ($answerId) {
                $answer = $question->answers->find($answerId);
                if ($answer && $answer->is_correct) {
                    $totalScore += $question->points;
                }
            }
        }

        $percentage = $maxScore > 0 ? ($totalScore / $maxScore) * 100 : 0;
        $passed = $percentage >= $this->levelExam->passing_percentage;

        // Update user exam
        $this->userExam->update([
            'completed_at' => now(),
            'score' => $totalScore,
            'percentage' => $percentage,
            'passed' => $passed,
        ]);

        // If passed, unlock the level
        if ($passed) {
            $levelUnlockService = new LevelUnlockService();
            $levelUnlockService->unlockLevelViaExam(Auth::user(), $this->level, $this->userExam->id);
        }

        return redirect()->route('level-exam.results', $this->userExam->id);
    }

    public function getProgressProperty()
    {
        $totalQuestions = $this->levelExam->questions->count();
        $answeredQuestions = count($this->answers);
        return $totalQuestions > 0 ? ($answeredQuestions / $totalQuestions) * 100 : 0;
    }

    public function render()
    {
        $currentQuestion = $this->currentQuestions[$this->currentQuestionIndex] ?? null;

        return view('livewire.level-exam-page', [
            'currentQuestion' => $currentQuestion,
        ]);
    }
}
