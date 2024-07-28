<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
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
        Route::get('/dashboard', function () {
            return view('dashboard-site.dashboard');
        });
        // Teacher
        
        Route::resource('/teacher', TeacherController::class)
            ->names([
                'index' => 'teacher-index',
                'create' => 'teacher-create'
            ]);


        // Student
        Route::resource('/student', StudentController::class)
            ->names([
                'index' => 'student-index',
                'create' => 'student-create'
            ]);
        //Level
        Route::resource('/level', LevelController::class)
            ->names([
                'index' => 'level-index',
                'create' => 'level-create'
            ]);

        // Classes    
        Route::resource(
            '/class', ClassController::class
        )->names([
                'index' => 'class-index',
                'create' => 'class-create'
            ]);

        // Section    
        Route::resource('/section', SectionController::class)
            ->names([
                'index' => 'section-index',
                'create' => 'section-create'
            ]);

        //Subjects    
        Route::resource('/subject', SubjectController::class)
            ->names([
                'index' => 'subject-index',
                'create' => 'subject-create'
            ]);
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
