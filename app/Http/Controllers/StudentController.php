<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Topic;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $topics = Topic::all('id', 'name');
        return view('student.index', compact('topics'));
    }

    public function topic(Request $request){
        // $topics = Topic::where('name', '=', $request->name)->get();
        $subjects = Subject::where('topic_id', '=', $request->id)->get();
        return view('student.topic', compact('subjects'));
    }

    public function listening(){
        return view('student.listening');
    }
    
}
