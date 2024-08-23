<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /* 
    using middlewares inside constructor,
    to make sure that only users with the right permissions access those specific routes and fucntions.
    -----(using spatie permissions package) 
     */
    public function __construct()
    {
        
        $this->middleware('role_or_permission:administrator|Manage Levels|Create Level')->only(['create', 'store']);
        $this->middleware('role_or_permission:administrator|Manage Levels')->only(['index', 'edit' , 'show' ,'delete']);
    }

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
        return view('dashboard-site.Level.level-edit')->with('level', $level);
    }

    public function show($level_id)
    {

    }
}