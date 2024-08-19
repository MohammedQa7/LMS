<?php

namespace App\Http\Middleware;

use App\Models\Quiz;
use App\Models\User;
use App\Models\UserAttempts;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class QuizAttemptChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // get the current student
        $user = User::where('id', Auth::user()->id)
            ->role('Student')
            ->with('studentLevelWithClasses')
            ->first();

        $quiz_id = $request->route('quiz_id');
        $quiz_id
            ? $quiz = Quiz::where('id', $quiz_id)->first()
            : null;
        if (isset($quiz) && !is_null($user) && $user->studentLevelWithClasses->class_id != $quiz->class_id) {
            abort(403);
        } else {
            $user_attempts = UserAttempts::where('quiz_id', $quiz_id)->count();
            $quiz_start_date = Carbon::parse($quiz->start_date);
            $quiz_end_date = Carbon::parse($quiz->end_date);
            if ($user_attempts >= $quiz->attempts || !now()->between($quiz_start_date, $quiz_end_date)) {
                abort(403);
            }
        }
        return $next($request);
    }
}