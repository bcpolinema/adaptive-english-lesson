<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\Subject;
use App\Level;
use App\StdExercise;
use App\StdLearning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class StudentController extends Controller
{
    public function index()
    {   
        $subjects = Subject::all('id', 'name', 'description', 'icon', 'thumbnail');
        return view('student.index', compact('subjects'));
    }

    public function subject(Request $request)
    {
        $levels = Level::where('subject_id', '=', $request->id)       
                        ->with('topStdLearnings')
                        ->get();
        // return $levels;
        return view('student.topic', compact('levels'));
    }

    public function level(Request $request){
        $levels = Level::where('id', '=', $request->id)->get();
        return view('student.level', compact('levels'));
    }

    public function exercise(Request $request)
    {
        // $subjects = Subject::select('audio')->where('id', '=', $request->id)->get();
        $learn = $this->stdStart($request->id);
        $exercises = Exercise::where('level_id', '=', $request->id)->get();
        $level_id = $request->id;
        $learn_id = $learn->id;
        // return $learn_id;

        return view('student.exercise', compact('exercises', 'level_id', 'learn'));
    }

    public function historyAnswer(Request $request)
    {
        // $subjects = Subject::select('audio')->where('id', '=', $request->id)->get();
        $exercises = Exercise::where('subject_id', '=', $request->id)->get();
        $subject_id = $request->id;

        return view('student.history', compact('subjects', 'exercises', 'subject_id'));
    }

    public function exerciseAnswer($exercise_id){
        $answer = Exercise::where('id',$exercise_id)->first();
        return $answer;
    }

    public function stdStart($level_id){
        $stdlrn = new StdLearning();
        $stdlrn->user_id = Auth::user()->id;
        $stdlrn->level_id = $level_id;
        $stdlrn->ts_start = Carbon::now()->format('Y/m/d H:i:s');
        $stdlrn->save();
        return $stdlrn;
    }

    public function submitAnswer(Request $request)
    {
        // Insert & Update Std Learning
        $stdlrn = StdLearning::find($request->learn_id);

        // Insert Std Exercise
        $answers = array_values($request->soal);
        $questions = array_keys($request->soal);
        $i=0;
        $total_score = 0;
        foreach ($request->soal as $soal) {
            $stdexr = new StdExercise();
            $stdexr->exercise_id = $questions[$i];
            $stdexr->answer = $answers[$i];
            
            $answer = $this->exerciseAnswer($questions[$i]);

            if($answer->answer_key == $answers[$i]){
                $stdexr->is_correct = 1;
                $stdexr->score = $answer->weight;
                $total_score += $answer->weight;
            }else{
                $stdexr->is_correct = 0;
                $stdexr->score = 0;
            }
            $query = $stdexr->save();
            $i++;
        }
        $stdlrn->ts_exercise =  Carbon::now()->format('Y/m/d H:i:s');
        $stdlrn->score = $total_score;
        $stdlrn->update();
       
        if (!$query) {
            return response()->json();
        } else {
            return response()->json();
        }     
    }
}
