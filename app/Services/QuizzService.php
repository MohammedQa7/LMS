<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\UserAnswers;
use App\Models\UserAttempts;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuizzService
{
    public function getQuizzes($class_id, $subject_id)
    {
        if ($class_id && $subject_id) {
            $quiz = Quiz::getQuizByClassAndSubject($class_id, $subject_id)
                ->where('end_date', '>', now())
                ->get();

            return $quiz;
        }
    }

    public function getQuestions($quiz_id): array
    {
        $shuffled_answers = [];
        $current_question = [];
        if ($quiz_id) {
            $questions = Question::where('quiz_id', $quiz_id)
                ->with('answers')
                ->get()
                ->shuffle();
            if ($questions) {
                foreach ($questions as $key => $single_question) {
                    $shuffled_answers = $single_question->answers?->shuffle();
                    $current_question[$key + 1] = [
                        'question_id' => $single_question->id,
                        'question_text' => $single_question->question_text,
                        'answers' => $shuffled_answers->map(function ($answer) {
                            return $answer->toArray();
                        })->all(),
                    ];
                }
                return $current_question;
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }

    }



    function UserAttemptsHandler($quiz_id, $user)
    {
        dd($user);
    }

    function AssignAttempt($quiz, $user)
    {
        $existing_attempt = UserAttempts::getSpecificAttempt($quiz, $user)->first();
        if (is_null($existing_attempt)) {
            $user_attempt = UserAttempts::create([
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
                'started_at' => now(),
                'is_active' => true,
                'score' => null
            ]);
            if ($user_attempt) {
                return $user_attempt;
            }
        } else {
            return $existing_attempt;
        }

    }


    function SessionTimer($quiz, $user_attempt)
    {
        $startTime = Carbon::parse($user_attempt->started_at);
        $timeLimit = $quiz->time_limit_in_seconds; // e.g., 300 seconds
        $endTime = $startTime->addSeconds($timeLimit);
        $remaining_timer = Carbon::now()->diffInSeconds($endTime, false);
        $remaining_timer = round($remaining_timer);
        return $remaining_timer;
        // if (Session::has('end_time')) {
        //     $end_time = Session::get('end_time');
        //     $remaining_timer = Carbon::now()->diffInSeconds($end_time['end_time'], false);
        //     return $remaining_timer = 2000;

        // } else {
        //     $remaining_timer = 0;
        //     Session::put('end_time', [
        //         'quiz_id' => $quiz->id,
        //         'end_time' => now()->addSeconds($quiz->time_limit_in_seconds)
        //     ]);
        //     $end_time = Session::get('end_time');
        //     $remaining_timer = Carbon::now()->diffInSeconds($end_time['end_time'], false);
        //     return $remaining_timer = 2000;
        // }

    }



    // this function is used to submit a quiz and force quit a quiz when the time is finished.
    function SubmitQuiz($current_question, $user_attempt)
    {
        // $this->remaining_timer = 0;
        /* 
        if the user did not answer any question and stayed at the first page of the questions,
        then there is no answerd questions to be stored at the session,
        so we have to set a key value store with a key of the question_id and value of null 
         */
        if (Session::has('selected_answer')) {
            $answer = Session::get('selected_answer', []);
        } else {
            foreach ($current_question as $key => $value) {
                $answer[$value['question_id']] = null;
            }
        }

        try {
            DB::beginTransaction();
            if ($answer) {
                // update the attemp state to false.
                $user_attempt->update([
                    'is_active' => false,
                ]);
                // looping through all the answers and creating entites in the UserAnswers table.
                foreach ($answer as $question_id => $answer_id) {
                    $answer = Answer::where('id', $answer_id)->first();
                    $user_answers_table = UserAnswers::create([
                        'user_id' => Auth::user()->id,
                        'quiz_id' => $this->quiz->id,
                        'question_id' => $question_id,
                        'answer_id' => $answer->id ?? null,
                        'is_correct' => $answer->is_correct ?? false,
                    ]);
                }
                DB::commit();
                Session::forget(['selected_answer', 'current_page', 'quiz_questions']);
                return redirect(route('level.index'));
            }
        } catch (\Throwable $th) {
            dd('something went wrong');
            DB::rollBack();
            return redirect(route('level.index'));
        }
    }



}