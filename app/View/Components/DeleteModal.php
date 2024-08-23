<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteModal extends Component
{
    public $user;
    public $role;
    public $permission;


    public function __construct($role=null, $user = null, $permission = null)
    {
        $this->role = $role;
        $this->user = $user;
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-modal');
    }
}