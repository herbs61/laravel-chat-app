<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class SendMessage extends Component
{
    public function render()
    {
        return view('livewire.chat.send-message')
        ->layout('layouts.app'); // Specify the correct layout here

    }
}
