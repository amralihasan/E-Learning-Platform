<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class CoursesPage extends Component
{
    public $search = '';
    public $level = '';
    public $category = '';
    public $view = 'grid';

    public function render()
    {
        $user = Auth::user();
        $unlockedLevels = $user ? $user->getUnlockedLevelsArray() : [];
        
        $query = Course::query()->where('is_published', true);
        
        if ($user && count($unlockedLevels) > 0) {
            // Filter courses to show only unlocked levels
            $query->whereIn('level', $unlockedLevels);
        } elseif ($user) {
            // If user has no unlocked levels, show no courses
            $query->whereRaw('1 = 0');
        }
        
        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }
        
        if ($this->level) {
            $query->where('level', $this->level);
        }
        
        if ($this->category) {
            $query->where('category', $this->category);
        }
        
        $courses = $query->get();
        
        return view('livewire.courses-page', [
            'courses' => $courses,
            'unlockedLevels' => $unlockedLevels,
        ]);
    }
}
