<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPortal\StudentPortalController;
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
// Student Grouped Routes

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['auth', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        // making livewire to work when using Mcamara translation duo to the extra prefix that mcamara has "/en"
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        // Dashboard Routes
        Route::get('/', function () {
            return view('dashboard-site.dashboard');
        })->name('dashboard');


        Route::middleware(['auth:sanctum', 'verified'])->group(function () {
            Route::resource('/protal/studnet', StudentPortalController::class)->names('student-portal');
        });




        // Edit :  make 2 seperate groupes from teachers and adminstartors.
        // Teacher and adminstrator Grouped Routes
        Route::middleware(['role:teacher|administrator'])->group(function () {
            //Teacher
            Route::resource('/teacher', TeacherController::class)->names('teacher');
            // Student
            Route::resource('/student', StudentController::class)->names('student');
            //Level
            Route::resource('/level', LevelController::class)->names('level');

            // Classes
            Route::resource('/class', ClassController::class)->names('class');

            // Section
            Route::resource('/section', SectionController::class)->names('section');

            //Subjects
            Route::resource('/subject', SubjectController::class)->names('subject');
        });

        // View Materials and Download them should be acceable to all user types.
        Route::middleware(['role:teacher|administrator|student'])->group(function () {
            // show materials that belongs to a subject / class
            Route::get('/material/{class_slug}/{subject_slug}/view', [MaterialController::class, 'showSpecificMaterial'])->name('specific-subject-material');
            Route::get('/material/{file_id?}/{file_name?}/download', [MaterialController::class, 'download'])->name('download_file');
        });

        // if route not found redirect to the homepage / main page
        // Route::fallback(function () {
        //     return redirect('/');
        // });
    },
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
