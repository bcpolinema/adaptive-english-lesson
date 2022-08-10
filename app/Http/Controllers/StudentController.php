<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\Subject;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $topics = Topic::all('id', 'name', 'description');
        return view('student.index', compact('topics'));
    }

    public function topic(Request $request)
    {
        // $topics = Topic::where('name', '=', $request->name)->get();
        $subjects = Subject::where('topic_id', '=', $request->id)
            ->get();
        return view('student.topic', compact('subjects'));
    }

    public function level(Request $request){
        $levels = Subject::where('id', '=', $request->id)
        ->get();
        return view('student.level', compact('levels'));
    }

    public function exercise(Request $request)
    {
        $subjects = Subject::select('audio')->where('id', '=', $request->id)->get();
        $exercises = Exercise::where('subject_id', '=', $request->id)->get();

        return view('student.exercise', compact('subjects', 'exercises'));
    }

    public function submitAnswer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'answer' => 'required|max:1',
        ]);
    }
}
