<?php

namespace App\Services;

use App\Models\ZoomMeeting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ZoomMeetingService
{
    function meetings($class_id, $subejct_id)
    {
        $class_id && $subejct_id
            ? $all_meetings = ZoomMeeting::specificMeeting($class_id, $subejct_id)->get()
            : null;
            
        foreach ($all_meetings as $single_meeting) {
            $single_meeting->start_at = Carbon::parse($single_meeting->start_at);
        }
        return $all_meetings;
    }
}