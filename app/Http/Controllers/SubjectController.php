<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Create Subject|Manage Subjects')->only(['create', 'store']);
        $this->middleware('permission:Manage Subjects')->only(['index', 'edit', 'show', 'delete']);
    }
    public function index()
    {
        return view('dashboard-site.Subject.subject-list');
    }

    public function create()
    {
        return view('dashboard-site.Subject.subject-creation');
    }

    public function edit($slug)
    {
        $subject = Subject::GetSubjectBySlug($slug)->with('level')->first();
        return view('dashboard-site.Subject.subject-edit')->with('subject', $subject);
    }
}