<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    function index()
    {
        return view('dashboard-site.StudentPromotions.promotions');
    }

    function create()
    {

    }

    function revert()
    {

    }
}