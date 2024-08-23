<?php

namespace App\Http\Controllers\adminstrators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    function index()
    {
        return view('dashboard-site.Roles-Permissions.roles');
    }

    function create()
    {

    }

    function edit()
    {

    }

}