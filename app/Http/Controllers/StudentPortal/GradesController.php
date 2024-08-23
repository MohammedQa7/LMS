<?php

namespace App\Http\Controllers\StudentPortal;

use App\Http\Controllers\Controller;
use App\Models\UserAttempts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradesController extends Controller
{
    function __invoke()
    {
        $user_grades = UserAttempts::
            with('quiz')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('student-portal.grades', [
            'user_grades' => $user_grades,
        ]);
    }
}