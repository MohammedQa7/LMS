<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{


    function create($class_id)
    {
        if ($class_id) {
            return view('dashboard-site.Quiz.quiz-creation')->with([
                'class_id' => $class_id,
            ]);
        }else{
            abort(404);
        }
        
    }

    function edit($id)
    {

    }
}