<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:administrator|Create Class | Manage Classes')->only(['create', 'store']);
        $this->middleware('role_or_permission:administrator|Manage Classes')->only(['index', 'edit', 'show', 'delete']);
    }
    public function index()
    {
        return view('dashboard-site.Class.class-list');
    }

    public function edit($slug)
    {
        $class = Classes::GetClassBySlug($slug)->first();
        return view('dashboard-site.Class.class-edit')->with('class', $class);
    }

    public function create()
    {
        return view('dashboard-site.Class.class-creation');
    }
}