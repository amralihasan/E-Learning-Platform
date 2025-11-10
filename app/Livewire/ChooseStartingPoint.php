<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Assessment;

#[Layout('components.layouts.app')]
class ChooseStartingPoint extends Component
{
    public function startAssessment()
    {
        $assessment = Assessment::where('is_active', true)->first();
        
        if (!$assessment) {
            $this->dispatch('error', message: 'No active assessment available. Please contact support.');
            return;
        }

        return redirect()->route('assessment.start', $assessment->id);
    }

    public function startFromA1()
    {
        $user = auth()->user();
        $user->starting_level = 'A1';
        $user->has_completed_onboarding = true;
        $user->save();

        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.choose-starting-point');
    }
}
