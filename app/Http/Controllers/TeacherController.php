<?php

namespace App\Http\Controllers;

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
}
