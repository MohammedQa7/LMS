<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        return view('dashboard-site.Level.level-list');
    }

    public function create()
    {
        return view('dashboard-site.Level.level-creation');
    }

    public function show($level_id)
    {
        # code...
    }
}
