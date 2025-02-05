<?php

namespace App\Livewire\Chat;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Models\Conversation;

class CreateChat extends Component
{
    public $users;
    public $message = 'hello how are you';


    public function checkConversation($receiverId)
    {
        // dd($receiverId);

        $checkedConversation = Conversation::where('receiver_id', auth()->user()->id)->where('sender_id', $receiverId)->orwhere('receiver_id', $receiverId)->where('sender_id', auth()->user()->id)->get();


        if (count($checkedConversation) == 0) {


            // dd('no conversation');

            $createdConversation = Conversation::create([
                'receiver_id' => $receiverId, 
                'sender_id' => auth()->user()->id,
                'last_time_message'=>now()
            ]);

            //conversation created

            $createdMessage = Message::create([
                'conversation_id' => $createdConversation->id, 
                'sender_id' => auth()->user()->id, 
                'receiver_id' => $receiverId,
                'body'=>$this->message
            ]);

            $createdConversation->last_time_message = $createdMessage->created_at;
            $createdConversation->save();

            dd($createdMessage); 

            dd('saved');



            
        } else if (count($checkedConversation) >= 1) {
            dd('converstion exists');
        }
    }

    public function render()
    {
        $this->users = User::where('id', '!=', auth()->user()->id)->get();

        return view('livewire.chat.create-chat')
            ->layout('layouts.app'); // Specify the correct layout here
    }
}
