<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExpedientController;
use App\Http\Controllers\PercentageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 *
 */
Route::pattern('id', '\d+');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('/', function () {
    return redirect()->route('login');
});

// Global group
Route::middleware(['auth', 'can:teacher-admin'])->group(function () {

    // Student view access page
    Route::prefix('student')->group(function () {
        Route::get('/', [StudentController::class, 'index']);
        Route::get('create', [StudentController::class, 'create']);
        Route::get('edit/{id}', [StudentController::class, 'edit']);
        Route::post('store', [StudentController::class, 'store']);
        Route::put("update/{id}", [StudentController::class, 'update']);
        Route::delete('delete/{id}', [StudentController::class, 'destroy']);
    });

    // Admin view access page
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('create', [AdminController::class, 'create']);
        Route::get('edit/{id}', [AdminController::class, 'edit']);
        Route::post('store', [AdminController::class, 'store']);
        Route::put("update/{id}", [AdminController::class, 'update']);
        Route::delete('delete/{id}', [AdminController::class, 'destroy']);
    });

    // Teacher view access page
    Route::prefix('teacher')->group(function () {
        Route::get('/', [TeacherController::class, 'index']);
        Route::get('create', [TeacherController::class, 'create']);
        Route::get('edit/{id}', [TeacherController::class, 'edit']);
        Route::post('store', [TeacherController::class, 'store']);
        Route::put("update/{id}", [TeacherController::class, 'update']);
        Route::delete('delete/{id}', [TeacherController::class, 'destroy']);
    });
});

Route::middleware(['auth', 'can:admin'])->group(function () {

    // Schedule view access page
    Route::prefix('schedule')->group(function () {
        Route::get('/', [ScheduleController::class, 'index']);
        Route::get('create', [ScheduleController::class, 'create']);
        Route::get('edit/{id}', [ScheduleController::class, 'edit']);
        Route::post('store', [ScheduleController::class, 'store']);
        Route::put("update/{id}", [ScheduleController::class, 'update']);
        Route::delete('delete/{id}', [ScheduleController::class, 'destroy']);
    });


    // Courses view access page
    Route::prefix('course')->group(function () {
        Route::get('/', [CourseController::class, 'index']);
        Route::get('create', [CourseController::class, 'create']);
        Route::get('edit/{id}', [CourseController::class, 'edit']);
        Route::post('store', [CourseController::class, 'store']);
        Route::put("update/{id}", [CourseController::class, 'update']);
        Route::delete('delete/{id}', [CourseController::class, 'destroy']);
    });

    // Subject view page access
    Route::prefix('subject')->group(function () {
        Route::get('/', [SubjectController::class, 'index']);
        Route::get('create', [SubjectController::class, 'create']);
        Route::get('edit/{id}', [SubjectController::class, 'edit']);
        Route::post('store', [SubjectController::class, 'store']);
        Route::put("update/{id}", [SubjectController::class, 'update']);
        Route::delete('delete/{id}', [SubjectController::class, 'destroy']);
    });

    // Percentage view page access
    Route::prefix('percentage')->group(function () {
        Route::get('/', [PercentageController::class, 'index']);
        Route::get('create', [PercentageController::class, 'create']);
        Route::get('edit/{id}', [PercentageController::class, 'edit']);
        Route::post('store', [PercentageController::class, 'store']);
        Route::put("update/{id}", [PercentageController::class, 'update']);
        Route::delete('delete/{id}', [PercentageController::class, 'destroy']);
    });
});

// Expedient view page access
Route::prefix('expedient')->middleware(['auth', 'can:student'])->group(function () {
    Route::get('/', [ExpedientController::class, 'index']);
});

// Teacher, admin access group
Route::middleware(['auth', 'can:teacher-admin'])->group(function(){
    // Work view page access
    Route::prefix('work')->group(function(){
        Route::get('/', [WorkController::class, 'index']);
        Route::get('create', [WorkController::class, 'create']);
        Route::get('edit/{id}', [WorkController::class, 'edit']);
        Route::post('store', [WorkController::class, 'store']);
        Route::put("update/{id}", [WorkController::class, 'update']);
        Route::delete('delete/{id}', [WorkController::class, 'destroy']);
    });

// Exam view page access
    Route::prefix('exam')->group(function () {
        Route::get('/', [ExamController::class, 'index']);
        Route::get('create', [ExamController::class, 'create']);
        Route::get('edit/{id}', [ExamController::class, 'edit']);
        Route::post('store', [ExamController::class, 'store']);
        Route::put("update/{id}", [ExamController::class, 'update']);
        Route::delete('delete/{id}', [ExamController::class, 'destroy']);
    });
});



// Profile view page access
Route::prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('/', [ProfileController::class, 'index']);
    Route::put("update/{id}", [ProfileController::class, 'update']);
});

// Home page access
Route::prefix('home')->middleware(['auth', 'can:student,teacher'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);
    Route::get('/assign', [WelcomeController::class, 'assign']);
});

Route::get('/calendar', [CalendarController::class, 'index'])->middleware('auth');

Auth::routes();
