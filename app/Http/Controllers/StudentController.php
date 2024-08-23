<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Create Student|Manage Students')->only(['create', 'store']);
        $this->middleware('permission:Manage Students')->only(['index', 'edit', 'show', 'delete']);
    }
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
            'student' => $student,
            'isEditable' => $isEditable,
        ]);
    }
}