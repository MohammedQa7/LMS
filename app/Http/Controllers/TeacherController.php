<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return view('dashboard-site.Teacher.teacher-list');
    }

    public function create()
    {
        return view('dashboard-site.teacher.teacher-creation');
    }
    public function edit($email)
    {
        $teacher = Teacher::where('email' , $email)->first();
        return view('dashboard-site.teacher.teacher-creation')->with('teacher' , $teacher);
    }


    function login() {
        dd('login as teacher');

    }
}
