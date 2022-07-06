<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminController extends Controller
{ 
    public function index(){
        return view('admin.index');
    }

    public function index_exercises(){
        return view('admin.exercises');
    }

    public function index_std_exercises(){
        return view('admin.std_exercises');
    }

    public function index_std_learnings(){
        return view('admin.std_learnings');
    }

    public function index_subjects(){
        return view('admin.subjects');
    }

    public function index_topics(){
        return view('admin.topics');
    }
}
