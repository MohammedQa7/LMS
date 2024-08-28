<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:administrator|Create Section|Manage Sections')->only(['create', 'store']);
        $this->middleware('role_or_permission:administrator|Manage Sections')->only(['index', 'edit', 'show', 'delete']);
    }
    public function index()
    {
        return view('dashboard-site.Section.section-list');
    }

    public function create()
    {
        return view('dashboard-site.Section.section-creation');

    }

    public function edit($slug)
    {
        $section = Section::GetSectionBySlug($slug)->first();
        return view('dashboard-site.Section.section-edit')->with('section', $section);

    }
}