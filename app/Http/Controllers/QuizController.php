<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
{


    function create($class_id, $subject_id)
    {
        // check if the user is allowed to create a quiz for specific class
        $this->authorize('createQuizForClass', [Classes::class, $class_id, $subject_id]);
        if ($class_id && $subject_id) {
            return view('dashboard-site.Quiz.quiz-creation')->with([
                'class_id' => $class_id,
                'subject_id' => $subject_id,
            ]);
        } else {
            abort(404);
        }

    }

    function startQuiz($quiz_id)
    {

        if ($quiz_id) {
            $quiz = Quiz::where('id', $quiz_id)->first();
            if ($quiz) {
                $quiz->time_limit_in_seconds = Carbon::parse($quiz->time_limit)->secondsSinceMidnight();
                return view('dashboard-site.Quiz.quiz')->with([
                    'quiz' => $quiz,
                ]);
            } else {
                abort(404);
            }
        }
        abort(404);
    }

    function edit($id)
    {

    }
}