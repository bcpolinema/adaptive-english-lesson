<!-- The modal -->
<div class="modal fade edit_level_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Update Level Data</h4>
            </div>
            <div class="modal-body">
                <form id="update_level_form" action="{{route('admin.update.level')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="level_id">
                    <input type="hidden" name="level_audio" id="level_audio">
                    <input type="hidden" name="level_video" id="level_video">
                    <input type="hidden" name="level_image" id="level_image">
                    <div class="col-md-6 form-group">
                        <br>
                        <label for="subject_id">Subject</label>
                        <select class="form-control" name="subject_id" id="subject_id">
                            <option selected disabled> -- Choose Subject --</option>
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"> {{ $subject->name }} </option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text subject_id_error"></span>
                    </div>
                    <div class="col-md-6 form-group">
                        <br>
                        <label for="topic_id">Choose Topic</label>
                        <select class="form-control" name="topic_id" id="topic_id">
                            <option value=""> -- Choose Topic --</option>
                        </select>
                        <span class="text-danger error-text topic_id_error"></span>
                    </div>
                    <div class="col-md-12 form-group has-feedback">
                        <label for="title">Level</label>
                        <input type="text" name="title" class="form-control has-feedback-left" placeholder="Title">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <input type="hidden" name="is_pretest" value="0">
                        <input type="checkbox" name="is_pretest" value="1">
                        <label for="is_pretest"> Is Pretest</label><br>
                        <span class="text-danger error-text is_pretest_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <input type="checkbox" name="is_termination" value="1">
                        <input type="hidden" name="is_terminaton" value="0">
                        <label for="is_termination"> Is Termination</label><br>
                        <span class="text-danger error-text is_termination_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group has-feedback">
                        <label for="content">Content Level</label>
                        <textarea type="text" rows="5" name="content" class="form-control has-feedback-left"
                            placeholder="Content"></textarea>
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text content_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <label for="video">Video File</label>
                        <input type="file" name="video" accept="video/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-video-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text video_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <label for="audio">Audio File</label>
                        <input type="file" name="audio" accept="audio/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-audio-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text audio_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="video">Video Preview</label>
                        <div class="mt-1" id="video"></div>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="audio">Audio Preview</label>
                        <div class="mt-1" id="audio"></div>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="image">Image File</label>
                        <input type="file" name="image" accept="image/*" class="form-control has-feedback-left">
                        <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text image_error"></span>
                    </div>
                    <div class="col-md-12  form-group has-feedback">
                        <label for="image">Image Preview</label>
                        <div class="mt-1" id="image"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <label for="youtube">Youtube Link</label>
                        <input type="text" name="youtube" class="form-control has-feedback-left"
                            placeholder="YouTube Link">
                        <span class="fa fa-play form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text youtube_error"></span>
                    </div>
                    <!-- <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="route1">Route 1</label> 
                        <select class="form-control" name="route1">
                            <option selected disabled> -- Route 1 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}">  Level {{ $level-> {'title'} }} ( {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0" > -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route1_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="route2">Route 2</label> 
                        <select class="form-control" name="route2">
                            <option selected disabled> -- Route 2 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}">  Level {{ $level-> {'title'} }} ( {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0" > -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route2_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="route3">Route 3</label> 
                        <select class="form-control" name="route3">
                            <option selected disabled> -- Route 3 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}">   Level {{ $level-> {'title'} }} ( {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0" > -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route3_error"></span> 
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="route4">Route 4</label> 
                        <select class="form-control" name="route4">
                            <option selected disabled> -- Route 4 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}">  Level {{ $level-> {'title'} }} ( {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0" > -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route4_error"></span> 
                    </div> -->
                    <div class="ln_solid"></div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>