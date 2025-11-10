<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.home-page');
    }
}
