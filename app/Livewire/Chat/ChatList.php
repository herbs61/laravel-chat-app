<?php

namespace App\Livewire\Chat;

use App\Models\User;
use Livewire\Component;
use App\Models\Conversation;

class ChatList extends Component
{

    public $auth_id;
    public $conversations;
    public $receiverInstance;
    public $name;
    public $selectedConversation;


    public function chatUserSelected(Conversation $conversation,$receiverId)
    {
        $this->selectedConversation= $conversation;
    }
    
    function getChatUserInstance(Conversation $conversation, $request)
    {
        $this->auth_id = auth()->id();
        /// get selected conversation

        if ($conversation->sender_id == $this->auth_id) {
            $this->receiverInstance = User::firstWhere('id', $conversation->receiver_id);
        } else {
            $this->receiverInstance = User::firstWhere('id', $conversation->sender_id);
        }

        if (isset($request)) {
            return $this->receiverInstance->$request;
        }
    }


    function mount()
    {
        $this->auth_id = auth()->id();
        $this->conversations = Conversation::where('sender_id', $this->auth_id)->orwhere('receiver_id', $this->auth_id)->orderBy('last_time_message', 'DESC')->get();
    }

    public function render()
    {

        return view('livewire.chat.chat-list')
            ->layout('layouts.app'); // Specify the correct layout here
    }
}
