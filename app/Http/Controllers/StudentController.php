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
        $levels = Level::where('subject_id', '=', $request->id)->get();
        return view('student.topic', compact('levels'));
    }

    public function level(Request $request){
        $levels = Level::where('id', '=', $request->id)->get();
        return view('student.level', compact('levels'));
    }

    public function exercise(Request $request)
    {
        // $subjects = Subject::select('audio')->where('id', '=', $request->id)->get();
        $exercises = Exercise::where('level_id', '=', $request->id)->get();
        $level_id = $request->id;

        return view('student.exercise', compact('exercises', 'level_id'));
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

    public function stdStart(){
        $stdlrn = new StdLearning();
        $stdlrn->ts_start = Carbon::now()->format('Y/m/d H:i:s');
        $stdlrn->insert();
    }

    public function submitAnswer(Request $request)
    {
        // Insert & Update Std Learning



        // Insert Std Exercise
        $answers = array_values($request->soal);
        $questions = array_keys($request->soal);
        $i=0;
        foreach ($request->soal as $soal) {
            $stdexr = new StdExercise();
            $stdexr->exercise_id = $questions[$i];
            $stdexr->answer = $answers[$i];
            
            $answer = $this->exerciseAnswer($questions[$i]);

            if($answer->answer_key == $answers[$i]){
                $stdexr->is_correct = 1;
                $stdexr->score = $answer->weight;
            }else{
                $stdexr->is_correct = 0;
                $stdexr->score = 0;
            }
            $query = $stdexr->save();
            $i++;
        }
       
        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'New Std Exercise has been successfully saved']);
        }     
    }

    /*
        Start of Std Exercise
    */

    /* public function addStdExercise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'learning_id' => 'required|integer',
            'user_id' => 'required|integer',
            'exercise_id' => 'required|integer',
            'answer' => 'required|string',
            'is_correct' => 'string',
            'score' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            //Create StdExercise
            $stdexr = new StdExercise();
            $stdexr->learning_id = $request->learning_id;
            $stdexr->user_id = $request->user_id;
            $stdexr->exercise_id = $request->exercise_id;
            $stdexr->answer = $request->answer;
            $stdexr->is_correct = $request->is_correct;
            $stdexr->score = $request->score;
            $query = $stdexr->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Std Exercise has been successfully saved']);
            }
        }

       
    }

    public function std_exercise_list()
    {
        $stdexrcs = StdExercise::with('stdlearning', 'user', 'exercise');
        return DataTables::of($stdexrcs)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_std_exercise_btn" type="button" class="btn btn-default" data-id="' . $row['id'] . '">Edit</button>
                <button id="delete_std_exercise_btn"  type="button" class="btn btn-default" data-id="' . $row['id'] . '">Delete</button>
                </div>';
            })
            ->addColumn('user_name', function (StdExercise $stdexrc) {
                return $stdexrc->user->name;
            })
            ->addColumn('exercise_question', function (StdExercise $stdexrc) {
                return $stdexrc->exercise->question;
            })
            ->rawColumns(['actions'])
            ->make(true);
       
    }

    public function updateStdExercise(Request $request)
    {
        $std_exercise_id = $request->std_exercise_id;

        $validator = Validator::make($request->all(), [
            'learning_id' => 'required|integer',
            'user_id' => 'required|integer',
            'exercise_id' => 'required|integer',
            'answer' => 'required|string',
            'is_correct' => 'string',
            'score' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            //Update std exercise
            $stdexercise = StdExercise::find($std_exercise_id);
            $stdexercise->learning_id = $request->learning_id;
            $stdexercise->user_id = $request->user_id;
            $stdexercise->exercise_id = $request->exercise_id;
            $stdexercise->answer = $request->answer;
            $stdexercise->is_correct = $request->is_correct;
            $stdexercise->score = $request->score;
            $query = $stdexercise->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Std Exercise has been successfully updated']);
            }


        }
    }

    public function deleteStdExercise(Request $request)
    {
        $id = $request->id;
        $query = StdExercise::find($id)->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Student Exercise has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    } */

    /*
        End of Std Exercise
    */

     
    /*
        Start of Std Learning
    */

    /* public function addStdLearning(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'ts_start' => 'required',
            'is_validated'  => 'string',
            'ts_exercise' => 'required',
            'score'  => 'integer',
            'next_learning'  => 'integer',
            'comment' => 'string',
            'is_termination' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            //Create topic
            $stdlrn = new StdLearning();
            $stdlrn->user_id = $request->user_id;
            $stdlrn->subject_id= $request->subject_id;
            $stdlrn->ts_start = $request->ts_start;
            $stdlrn->is_validated = $request->is_validated;
            $stdlrn->ts_exercise = $request->ts_exercise;
            $stdlrn->score = $request->score;
            $stdlrn->next_learning = $request->next_learning;
            $stdlrn->comment = $request->comment;
            $stdlrn->is_termination = $request->is_termination;
            $query = $stdlrn->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Std Learning has been successfully saved']);
            }
        }

      
    } */

    /* public function std_learning_list()
    {
        $stdlrngs = StdLearning::with('user', 'subject');
        return DataTables::of($stdlrngs)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_std_learning_btn" type="button" class="btn btn-default" data-id="' . $row['id'] . '">Edit</button>
                <button id="delete_std_learning_btn"  type="button" class="btn btn-default" data-id="' . $row['id'] . '">Delete</button>
                </div>';
            })
            ->addColumn('subject_title', function (StdLearning $stdlrn) {
                return $stdlrn->subject->title;
            })
            ->addColumn('user_name', function (StdLearning $stdlrn) {
                return $stdlrn->user->name;
            })
            ->rawColumns(['actions'])
            ->make(true);
       
    } 

    public function updateStdLearning(Request $request)
    {
        $std_learning_id = $request->std_learning_id;

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'ts_start' => 'required',
            'is_validated'  => 'string',
            'ts_exercise' => 'required',
            'score'  => 'integer',
            'next_learning'  => 'integer',
            'comment' => 'string',
            'is_termination' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            //Update std exercise
            $stdlrn = StdLearning::find($std_learning_id);
            $stdlrn->user_id = $request->user_id;
            $stdlrn->subject_id= $request->subject_id;
            $stdlrn->ts_start = $request->ts_start;
            $stdlrn->is_validated = $request->is_validated;
            $stdlrn->ts_exercise = $request->ts_exercise;
            $stdlrn->score = $request->score;
            $stdlrn->next_learning = $request->next_learning;
            $stdlrn->comment = $request->comment;
            $stdlrn->is_termination = $request->is_termination;
            $query = $stdlrn->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Std Learning has been successfully updated']);
            }


        }
       
    }

    public function deleteStdLearning(Request $request)
    {
        $id = $request->id;
        $query = StdLearning::find($id)->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Student Learning has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    }*/

    /*
        End of Std Learning
    */
}
