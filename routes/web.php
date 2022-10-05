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
    Route::post('add-topic', [AdminController::class, 'addTopic'])->name('admin.add.topic');
    Route::get('topic-list', [AdminController::class, 'topic_list'])->name('admin.topic.list');
    Route::post('topic-detail', [AdminController::class, 'topic_detail'])->name('admin.topic.detail');
    Route::post('topic-update', [AdminController::class, 'updateTopic'])->name('admin.update.topic');
    Route::post('delete-topic', [AdminController::class, 'deleteTopic'])->name('admin.delete.topic');
    // Subject
    Route::get('subject', [AdminController::class, 'subject'])->name('admin.subject');
    Route::post('add-subject', [AdminController::class, 'addSubject'])->name('admin.add.subject');
    Route::get('subject-list', [AdminController::class, 'subject_list'])->name('admin.subject.list');
    Route::post('subject-detail', [AdminController::class, 'subject_detail'])->name('admin.subject.detail');
    Route::post('subject-update', [AdminController::class, 'updatesubject'])->name('admin.update.subject');
    Route::post('delete-subject', [AdminController::class, 'deleteSubject'])->name('admin.delete.subject');
    // Exercise
    Route::get('exercise', [AdminController::class, 'exercise'])->name('admin.exercise');
    Route::post('add-exercise', [AdminController::class, 'addExercise'])->name('admin.add.exercise');
    Route::get('exercise-list', [AdminController::class, 'exercise_list'])->name('admin.exercise.list');
    Route::post('exercise-detail', [AdminController::class, 'exercise_detail'])->name('admin.exercise.detail');
    Route::post('exercise-update', [AdminController::class, 'updateExercise'])->name('admin.update.exercise');
    Route::post('delete-exercise', [AdminController::class, 'deleteExercise'])->name('admin.delete.exercise');
    // Student Exercise
    Route::get('std-exercise', [AdminController::class, 'std_exercise'])->name('admin.std_exercise');
    Route::post('add-std-exercise', [AdminController::class, 'addStdExercise'])->name('admin.add.std_exercise');
    Route::get('std-exercise-list', [AdminController::class, 'std_exercise_list'])->name('admin.std_exercise.list');
    Route::post('std-exercise-detail', [AdminController::class, 'std_exercise_detail'])->name('admin.std_exercise.detail');
    Route::post('std-exercise-update', [AdminController::class, 'updateStdExercise'])->name('admin.update.std_exercise');
    Route::post('delete-std-exercise', [AdminController::class, 'deleteStdExercise'])->name('admin.delete.std_exercise');
    // Student Learning
    Route::get('std-learning', [AdminController::class, 'std_learning'])->name('admin.std_learning');
    Route::post('add-std-learning', [AdminController::class, 'addStdLearning'])->name('admin.add.std_learning');
    Route::get('std-learning-list', [AdminController::class, 'std_learning_list'])->name('admin.std_learning.list');
    Route::post('std-learning-detail', [AdminController::class, 'std_learning_detail'])->name('admin.std_learning.detail');
    Route::post('std-learning-update', [AdminController::class, 'updateStdLearning'])->name('admin.update.std_learning');
    Route::post('delete-std-learning', [AdminController::class, 'deleteStdLearning'])->name('admin.delete.std_learning');

});

Route::group(['prefix' => 't', 'middleware' => ['teacher', 'auth', 'pvb']], function () {
    Route::get('home', [TeacherController::class, 'index'])->name('teacher.home');
});

Route::group(['prefix' => 's', 'middleware' => ['student', 'auth', 'pvb']], function () {
    Route::get('home', [StudentController::class, 'index'])->name('student.home');
    Route::get('topic/{id}', [StudentController::class, 'topic'])->name('student.topic');
    Route::get('level/{id}', [StudentController::class, 'level'])->name('student.level');
    Route::get('topic/listening', [StudentController::class, 'listening'])->name('student.topic.listening');
    Route::get('exercise/{id}', [StudentController::class, 'exercise'])->name('student.exercise');
    Route::get('history/{id}', [StudentController::class, 'historyAnswer'])->name('student.history');
    Route::post('exercise/submit', [StudentController::class, 'submitAnswer'])->name('student.submit');
});