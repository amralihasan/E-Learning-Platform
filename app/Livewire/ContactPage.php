<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class ContactPage extends Component
{
    public $name = '';
    public $email = '';
    public $message = '';

    public function submit()
    {
        // Handle form submission
        $this->reset(['name', 'email', 'message']);
        session()->flash('message', 'Thank you for your message! We will get back to you soon.');
    }

    public function render()
    {
        return view('livewire.contact-page');
    }
}
