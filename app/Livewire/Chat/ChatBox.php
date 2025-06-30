<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Message;
use Livewire\Livewire;

class ChatBox extends Component
{
    public $body;
    public $loadedMessages;
    public $selectedConversation;
    // public $paginate_var=10;
    // protected $listeners=[
    //     'loadMore'
    // ];

    public function loadMore() : void {
    //     $this->paginate_var += 10;

    //     $this->loadMessages();

        $this->dispatch('update-chat-height');
    }

    public function loadMessages() {
        // $count= Message::where('conversation_id', $this->selectedConversation->id)->count();
        $this->loadedMessages=Message::where('conversation_id', $this->selectedConversation->id)
        // ->skip($count-$this->paginate_var)
        // ->take($this->paginate_var)
        ->get();

        // return $this->loadedMessages;
    }

    public function sendMessage() {
        $this->validate([
            'body'=>'required|string'
        ]);

        $createdMessage= Message::create([
            'conversation_id'=>$this->selectedConversation->id,
            'sender_id'=>auth()->id(),
            'receiver_id'=>$this->selectedConversation->getReceiver()->id,
            'body'=>$this->body,
        ]);

        $this->reset('body');

        // $this->dispatch('scroll-bottom');

        $this->js(<<<'JS'
            window.dispatchEvent(new CustomEvent('scroll-bottom'));
        JS);

        // Kirim Pesannya
        $this->loadedMessages->push($createdMessage);

        // update conversation model
        $this->selectedConversation->updated_at= now();
        $this->selectedConversation->save();

        // Refresh inbox
        $this->dispatch('refresh')->to('chat.inbox');
    }

    public function mount() {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}