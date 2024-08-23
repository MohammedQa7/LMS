<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Create Teacher|Manage Teachers')->only(['create', 'store']);
        $this->middleware('permission:Manage Teachers')->only(['index', 'edit', 'show', 'delete']);
    }
    // Normal Functions
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
        $teacher = User::role('teacher')->where('email', $email)->with('levels', 'classes')->first();
        return view('dashboard-site.teacher.teacher-creation')->with('teacher', $teacher);
    }



}