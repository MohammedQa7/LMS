<?php

namespace App\View\Components\dashboard\chat\modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class new-contact-modal extends Component
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
        return view('components.dashboard.chat.modal.new-contact-modal');
    }
}
