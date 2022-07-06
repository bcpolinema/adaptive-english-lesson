<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{ 
    public function index(){
        return view('admin.index');
    }

    public function topic(){
        return view('admin.topic');
    }

    public function addTopic(Request $request){
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
}
