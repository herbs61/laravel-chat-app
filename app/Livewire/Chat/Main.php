<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        return view('livewire.chat.main')
        ->layout('layouts.app'); // Specify the correct layout here
    }
}
