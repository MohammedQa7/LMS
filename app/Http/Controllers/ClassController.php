<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        return view('dashboard-site.Class.class-list');
    }

    public function create()
    {
        return view('dashboard-site.Class.class-creation');
    }
}
