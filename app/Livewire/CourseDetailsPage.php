<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class CourseDetailsPage extends Component
{
    public function render()
    {
        return view('livewire.course-details-page');
    }
}
