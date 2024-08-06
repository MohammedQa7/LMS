<?php

namespace App\Http\Controllers\StudentPortal;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPortalController extends Controller
{
    function index()
    {
        if (Auth::user()) {
            $user = User::where('id', Auth::user()->id)->with('studentLevelWithClasses.class')->first();
            $all_subjects = Subject::getSubjectByLevel($user)
                ->with([
                    'teacher' => function ($query) use ($user) {
                        $query->where('class_id', $user->studentLevelWithClasses->class_id);
                    }
                ], 'teacher.class')
                ->get();
        }

        return view('student-portal.dashboard')->with([
            'all_subjects'=> $all_subjects,
            'user'=> $user,
        ]);
    }
}