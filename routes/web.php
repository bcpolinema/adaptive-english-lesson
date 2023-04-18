<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('landing-page');
});

Route::middleware(['middleware' => 'pvb'])->group(function () {
    Auth::routes();
});

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'a', 'middleware' => ['admin', 'auth', 'pvb']], function () {
    Route::get('home', [AdminController::class, 'index'])->name('admin.home');
    // Subject
    Route::get('subject', [AdminController::class, 'subject'])->name('admin.subject');
    Route::post('add-subject', [AdminController::class, 'addSubject'])->name('admin.add.subject');
    Route::get('subject-list', [AdminController::class, 'subject_list'])->name('admin.subject.list');
    Route::post('subject-detail', [AdminController::class, 'subject_detail'])->name('admin.subject.detail');
    Route::post('subject-update', [AdminController::class, 'updateSubject'])->name('admin.update.subject');
    Route::post('delete-subject', [AdminController::class, 'deleteSubject'])->name('admin.delete.subject');
    // Topic
    Route::get('topic', [AdminController::class, 'topic'])->name('admin.topic');
    Route::post('add-topic', [AdminController::class, 'addTopic'])->name('admin.add.topic');
    Route::get('topic-list', [AdminController::class, 'topic_list'])->name('admin.topic.list');
    Route::post('topic-detail', [AdminController::class, 'topic_detail'])->name('admin.topic.detail');
    Route::post('topic-update', [AdminController::class, 'updateTopic'])->name('admin.update.topic');
    Route::post('delete-topic', [AdminController::class, 'deleteTopic'])->name('admin.delete.topic');
     // Route
     Route::get('route', [AdminController::class, 'route'])->name('admin.route');
     Route::post('add-route', [AdminController::class, 'addRoute'])->name('admin.add.route');
     Route::get('route-list', [AdminController::class, 'route_list'])->name('admin.route.list');
     Route::post('route-detail', [AdminController::class, 'route_detail'])->name('admin.route.detail');
     Route::post('route-update', [AdminController::class, 'updateRoute'])->name('admin.update.route');
     Route::post('delete-route', [AdminController::class, 'deleteRoute'])->name('admin.delete.route');
    // Level
    Route::get('level', [AdminController::class, 'level'])->name('admin.level');
    Route::post('add-level', [AdminController::class, 'addLevel'])->name('admin.add.level');
    Route::get('level-list', [AdminController::class, 'level_list'])->name('admin.level.list');
    Route::get('get-topics-by-subject', [AdminController::class, 'getTopicBySubject'])->name('admin.level.get.topic');
    Route::get('get-f-topics-by-f-subject', [AdminController::class, 'getFTopicByFSubject'])->name('admin.level.get.f.topic');
    Route::get('get-f-title-by-f-topics', [AdminController::class, 'getFTitleByFTopic'])->name('admin.level.get.f.title');
    Route::post('level-detail', [AdminController::class, 'level_detail'])->name('admin.level.detail');
    Route::post('level-update', [AdminController::class, 'updateLevel'])->name('admin.update.level');
    Route::post('delete-level', [AdminController::class, 'deleteLevel'])->name('admin.delete.level');
    // Exercise
    Route::get('exercise', [AdminController::class, 'exercise'])->name('admin.exercise');
    Route::post('add-exercise', [AdminController::class, 'addExercise'])->name('admin.add.exercise');
    Route::get('exercise-list', [AdminController::class, 'exercise_list'])->name('admin.exercise.list');
    Route::post('exercise-detail', [AdminController::class, 'exercise_detail'])->name('admin.exercise.detail');
    Route::post('exercise-update', [AdminController::class, 'updateExercise'])->name('admin.update.exercise');
    Route::post('delete-exercise', [AdminController::class, 'deleteExercise'])->name('admin.delete.exercise');

});

Route::group(['prefix' => 't', 'middleware' => ['teacher', 'auth', 'pvb']], function () {
    Route::get('home', [TeacherController::class, 'index'])->name('teacher.home');
});

Route::group(['prefix' => 's', 'middleware' => ['student', 'auth', 'pvb']], function () {
    Route::get('home', [StudentController::class, 'index'])->name('student.home');
    Route::get('subject/{id}', [StudentController::class, 'subject'])->name('student.subject');
    Route::get('topic/{tpc_id}', [StudentController::class, 'level_list'])->name('student.level_list');
    Route::get('{std_id}/content/{id}', [StudentController::class, 'level']);
    Route::get('{std_id}/exercise/{id}', [StudentController::class, 'exercise']);
    Route::post('exercise/submit', [StudentController::class, 'submitAnswer'])->name('student.submit');
    Route::post('start', [StudentController::class, 'stdStart'])->name('student.start');
    Route::post('take_exercise', [StudentController::class, 'stdTakeExercise'])->name('student.take.exercise');
});