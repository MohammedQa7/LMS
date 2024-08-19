<?php

namespace App\View\Components\dashbaord\StudentPortal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ZoomMeetingComponent extends Component
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
        return view('components.dashbaord.student-portal.zoom-meeting-component');
    }
}
