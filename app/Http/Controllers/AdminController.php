<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
}
