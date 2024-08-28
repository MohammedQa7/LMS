<?php

use App\Http\Controllers\adminstrators\RolesController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPortal\GradesController;
use App\Http\Controllers\StudentPortal\StudentPortalController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Zoom\ZoomController;
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

        
        //  Dashboard Routes
        Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

        Route::get('test', [dashboardController::class, 'viewTest']);
        Route::post('store/test', [dashboardController::class, 'testArea']);

        Route::prefix('/portal/student')->middleware(['auth:sanctum', 'role:student', 'verified'])->group(function () {
            // Dashbaord For the studens
            Route::resource('', StudentPortalController::class)->names('student-portal');
            // Students Grades
            Route::get('/grades', GradesController::class)->name('student-grades');

            // only students who is associated with the class can access the quiz
            Route::get('/quiz/{quiz_id}/start', [QuizController::class, 'startQuiz'])->name('start-quiz')->middleware('QuizAttemptChecker');
        });




        // Edit :  make 2 separate gropes from teachers and administrators.
        // Teacher and administrator Grouped Routes
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

            // Creating Quiz
            Route::get('/quiz/{class_id}/{subject_id}/create', [QuizController::class, 'create'])->name('create-quiz');

            // Zoom Meetings
            Route::get('zoom/meetings', [ZoomController::class, 'index'])->name('zoom-meeting-index');


        });


        // global routes for all type of users Routes
        // View Materials and Download them should be accessible to all user types.
        Route::middleware(['role:teacher|administrator|student'])->group(function () {
            // show materials that belongs to a subject / class
            Route::get('/material/{class_slug}/{subject_slug}/view', [MaterialController::class, 'showSpecificMaterial'])->name('specific-subject-material');
            Route::get('/material/{file_id?}/{file_name?}/download', [MaterialController::class, 'download'])->name('download_file');

            // chat routes
            Route::resource('/chat', ChatController::class)->names('chat');

        });

        // Promoting Students (ADMINSTRATOR)
        Route::middleware(['role_or_permission:administrator|Manage Student Promotions'])->group(function () {
            // Promotion for students
            Route::resource('promotion/student', PromotionsController::class)->names('student-promotion');
        });

        // Roles And Permissions
        Route::middleware(['role_or_permission:administrator|Manage Roles'])->group(function () {
            // Creating roles and assign them to specific permissions and users.
            Route::resource('/roles-permissions', RolesController::class)->names('roles');
        });


        // // if route not found redirect to the homepage / main page
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
