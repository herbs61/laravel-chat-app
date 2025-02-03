<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class Chatbox extends Component
{
    public function render()
    {
        return view('livewire.chat.chatbox')
        ->layout('layouts.app'); // Specify the correct layout here
    }
}
