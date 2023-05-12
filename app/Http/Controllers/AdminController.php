<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Level;
use App\ViewLevelRoute;
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

    public function subject()
    {
        return view('admin.subject');
    }

    public function subject_detail(Request $request)
    {
        $subject_id = $request->subject_id;
        $subject_details = Subject::find($subject_id);
        return response()->json(['details' => $subject_details]);
    }

    public function topic()
    {
        $subjects = Subject::all();
        return view('admin.topic', compact('subjects'));
    }

    public function topic_detail(Request $request)
    {
        $topic_id = $request->topic_id;
        $topic_details = Topic::find($topic_id);
        return response()->json(['details' => $topic_details]);
    }

    public function route()
    {
        $subjects = Subject::all('id', 'name');
        $topics = Topic::with('subject')->get();
        $levels = Level::with('topic')->get();
        return view('admin.route', compact('levels', 'subjects', 'topics'));
    }

    public function route_detail(Request $request)
    {
        $level_id = $request->level_id;
        $level_details = Level::find($level_id);
        return response()->json(['details' => $level_details]);
    }

    public function level()
    {
        $subjects = Subject::all();
        $topics = Topic::with('subject')->get();
        $levels = Level::with('topic')->get();
        return view('admin.level', compact('levels', 'subjects', 'topics'));
    }

    public function getTopicBySubject(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $subtopics = Topic::where('subject_id', $subject_id)->with('subject')->get();
        return response()->json($subtopics);
    }

    public function getFTopicByFSubject(Request $request)
    {
        $subject_name = $request->input('subject_name');
        $subject = Subject::where('name', $subject_name)->first();
        $topics = Topic::where('subject_id', $subject->id)->with('subject')->get();
        return response()->json($topics);
    }

    public function level_detail(Request $request)
    {
        $level_id = $request->level_id;
        $level_details = Level::find($level_id);
        return response()->json(['details' => $level_details]);
    }

    public function exercise()
    {
        $subjects = Subject::all();
        $levels = Level::with(['topic', 'subject'])->get();
        return view('admin.exercise', compact('levels', 'subjects'));
    }

    public function exercise_detail(Request $request)
    {
        $exercise_id = $request->exercise_id;
        $exercise_details = Exercise::find($exercise_id);
        return response()->json(['details' => $exercise_details]);
    }

    /*
        End of Pages
    */


    /*
        Start of Subject
    */

    public function addSubject(Request $request)
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

            Subject::insert([
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $icon_name,
                'thumbnail' => $thumbnail_name,
            ]);
            return response()->json();
        }
    }

    public function subject_list()
    {
        $subjects = Subject::all();
        return DataTables::of($subjects)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_subject_btn" type="button" class="btn-edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></button>
                <button id="delete_subject_btn"  type="button" class="btn-delete" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i></button>
              </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function updateSubject(Request $request)
    {
        $subject_id = $request->subject_id;
        $subject = Subject::find($subject_id);

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
                if ($subject->icon) {
                    Storage::delete('public/icon/' . $subject->icon);
                }
            } else {
                $icon_name = $request->icon_image;
            }

         
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnail_name = $thumbnail->getClientOriginalName();
                $thumbnail->storeAs('public/thumbnail', $thumbnail_name);
                if ($subject->thumbnail) {
                    Storage::delete('public/thumbnail/' . $subject->thumbnail);
                }
            } else {
                $thumbnail_name = $request->thumbnail_image;
            }

            $subject->update([
                'name' => $request->name,
                'description' => $request->description,
                'icon' => $icon_name,
                'thumbnail' => $thumbnail_name,        
            ]);
            return response()->json();
        }
    }

    public function deleteSubject(Request $request)
    {
		$id = $request->id;
        $query = Subject::find($id);

        // Hapus Icon
        if (Storage::delete('public/icon/' . $query->icon)) {
			Subject::destroy($id);
		}

        // Hapus Thumbnail
        if (Storage::delete('public/thumbnail/' . $query->thumbnail)) {
			Subject::destroy($id);
		}

        $query->delete();

        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Subject has been successfully updated']);
        }
    }

    /*
        End of Subject
    */

    /*
        Start of Topic
    */

    public function addTopic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|string',
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            Topic::insert([
                'subject_id' => $request->subject_id,
                'title' => $request->title,
            ]);
            return response()->json();
        }
    }

    public function topic_list()
    {
        $topics = Topic::with('subject')->select('m_topics.*');

        return DataTables::of($topics)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_topic_btn" type="button" class="btn-edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></button>
                <button id="delete_topic_btn"  type="button" class="btn-delete" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i></button>
              </div>';
            })
            ->addColumn('subject_name', function ($topics) {
                return $topics->subject->name;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function updateTopic(Request $request)
    {
        $topic_id = $request->topic_id;

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|string',
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $topic = Topic::find($topic_id);
            $topic->subject_id = $request->subject_id;
            $topic->title = $request->title;
            $query = $topic->update();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Topic has been successfully updated']);
            }
        }
    }

    public function deleteTopic(Request $request)
    {
        $id = $request->id;
        $query = Topic::find($id);
        $query->delete();

        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Topic has been successfully updated']);
        }
    }


    /*
        End of Topic
    */


    /*
        Start of Level
    */


    public function addLevel(Request $request)
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
            'topic_id' => 'required|string',
            'is_pretest' => 'string',
            'is_termination' => 'string',
            'content' => 'required|string',
            'video' => 'mimes:mp4',
            'audio' => 'mimes:mp3',
            'image' => 'mimes:jpeg,jpg,png',
            'youtube' => 'url',
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

                Level::insert([
                    'title' => $request->title,
                    'subject_id' => $request->subject_id,
                    'topic_id' => $request->topic_id,
                    'is_pretest' => $request->is_pretest,
                    'is_termination' => $request->is_termination,
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

    public function level_list(Request $request)
    {

            $levels = ViewLevelRoute::query()->with(['subject', 'topic'])->select('v_level_title.*');;

            return DataTables::of($levels)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_level_btn" type="button" class="btn-edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></button>
                <button id="delete_level_btn"  type="button" class="btn-delete" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i></button>
                </div>';
            })
            ->addColumn('subject_name', function (ViewLevelRoute $level) {
                return $level->subject->name;
            })
            ->addColumn('topic_title', function (ViewLevelRoute $level) {
                return $level->topic->title;
            })
          
            ->rawColumns(['actions'])
            ->make(true);

       
    }

    public function updateLevel(Request $request)
    {
        $level_id = $request->level_id;
        $level = Level::find($level_id);

        $audio_name = '';
        $video_name = '';
        $image_name = '';

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'subject_id' => 'required|string',
            'topic_id' => 'required|string',
            'is_pretest' => 'numeric',
            'is_termination' => 'numeric',
            'content' => 'required|string',
            'video' => 'mimes:mp4',
            'audio' => 'mimes:mp3',
            'image' => 'mimes:jpeg,jpg,png',
            'youtube' => 'url',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            // Update Audio
            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $audio_name = $audio->getClientOriginalName();
                $audio->storeAs('public/audio', $audio_name);
                if ($level->audio) {
                    Storage::delete('public/audio/' . $level->audio);
                }
            } else {
                $audio_name = $request->level_audio;
            }

            // Update Video
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $video_name = $video->getClientOriginalName();
                $video->storeAs('public/video', $video_name);
                if ($level->video) {
                    Storage::delete('public/video/' . $level->video);
                }
            } else {
                $video_name = $request->level_video;
            }

            // Update Image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $image->storeAs('public/image', $image_name);
                if ($level->image) {
                    Storage::delete('public/image/' . $level->image);
                }
            } else {
                $image_name = $request->level_image;
            }

            $level->update([
                'title' => $request->title,
                'subject_id' => $request->subject_id,
                'topic_id' => $request->topic_id,
                'is_pretest' => $request->is_pretest,
                'is_termination' => $request->is_termination,
                'content' => $request->content,
                'audio' => $audio_name,
                'video' => $video_name,
                'image' => $image_name,
                'youtube' => $request->youtube,
            ]);

            return response()->json();
        }
    }

    public function deleteLevel(Request $request)
    {
        $id = $request->id;
        $query = Level::find($id);

        // Hapus Image
        if (Storage::delete('public/image/' . $query->image)) {
			Level::destroy($id);
		}
        // Hapus Video
        if (Storage::delete('public/video/' . $query->video)) {
			Level::destroy($id);
		}
        // Hapus Audio
        if (Storage::delete('public/audio/' . $query->audio)) {
			Level::destroy($id);
		}

        $query->delete();

        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Level has been successfully updated']);
        }
    }


    /*
        End of Level
    */

    /*
        Start of Route
    */


    public function addRoute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'route1' => 'required|numeric',
            'route2' => 'required|numeric',
            'route3' => 'required|numeric',
            'route4' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            Level::insert([
                'route1' => $request->route1,
                'route2' => $request->route2,
                'route3' => $request->route3,
                'route4' => $request->route4,
            ]);

            DB::statement('UPDATE m_levels SET route1 = id WHERE route1=0');
            DB::statement('UPDATE m_levels SET route2 = id WHERE route2=0');
            DB::statement('UPDATE m_levels SET route3 = id WHERE route3=0');
            DB::statement('UPDATE m_levels SET route4 = id WHERE route4=0');

            return response()->json(['code' => 1, 'msg' => 'BERHASIL menambahkan route baru.']);
            return response()->json(['code' => 0, 'msg' => 'GAGAL menambahkan route baru.']);   
        }
    }
    

    public function route_list()
    {
        $levels = ViewLevelRoute::with(['subject', 'topic']);
            return DataTables::of($levels)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_route_btn" type="button" class="btn-edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></button>
                </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function updateRoute(Request $request)
    {
        $level_id = $request->level_id;
        $level = Level::find($level_id);

        $validator = Validator::make($request->all(), [
            'route1' => 'required',
            'route2' => 'required',
            'route3' => 'required',
            'route4' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $level->update([
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

    /*
        End of Route
    */

    /*
        Start of Exercise
    */

    public function addExercise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level_id' => 'required|integer',
            'question' => 'required|string',
            'image' => 'mimes:jpeg,jpg,png,gif',
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
        }else{
            if ($request->hasFile('image')) {
                $image_path = 'exercise_image/';
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $this->image_upload = $image->storeAs($image_path, $image_name, 'public');
            } else {
                $this->image_upload = true;
            }

            if ($this->image_upload) {
                $exercise = new Exercise();
                $exercise->level_id = $request->level_id;
                $exercise->question = $request->question;
                $exercise->image = $image_name;
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
    }


    public function exercise_list()
    {
        $exercises = Exercise::with('level');
        return DataTables::of($exercises)
            ->addColumn('actions', function ($row) {
                return
                    '<div class="btn-group" role="group">
                <button id="edit_exercise_btn" type="button" class="btn-edit" data-id="' . $row['id'] . '"><i class="fas fa-edit"></i></button>
                <button id="delete_exercise_btn"  type="button" class="btn-delete" data-id="' . $row['id'] . '"><i class="fas fa-trash"></i></button>
                </div>';
            })
            ->addColumn('level_title', function (Exercise $exercise) {
                return $exercise->level->title;
            })
            ->addColumn('level_topic_title', function (Exercise $exercise) {
                return $exercise->level->topic->title;
            })
            ->addColumn('level_subject_name', function (Exercise $exercise) {
                return $exercise->level->subject->name;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function updateExercise(Request $request)
    {
        $exercise_id = $request->exercise_id;
        $exercise = Exercise::find($exercise_id);
        
        $image_name = '';

        $validator = Validator::make($request->all(), [
            'level_id' => 'required|integer',
            'question' => 'required|string',
            'image' => 'mimes:jpeg,jpg,png,gif',
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
             // Update Image
             if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $image->storeAs('public/exercise_image', $image_name);
                if ($exercise->image) {
                    Storage::delete('public/exercise_image/' . $exercise->image);
                }
            } else {
                $image_name = $request->exercise_image;
            }
            
            //Update exercise
            $exercise = Exercise::find($exercise_id);
            $exercise->level_id = $request->level_id;
            $exercise->question = $request->question;
            $exercise->image = $image_name;
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
        $query = Exercise::find($id);

        // Hapus Image
        if (Storage::delete('public/exercise_image/' . $query->image)) {
			Exercise::destroy($id);
		}

        $query->delete();

        if(!$query){
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }else{
            return response()->json(['code'=>1, 'msg'=>'Exercise has been deleted from database']);
        }
    }
    
    /*
        End of Exercise
    */
}