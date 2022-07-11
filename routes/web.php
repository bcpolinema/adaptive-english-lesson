<?php

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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['middleware' => 'pvb'])->group(function () {
    Auth::routes();
});

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'a', 'middleware' => ['admin', 'auth', 'pvb']], function () {
    Route::get('home', [AdminController::class, 'index'])->name('admin.home');
    // Topic
    Route::get('topic', [AdminController::class, 'topic'])->name('admin.topic');
    Route::get('topic-list', [AdminController::class, 'topic_list'])->name('admin.topic.list');
    Route::post('add-topic', [AdminController::class, 'addTopic'])->name('admin.add.topic');
    // Subject
    Route::get('subject', [AdminController::class, 'subject'])->name('admin.subject');
    Route::post('add-subject', [AdminController::class, 'addSubject'])->name('admin.add.subject');
    // Exercise
    Route::get('exercise', [AdminController::class, 'exercise'])->name('admin.exercise');
    Route::post('add-exercise', [AdminController::class, 'addExercise'])->name('admin.add.exercise');
    // Student Exercise
    Route::get('std-exercise', [AdminController::class, 'std_exercise'])->name('admin.std_exercise');

    // Student Learning
    Route::get('std-learning', [AdminController::class, 'std_learning'])->name('admin.std_learning');

});

Route::group(['prefix' => 't', 'middleware' => ['teacher', 'auth', 'pvb']], function () {
    Route::get('home', [TeacherController::class, 'index'])->name('teacher.home');
});

Route::group(['prefix' => 's', 'middleware' => ['student', 'auth', 'pvb']], function () {
    Route::get('home', [StudentController::class, 'index'])->name('student.home');
    Route::get('topic/listening', [StudentController::class, 'listening'])->name('student.topic.listening');
});