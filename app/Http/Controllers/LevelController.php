<?php

namespace App\Http\Controllers;

use App\Models\Level;
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
    public function edit($slug)
    {
        // dd($slug);
        $level = Level::GetLevelBySlug($slug)->first();
        return view('dashboard-site.Level.level-edit')->with('level' , $level);
    }

    public function show($level_id)
    {
        
    }
}
