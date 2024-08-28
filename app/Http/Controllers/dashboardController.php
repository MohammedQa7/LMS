<?php

namespace App\Http\Controllers;

use App\Models\TextEditorTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{

    
    function viewTest()
    {
        $data = TextEditorTest::get();
        $arrayData = [12, 23,44,12,123];
        return view('test' ,[
            'data'=> $data,
            'arrayData' => $arrayData,
        ]);
    }
    function testArea(Request $request)
    {
        $content = $request['content'];
        $editor = TextEditorTest::create([
            'content' => $content,
        ]);
    }
    function index()
    {
        return view('dashboard-site.dashboard');
    }
}