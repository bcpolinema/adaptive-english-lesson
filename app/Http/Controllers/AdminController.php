<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Topic;
use App\Exercise;
use App\User;
use App\StdExercise;
use App\StdLearning;
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'icon' => 'mimes:ico',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('icon')) {
                $icon_path = 'icon/';
                $icon = $request->file('icon');
                $icon_name = $icon->getClientOriginalName();
                $this->icon_upload = $icon->storeAs($icon_path, $icon_name, 'public');
            } else {
                $this->icon_upload = true;
            }

            if ($this->icon_upload) {
                Topic::insert([
                    'name' => $request->name,
                    'description' => $request->description,
                    'icon' => $icon_name,
                ]);
                return response()->json(['code' => 1, 'msg' => 'BERHASIL menambahkan soal baru.']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'GAGAL menambahkan soal baru.']);
            }       
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

        $icon_name = $topic->icon;
        $icon_path = 'icon/';

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:m_topics,name,' . $topic_id,
            'description' => 'required|string',
            'icon' => 'mimes:ico',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('icon')) {
                $icon_path = 'icon/';
                $file_path = $icon_path . $topic->icon;
                if ($topic->icon != null && Storage::disk('public')->exists($file_path)) {
                    Storage::disk('public')->delete($file_path);
                }
                $icon = $request->file('icon');
                $icon_name = $icon->getClientOriginalName();
                $this->icon_upload = $icon->storeAs($icon_path, $icon_name, 'public');
            } else {
                $this->icon_upload = true;
            }

            if ($this->icon_upload) {
                $topic->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'icon' => $icon_name,
                ]);
                return response()->json();
            } else {
                return response()->json();
            }
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
                $audio_name = $audio->getClientOriginalName();
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
                $video_name = $video->getClientOriginalName();
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
                $image_name = $image->getClientOriginalName();
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
            //Update exercise
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
    
    
    /*
        Start of Std Exercise
    */

    public function addStdExercise(Request $request)
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
    }

    /*
        End of Std Exercise
    */

     
    /*
        Start of Std Learning
    */

    public function addStdLearning(Request $request)
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

      
    }

    public function std_learning_list()
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
            /*->addColumn('user_name', function (StdLearning $stdlrn) {
                return $stdlrn->user->name;
            })*/
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
    }

    /*
        End of Std Learning
    */
}
