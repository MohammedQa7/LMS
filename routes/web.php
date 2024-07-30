<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        Route::get('/dashboard', function () {
            return view('dashboard-site.dashboard');
        });

        // Teacher
        Route::post('/teacher/login', [TeacherController::class, 'login'])
            ->name('teacher-login');
        Route::resource('/teacher', TeacherController::class)
            ->names('teacher');

        // Student
        Route::post('/student/login', [StudentController::class, 'login'])
            ->name('student-login');
        Route::resource('/student', StudentController::class)
            ->names('student');


        //Level
        Route::resource('/level', LevelController::class)
            ->names('level');

        // Classes    
        Route::resource(
            '/class',
            ClassController::class
        )->names('class');

        // Section    
        Route::resource('/section', SectionController::class)
            ->names('section');

        //Subjects    
        Route::resource('/subject', SubjectController::class)
            ->names('subject');
    }

);



// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
