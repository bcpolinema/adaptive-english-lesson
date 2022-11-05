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
        $level_1 = Level::where('subject_id', '=', $request->id)
                        ->where('no_level', '1')->get();
        $levels = Level::where('subject_id', '=', $request->id)       
                        ->with('topStdLearnings')
                        ->get();
        // return $levels;
        return view('student.topic', compact('levels', 'level_1'));
    }

    public function level(Request $request){
        $levels = Level::where('id', '=', $request->id)->get();
        $start = $this->stdStart($request->id);
        
        return view('student.level', compact('levels', 'start'));
    }

    public function exercise(Request $request, $id)
    {
        // return $id;
        $exercises = Exercise::where('level_id', '=', $id)->get();
        $take_exercise = $this->stdTakeExercise($request->take_exercise_id);
        $take_exercise_id = $take_exercise->id;
        return view('student.exercise', compact('exercises', 'take_exercise', 'take_exercise_id'));
    }

    public function stdTakeExercise($id){
        $stdlrn = StdLearning::find($id);
        $stdlrn->ts_exercise = Carbon::now()->format('Y/m/d H:i:s');
        $stdlrn->update();
        return $stdlrn;
    }

    public function stdStart($level_id){
        $stdlrn = new StdLearning();
        $stdlrn->user_id = Auth::user()->id;
        $stdlrn->level_id = $level_id;
        $stdlrn->ts_start = Carbon::now()->format('Y/m/d H:i:s');
        $stdlrn->save();
        return $stdlrn;
    }


    public function exerciseAnswer($exercise_id){
        $answer = Exercise::where('id',$exercise_id)->first();
        return $answer;
    }
   
    public function submitAnswer(Request $request)
    {
        // Insert & Update Std Learning
        $stdlrn = StdLearning::find($request->take_exercise_id);

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
        $stdlrn->score = $total_score;
        $stdlrn->update();
       
        if (!$query) {
            return response()->json();
        } else {
            return response()->json();
        }     
    }
}
