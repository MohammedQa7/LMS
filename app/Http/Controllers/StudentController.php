<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboard-site.Student.student-list');
    }

    public function create()
    {
        return view('dashboard-site.Student.student-creation');
    }
    public function edit($email)
    {
        $isEditable = true;
        $student = User::with('studentLevelWithClasses')->where('email', $email)->role('student')->first();
        return view('dashboard-site.Student.student-creation')->with([
            'student'=> $student,
            'isEditable' => $isEditable,
        ]);
    }
}
