<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class CoursesPage extends Component
{
    public $search = '';
    public $level = '';
    public $category = '';
    public $view = 'grid';

    public function render()
    {
        return view('livewire.courses-page');
    }
}
