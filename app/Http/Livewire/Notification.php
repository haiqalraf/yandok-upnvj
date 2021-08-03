<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $dropdown = false;
    public $showCount = false;
    public $count = 0;

    public function mount()
    {
        if (auth()->user()->unreadNotifications->count()>=1) {
            $this->showCount = true;
            $this->count = auth()->user()->unreadNotifications->count();
        }
    }

    public function render()
    {
        return view('livewire.notification');
    }

    public function read()
    {
        if ($this->showCount) {
            $this->showCount = false;
            $this->count -= auth()->user()->unreadNotifications->count();
            auth()->user()->unreadNotifications->markAsRead();
        }
        $this->dropdown = !$this->dropdown;
    }

    public function increment()
    {
        $this->count++;
    }
}
