<?php

namespace App\View\Components\dahsboard\chat;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class main-chat extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dahsboard.chat.main-chat');
    }
}
