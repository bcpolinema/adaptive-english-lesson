<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $topics = Topic::all();
        return view('student.index', compact('topics'));
    }

    public function topic(Request $request){
        $topics = Topic::where('name', '=', $request->name)->get();
        return view('student.topic', compact('topics'));
    }

    public function listening(){
        return view('student.listening');
    }
    
}
