<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Topic;
use App\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function topic_list()
    {
        $topics = Topic::all();
        return DataTables::of($topics)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_topic_btn" type="button" class="btn btn-default" data-id="' . $row['id'] . '">Edit</button>
                <button id="delete_topic_btn"  type="button" class="btn btn-default" data-id="' . $row['id'] . '">Delete</button>
              </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function topic_detail(Request $request)
    {
        $topic_id = $request->topic_id;
        $topic_details = Topic::find($topic_id);
        return response()->json(['details' => $topic_details]);
    }

    public function subject()
    {
        $topics = Topic::all('id', 'name');
        $subjects = Subject::all('id', 'title');
        return view('admin.subject', compact('topics', 'subjects'));
    }

    public function subject_detail(Request $request)
    {
        $subject_id = $request->subject_id;
        $subject_details = Subject::find($subject_id);
        return response()->json(['details' => $subject_details]);
    }

    public function exercise()
    {
        $subjects = Subject::all('id', 'title');
        return view('admin.exercise', compact('subjects'));
    }

    public function exercise_detail(Request $request)
    {
        $exercise_id = $request->exercise_id;
        $exercise_details = Exercise::find($exercise_id);
        return response()->json(['details' => $exercise_details]);
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

    public function updateTopic(Request $request)
    {
        $topic_id = $request->topic_id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:m_topics,name,' . $topic_id,
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            //Create topic
            $topic = Topic::find($topic_id);
            $topic->name = $request->name;
            $topic->description = $request->description;
            $query = $topic->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Topic has been successfully updated']);
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
        $audio_name = "";
        $video_name = "";
        $image_name = "";

        $audio_upload = false;
        $video_upload = false;
        $image_upload = false;

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'topic_id' => 'required|string',
            'is_pretest' => 'string',
            'content' => 'required|string',
            'video' => 'mimes:mp4',
            'audio' => 'mimes:mp3',
            'image' => 'mimes:jpg',
            'youtube' => 'url',
            'route1' => 'required|numeric',
            'route2' => 'required|numeric',
            'route3' => 'required|numeric',
            'route4' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('audio')) {
                $audio_path = 'audio/';
                $audio = $request->file('audio');
                $this->audio_name = $audio->getClientOriginalName();
                $this->audio_upload = $audio->storeAs($audio_path, $audio_name, 'public');
            } else {
                $this->audio_upload = true;
            }

            if ($request->hasFile('video')) {
                $video_path = 'video/';
                $video = $request->file('video');
                $this->video_name = $video->getClientOriginalName();
                $this->video_upload = $video->storeAs($video_path, $video_name, 'public');
            } else {
                $this->video_upload = true;
            }

            if ($request->hasFile('image')) {
                $image_path = 'image/';
                $image = $request->file('image');
                $this->image_name = $image->getClientOriginalName();
                $this->image_upload = $image->storeAs($image_path, $image_name, 'public');
            } else {
                $this->image_upload = true;
            }

            if ($this->audio_upload and $this->video_upload and $this->image_upload) {
                Subject::insert([
                    'title' => $request->title,
                    'topic_id' => $request->topic_id,
                    'is_pretest' => $request->is_pretest,
                    'content' => $request->content,
                    'audio' => $audio_name,
                    'video' => $video_name,
                    'image' => $image_name,
                    'youtube' => $request->youtube,
                    'route1' => $request->route1,
                    'route2' => $request->route2,
                    'route3' => $request->route3,
                    'route4' => $request->route4,
                ]);
                return response()->json(['code' => 1, 'msg' => 'BERHASIL menambahkan soal baru.']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'GAGAL menambahkan soal baru.']);
            }
        }
    }

    public function subject_list()
    {
        $subjects = Subject::with('topic');
        return DataTables::of($subjects)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_subject_btn" type="button" class="btn btn-default" data-id="' . $row['id'] . '">Edit</button>
                <button id="delete_subject_btn"  type="button" class="btn btn-default" data-id="' . $row['id'] . '">Delete</button>
                </div>';
            })
            ->addColumn('topic_name', function (Subject $subject) {
                return $subject->topic->name;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function updateSubject(Request $request)
    {
        $subject_id = $request->subject_id;
        $subject = Subject::find($subject_id);

        $audio_name = $subject->audio;
        $video_name = $subject->video;
        $image_name = $subject->image;

        $image_path = 'image/';
        $audio_path = 'audio/';
        $video_path = 'video/';

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'topic_id' => 'required|string',
            'is_pretest' => 'numeric',
            'content' => 'required|string',
            'video' => 'mimes:mp4',
            'audio' => 'mimes:mp3',
            'image' => 'mimes:jpg',
            'youtube' => 'url',
            'route1' => 'required|numeric',
            'route2' => 'required|numeric',
            'route3' => 'required|numeric',
            'route4' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('audio')) {
                $audio_path = 'audio/';
                $file_path = $audio_path . $subject->audio;
                if ($subject->audio != null && Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }
                $audio = $request->file('audio');
                $this->audio_name = $audio->getClientOriginalName();
                $this->audio_upload = $audio->storeAs($audio_path, $this->audio_name, 'public');
            } else {
                $this->audio_upload = true;
            }

            if ($request->hasFile('video')) {
                $video_path = 'video/';
                $file_path = $video_path . $subject->video;
                if ($subject->video != null && Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }
                $video = $request->file('video');
                $this->video_name = $video->getClientOriginalName();
                $this->video_upload = $video->storeAs($video_path, $this->video_name, 'public');
            } else {
                $this->video_upload = true;
            }

            if ($request->hasFile('image')) {
                $image_path = 'image/';
                $file_path = $image_path . $subject->image;
                if ($subject->image != null && Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }
                $image = $request->file('image');
                $this->image_name = $image->getClientOriginalName();
                $this->image_upload = $image->storeAs($image_path, $this->image_name, 'public');
            } else {
                $this->image_upload = true;
            }

            if ($this->audio_upload and $this->video_upload and $this->image_upload) {
                $subject->update([
                    'title' => $request->title,
                    'topic_id' => $request->topic_id,
                    'is_pretest' => $request->is_pretest,
                    'content' => $request->content,
                    'audio' => $audio_name,
                    'video' => $video_name,
                    'image' => $image_name,
                    'youtube' => $request->youtube,
                    'route1' => $request->route1,
                    'route2' => $request->route2,
                    'route3' => $request->route3,
                    'route4' => $request->route4,
                ]);
                return response()->json(['code' => 1, 'msg' => 'BERHASIL update subject.']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'GAGAL update subject.']);
            }
        }
    }


    /*
        End of Subject
    */

    /*
        Start of Exercise
    */

    public function addExercise(Request $request)
    {
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


    public function exercise_list()
    {
        $exercises = Exercise::with('subject');
        return DataTables::of($exercises)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_exercise_btn" type="button" class="btn btn-default" data-id="' . $row['id'] . '">Edit</button>
                <button id="delete_exercise_btn"  type="button" class="btn btn-default" data-id="' . $row['id'] . '">Delete</button>
                </div>';
            })
            ->addColumn('subject_title', function (Exercise $exercise) {
                return $exercise->subject->title;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function updateExercise(Request $request)
    {
        $exercise_id = $request->exercise_id;

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
            //Create topic
            $exercise = Exercise::find($exercise_id);
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
                return response()->json(['code' => 1, 'msg' => 'Exercise has been successfully updated']);
            }


            /*
        End of Exercise
        */
        }
    }
}
