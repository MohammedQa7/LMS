<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GlobalNotifications extends Component
{

    function ToggleNotifications()
    {
        $this->dispatch('open-modal' , name:'notificationModal');
    }

    public function render()
    {
        return view('livewire.global-notifications');
    }
}