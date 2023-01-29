<?php

namespace App\Http\Controllers;

use App\Exercise;
use App\Subject;
use App\Level;
use App\Topic;
use App\StdExercise;
use App\StdLearning;
use App\ViewScoreRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class StudentController extends Controller
{
    public function index(){   
        $subjects = Subject::all('id', 'name', 'description', 'icon', 'thumbnail');
        return view('student.index', compact('subjects'));
    }

    public function subject(Request $request){
        $topics = Topic::where('subject_id', '=', $request->id)
                        ->get();
        return view('student.topic', compact('topics'));
    }

    public function level_list(Request $request){
        $level_list = Level::where('topic_id', '=', $request->tpc_id)
                    ->with('stdlearningStudent')
                    ->get();
        // return response()->json(['levels' => $level_list]);
        
        // get latest level using join
        $current_level = StdLearning::join('m_levels', 'm_levels.id', '=', 'm_std_learnings.level_id')
                        ->join('m_topics', 'm_topics.id', '=', 'm_levels.topic_id')
                        ->where('m_std_learnings.user_id', '=', Auth::user()->id)
                        ->orderBy('m_std_learnings.ts_start', 'desc')
                        ->first();
        if($current_level == null){
            $current_level = 0;
        }
        // return response()->json(['current_level' => $current_level]);
        return view('student.level_list', compact('level_list', 'current_level'));
    }

    public function level($std_id, $id){
        $stdlrn = StdLearning::find($std_id);
        $levels = Level::where('id', '=', $id)
                        ->get();
        return view('student.level', compact('levels', 'stdlrn'));
    }

    public function exercise($std_id, $id){
        $stdlrn = StdLearning::find($std_id);
        $exercises = Exercise::where('level_id', '=', $id)->get();
        return view('student.exercise', compact('exercises', 'stdlrn'));
    }

    public function stdTakeExercise(Request $request){
        $stdlrn = StdLearning::find($request->stdlrn_id);
        $stdlrn->ts_exercise = Carbon::now()->format('Y/m/d H:i:s');
        $stdlrn->update();

        if (!$stdlrn) {
            return response()->json(['code' => 0]);
        } else {
            return response()->json(['code' => 1]);
        }
    }

    public function stdStart(Request $request){
        $stdlrn = new StdLearning();
        $stdlrn->user_id = Auth::user()->id;
        $stdlrn->level_id = $request->level_id;
        $stdlrn->ts_start = Carbon::now()->format('Y/m/d H:i:s');
        $stdlrn->save();

        if (!$stdlrn) {
            return response()->json(['code' => 0]);
        } else {
            return response()->json(['code' => 1, 'stdlrn' => $stdlrn]);
        }
    }


    public function exerciseAnswer($exercise_id){
        $answer = Exercise::where('id',$exercise_id)->first();
        return $answer;
    }
   
    public function submitAnswer(Request $request)
    {
        $stdlrn = StdLearning::find($request->stdlrn_id);

        // Insert Std Exercise
        $answers = array_values($request->soal);
        $questions = array_keys($request->soal);
        $i=0;
        $total_score = 0;
        foreach ($request->soal as $soal) {
            $stdexr = new StdExercise();
            $stdexr->std_learning_id = $request->stdlrn_id;
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

        $score_result = ViewScoreRoute::where('std_learning_id', '=', $stdlrn->id)->first();
        $stdlrn->score = $score_result->score_exercise;
        $stdlrn->comment = $request->comment;
        $stdlrn->update();
        

        $next_learn = ViewScoreRoute::where('std_learning_id', '=', $stdlrn->id)->first();
        $stdlrn->next_learning = $next_learn->ROUTE;
        $stdlrn->update();
        
       
        if (!$query) {
            return response()->json(['code' => 0]);
        } else {
            return response()->json(['code' => 1, 'next_learn' => $next_learn]);
        }        
    }
}