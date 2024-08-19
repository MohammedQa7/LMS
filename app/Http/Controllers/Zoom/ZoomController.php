<?php

namespace App\Http\Controllers\Zoom;

use App\Http\Controllers\Controller;
use App\Models\ZoomMeeting;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    function index() {
        $meetings = ZoomMeeting::get();
        return view('dashboard-site.zoom.zoom')->with([
            'meetings' => $meetings
        ]);
    }
}
