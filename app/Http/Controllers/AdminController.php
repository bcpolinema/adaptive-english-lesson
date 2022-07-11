<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Topic;
use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class AdminController extends Controller
{
    /*
        Start of Pages
    */
    public function index()
    {
        return view('admin.index');
    }

    public function topic()
    {
        return view('admin.topic');
    }

    public function topic_list(){
        $topics = Topic::all();
        return DataTables::of($topics)->make(true);
    }

    public function subject()
    {
        return view('admin.subject');
    }

    public function exercise()
    {
        return view('admin.exercise');
    }

    public function std_exercise()
    {
        return view('admin.std_exercise');
    }

    public function std_learning()
    {
        return view('admin.std_learning');
    }


    /*
        End of Pages
    */


    /*
        Start of Topic
    */

    public function addTopic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            //Create topic
            $topic = new Topic();
            $topic->name = $request->name;
            $topic->description = $request->description;
            $query = $topic->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Topic has been successfully saved']);
            }
        }
    }

    /*
        End of Topic
    */

    /*
        Start of Subject
    */


    public function addSubject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'topic_id' => 'required|string',
            'is_pretest' => 'required|string',
            'content' => 'required|string',
            'video' => 'mimes:video/mp4',
            'audio' => 'mimes:image/png',
            'image' => 'mimes:video/mp4',
            'youtube' => 'string',
            'route1' => 'required|numeric',
            'route2' => 'required|numeric',
            'route3' => 'required|numeric',
            'route4' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            //Create topic
            $subject = new Subject();
            $subject->title = $request->title;
            $subject->topic_id = $request->topic_id;
            $subject->is_pretest = $request->is_pretest;
            $subject->content = $request->content;
            $subject->video = $request->video;
            $subject->audio = $request->audio;
            $subject->image = $request->image;
            $subject->youtube = $request->youtube;
            $subject->route1 = $request->route1;
            $subject->route2 = $request->route2;
            $subject->route3 = $request->route3;
            $subject->route4 = $request->route4;
            $query = $subject->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Subject has been successfully saved']);
            }
        }
    }

    
    /*
        End of Subject
    */

    /*
        Start of Exercise
    */

    public function addExercise(Request $request){
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|integer',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'option_e' => 'required|string',
            'answer_key' => 'required|string|max:5',
            'weight' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            //Create exercise
            $exercise = new Exercise();
            $exercise->subject_id = $request->subject_id;
            $exercise->question = $request->question;
            $exercise->option_a = $request->option_a;
            $exercise->option_b = $request->option_b;
            $exercise->option_c = $request->option_c;
            $exercise->option_d = $request->option_d;
            $exercise->option_e = $request->option_e;
            $exercise->answer_key = $request->answer_key;
            $exercise->weight = $request->weight;
            $query = $exercise->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Exercise has been successfully saved']);
            }
        }
    }

    /*
        End of Exercise
    */

}
