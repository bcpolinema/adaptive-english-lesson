<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Topic;
use App\Exercise;
use App\User;
use App\StdExercise;
use App\StdLearning;
use Auth;
use DB;
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

    public function topic_detail(Request $request)
    {
        $topic_id = $request->topic_id;
        $topic_details = Topic::find($topic_id);
        return response()->json(['details' => $topic_details]);
    }

    public function subject()
    {
        $topics = Topic::all('id', 'name');
        $subjects = Subject::all('id', 'title', 'no_level');
        return view('admin.subject', compact('topics', 'subjects'));
    }

    public function subject_detail(Request $request)
    {
        $level_id = $request->level_id;
        $subject_details = Subject::find($level_id);
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
        $stdlrn = StdLearning::all('id', 'subject_id');
        $user = User::all()->where('roles', 'student');
        $exrcs = Exercise::all('id', 'question');
        return view('admin.std_exercise', compact('stdlrn', 'user', 'exrcs'));
    }

    public function std_exercise_detail(Request $request)
    {
        $std_exercise_id = $request->std_exercise_id;
        $std_exercise_details = StdExercise::find($std_exercise_id);
        return response()->json(['details' => $std_exercise_details]);
    }

    public function std_learning()
    {
        $subject = Subject::all('id', 'title');
        $user = User::all()->where('roles', 'student');
        return view('admin.std_learning', compact('subject', 'user'));
    }

    public function std_learning_detail(Request $request)
    {
        $std_learning_id = $request->std_learning_id;
        $std_learning_details = StdLearning::find($std_learning_id);
        return response()->json(['details' => $std_learning_details]);
    }


    /*
        End of Pages
    */


    /*
        Start of Topic
    */

    public function addTopic(Request $request)
    {
        $icon_name = "";
        $icon_upload = false;

        $thumbnail_name = "";
        $thumbnail_upload = false;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'icon' => 'mimes:ico,png,jpg,jpeg',
            'thumbnail' => 'mimes:jpg,png,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            // Tambah Icon
            if ($request->hasFile('icon')) {
                $icon_path = 'icon/';
                $icon = $request->file('icon');
                $icon_name = $icon->getClientOriginalName();
                $this->icon_upload = $icon->storeAs($icon_path, $icon_name, 'public');
            } else {
                $this->icon_upload = true;
            }
            // Tambah Thumbnail
            if ($request->hasFile('thumbnail')) {
                $thumbnail_path = 'thumbnail/';
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = $thumbnail->getClientOriginalName();
                $this->thumbnail_upload = $thumbnail->storeAs($thumbnail_path, $thumbnail_name, 'public');
            } else {
                $this->thumbnail_upload = true;
            }

            Topic::insert([
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $icon_name,
                'thumbnail' => $thumbnail_name,
            ]);
            return response()->json();
        }
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

    public function updateTopic(Request $request)
    {
        $topic_id = $request->topic_id;
        $topic = Topic::find($topic_id);

        $icon_name = '';
        $thumbnail_name = '';

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'icon' => 'mimes:ico,png,jpg,jpeg',
            'thumbnail' => 'mimes:jpg,png,jpeg',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

          
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $icon_name = $icon->getClientOriginalName();
                $icon->storeAs('public/icon', $icon_name);
                if ($topic->icon) {
                    Storage::delete('public/icon/' . $topic->icon);
                }
            } else {
                $icon_name = $request->icon_image;
            }

         
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = $thumbnail->getClientOriginalName();
                $thumbnail->storeAs('public/thumbnail', $thumbnail_name);
                if ($topic->thumbnail) {
                    Storage::delete('public/thumbnail/' . $topic->thumbnail);
                }
            } else {
                $thumbnail_name = $request->thumbnail_image;
            }

            $topic->update([
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $icon_name,
                'thumbnail' => $thumbnail_name,        
            ]);
            return response()->json();
        }
    }

    public function deleteTopic(Request $request)
    {
		$id = $request->id;
        $query = Topic::find($id);

        // Hapus Icon
        if (Storage::delete('public/icon/' . $query->icon)) {
			Topic::destroy($id);
		}

        // Hapus Thumbnail
        if (Storage::delete('public/thumbnail/' . $query->thumbnail)) {
			Topic::destroy($id);
		}

        $query->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Topic has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
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
            'subject_id' => 'required|string',
            'no_level' => 'required|string',
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
                $audio_name = $audio->getClientOriginalName();
                $this->audio_upload = $audio->storeAs($audio_path, $audio_name, 'public');
            } else {
                $this->audio_upload = true;
            }

            if ($request->hasFile('video')) {
                $video_path = 'video/';
                $video = $request->file('video');
                $video_name = $video->getClientOriginalName();
                $this->video_upload = $video->storeAs($video_path, $video_name, 'public');
            } else {
                $this->video_upload = true;
            }

            if ($request->hasFile('image')) {
                $image_path = 'image/';
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $this->image_upload = $image->storeAs($image_path, $image_name, 'public');
            } else {
                $this->image_upload = true;
            }



            if ($this->audio_upload and $this->video_upload and $this->image_upload) {

                Subject::insert([
                    'title' => $request->title,
                    'subject_id' => $request->subject_id,
                    'no_level' => $request->no_level,
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

                DB::statement('UPDATE m_levels SET route1 = id WHERE route1=0');
                DB::statement('UPDATE m_levels SET route2 = id WHERE route2=0');
                DB::statement('UPDATE m_levels SET route3 = id WHERE route3=0');
                DB::statement('UPDATE m_levels SET route4 = id WHERE route4=0');

                return response()->json(['code' => 1, 'msg' => 'BERHASIL menambahkan soal baru.']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'GAGAL menambahkan soal baru.']);
            }
        }
    }

    public function subject_list()
    {
        $levels = Subject::with('subject');
            return DataTables::of($levels)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_subject_btn" type="button" class="btn btn-default" data-id="' . $row['id'] . '">Edit</button>
                <button id="delete_subject_btn"  type="button" class="btn btn-default" data-id="' . $row['id'] . '">Delete</button>
                </div>';
            })
            ->addColumn('subject_name', function (Subject $level) {
                return $level->subject->name;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function updateSubject(Request $request)
    {
        $level_id = $request->level_id;
        $subject = Subject::find($level_id);

        $audio_name = '';
        $video_name = '';
        $image_name = '';

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'subject_id' => 'required|string',
            'no_level' => 'required|string',
            'is_pretest' => 'numeric',
            'content' => 'required|string',
            'video' => 'mimes:mp4',
            'audio' => 'mimes:mp3',
            'image' => 'mimes:jpg',
            'youtube' => 'url',
            'route1' => 'required',
            'route2' => 'required',
            'route3' => 'required',
            'route4' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            // Update Audio
            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $audio_name = $audio->getClientOriginalName();
                $audio->storeAs('public/audio', $audio_name);
                if ($subject->audio) {
                    Storage::delete('public/audio/' . $subject->audio);
                }
            } else {
                $audio_name = $request->level_audio;
            }

            // Update Video
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $video_name = $video->getClientOriginalName();
                $video->storeAs('public/video', $video_name);
                if ($subject->video) {
                    Storage::delete('public/video/' . $subject->video);
                }
            } else {
                $video_name = $request->level_video;
            }

            // Update Image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $image->storeAs('public/image', $image_name);
                if ($subject->image) {
                    Storage::delete('public/image/' . $subject->image);
                }
            } else {
                $image_name = $request->level_image;
            }

            $subject->update([
                'title' => $request->title,
                'subject_id' => $request->subject_id,
                'no_level' => $request->no_level,
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

            DB::statement('UPDATE m_levels SET route1 = id WHERE route1=0');
            DB::statement('UPDATE m_levels SET route2 = id WHERE route2=0');
            DB::statement('UPDATE m_levels SET route3 = id WHERE route3=0');
            DB::statement('UPDATE m_levels SET route4 = id WHERE route4=0');

            return response()->json();
        }
    }

    public function deleteSubject(Request $request)
    {
        $id = $request->id;
        $query = Subject::find($id);

        // Hapus Image
        if (Storage::delete('public/images/' . $query->image)) {
			Subject::destroy($id);
		}
        // Hapus Video
        if (Storage::delete('public/video/' . $query->video)) {
			Subject::destroy($id);
		}
        // Hapus Audio
        if (Storage::delete('public/audio/' . $query->audio)) {
			Subject::destroy($id);
		}

        $query->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Subject has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
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
            'level_id' => 'required|integer',
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
            $exercise->level_id = $request->level_id;
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
        $exercises = Exercise::with('level');
        return DataTables::of($exercises)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_exercise_btn" type="button" class="btn btn-default" data-id="' . $row['id'] . '">Edit</button>
                <button id="delete_exercise_btn"  type="button" class="btn btn-default" data-id="' . $row['id'] . '">Delete</button>
                </div>';
            })
            ->addColumn('level_title', function (Exercise $exercise) {
                return $exercise->level->title;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function updateExercise(Request $request)
    {
        $exercise_id = $request->exercise_id;

        $validator = Validator::make($request->all(), [
            'level_id' => 'required|integer',
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
            //Update exercise
            $exercise = Exercise::find($exercise_id);
            $exercise->level_id = $request->level_id;
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


        }
    }

    public function deleteExercise(Request $request)
    {
        $id = $request->id;
        $query = Exercise::find($id)->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Exercise has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    }
    
    /*
        End of Exercise
    */
    
    
    
}
