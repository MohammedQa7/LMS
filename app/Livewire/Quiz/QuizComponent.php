<?php

namespace App\Livewire\Quiz;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\UserAnswers;
use App\Services\QuizzService;
use App\Traits\NotificationTrait;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class QuizComponent extends Component
{
    use NotificationTrait;

    // Quiz Service
    protected QuizzService $quizSerivce;
    // selected Quiz ;
    public $quiz;
    public $remaining_timer;

    // current page to determine whice question is visabile
    public $current_page = 1;
    // current question that the user is in whether it is the first question or the last one.
    public $current_question = [];
    public $selected_answers = [];

    public $user_attempt;
    function mount($quiz, QuizzService $quizService)
    {
        // dependency injection
        $this->quizSerivce = $quizService;
        if ($quiz) {
            $this->remaining_timer = 0;
            // Assinging New Attempt if it does not exists.
            $this->user_attempt = $quizService->AssignAttempt($quiz, Auth::user());
            // NEW TIMER
            $this->remaining_timer = $quizService->SessionTimer($quiz, $this->user_attempt);


            // handling questions and storing them into session.
            if (Session::has('quiz_questions')) {
                $this->current_question = Session::get('quiz_questions');
            } else {
                $this->Questions();
                Session::put('quiz_questions', $this->current_question);
            }

            // handling current page on refresh to not reset the curren page value ,
            if (Session::has('current_page')) {
                $this->current_page = Session::get('current_page');
            } else {
                Session::put('current_page', 1);
            }

            // handling the selected value for the current page , so when he refresh the page he will see the previous selected answer
            if (Session::has('selected_answer')) {
                $answer = Session::get('selected_answer', []);
                try {
                    $this->selected_answers = $answer[$this->current_question[$this->current_page]['question_id']];
                } catch (\Throwable $th) {

                }
            }

        }
    }

    function Questions()
    {
        $this->current_question = $this->quizSerivce->getQuestions($this->quiz->id);
    }


    #[On('forceQuit')]
    function ForceQuitQuiz(QuizzService $quizzService)
    {
        $final_score = 0;
        $this->remaining_timer = 0;
        // $this->remaining_timer = 0;
        /* 
        if the user did not answer any question and stayed at the first page of the questions,
        then there is no answerd questions to be stored at the session,
        so we have to set a key value store with a key of the question_id and value of null 
         */
        if (Session::has('selected_answer')) {
            $answer = Session::get('selected_answer');
        } else {
            foreach ($this->current_question as $key => $value) {
                $answer[$value['question_id']] = null;

            }
        }



        try {
            DB::beginTransaction();
            if ($answer) {
                foreach ($answer as $key => $single_answer) {
                    if (isset($single_answer)) {
                        $asnwer_DB = Answer::where('id', $single_answer)->first();
                        $question = Question::where('id', $key)->first();
                        if ($asnwer_DB) {
                            if ($asnwer_DB->is_correct) {
                                $final_score += $question->score;
                            }
                            // else nothing
                        }
                        // no asnwer were found // do nothing
                    }
                    // if the data was null
                }

                // update the attemp state to false and the score 
                $this->user_attempt->update([
                    'is_active' => false,
                    'score' => $final_score,
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
                $final_score = 0;
                Session::forget(['selected_answer', 'current_page', 'quiz_questions']);
                $this->success('Quiz Submitted', null, 2000);
                return redirect(route('student-portal.index'));
            }
        } catch (\Throwable $th) {
            $final_score = 0;
            dd($th);
            DB::rollBack();
            $this->failed('Something went wrong while submitting your quiz answers');
            return redirect(route('student-portal.index'));
        }
    }


    function submit($question_number = null, QuizzService $quizzService)
    {

        $answer = Session::get('selected_answer', []);
        $answer[$this->current_question[$this->current_page]['question_id']] = $this->selected_answers;
        Session::put('selected_answer', $answer);


        if ((int) $question_number == count($this->current_question)) {
            $this->current_page = $question_number;
            Session::put('current_page', $this->current_page);
            // setting the value of the selected answer on the current page from session so when the user navigate to another page it will indicate what answer he selected.
            $this->selected_answers = $answer[$this->current_question[$this->current_page]['question_id']];
            $this->ForceQuitQuiz($quizzService);
        } else if ((int) $question_number < count($this->current_question)) {
            $this->current_page = $question_number;
            Session::put('current_page', $this->current_page);
            // setting the value of the selected answer on the current page from session so when the user navigate to another page it will indicate what answer he selected.
            $this->selected_answers = $answer[$this->current_question[$this->current_page]['question_id']];

        } else {
            $this->failed('somehting went wrong while navigating to the next question, please try again.');
        }
    }




    public function render()
    {
        return view('livewire.quiz.quiz-component', [
            'questions' => $this->current_question,
        ]);

    }
}