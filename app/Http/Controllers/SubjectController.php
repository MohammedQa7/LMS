<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return view('dashboard-site.Subject.subject-list');
    }

    public function create()
    {
        return view('dashboard-site.Subject.subject-creation');
    }
}
