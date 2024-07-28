<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class SectionController extends Controller
{
    public function index()
    {
        return view('dashboard-site.Section.section-list');
    }


    public function create()
    {
        return view('dashboard-site.Section.section-creation');

    }
}
