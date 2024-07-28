<?php

namespace App\Http\Controllers;

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
}
