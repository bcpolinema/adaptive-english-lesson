</button>

<!-- The modal -->
<div class="modal fade edit_subject_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Update Level Data</h4>
            </div>
            <div class="modal-body">
                <form id="update_subject_form" action="{{route('admin.update.subject')}}" method="POST"
                    class="form-label-left input_mask" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="subject_id">
                    <div class="col-md-6 col-sm-6 form-group">
                        <select class="form-control" name="topic_id">
                            <option selected disabled> -- Choose Topic --</option>
                            @forelse ($topics as $topic)
                            <option value="{{$topic-> {'id'} }}"> {{$topic-> {'name'} }} </option>
                            @empty
                            <option value="1">1</option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text topic_id_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <select class="form-control" name="no_level">
                            <option selected disabled> -- Choose No Level --</option>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                        </select>
                        <span class="text-danger error-text no_level_error"></span>
                    </div>
                    <div class="col-md-6 form-group has-feedback">
                        <input type="text" name="title" class="form-control has-feedback-left" placeholder="Title">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <input type="hidden" name="is_pretest" value="0">
                        <input type="checkbox" name="is_pretest" value="1">
                        <label for="is_pretest"> Is Pretest</label><br>
                        <span class="text-danger error-text is_pretest_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group has-feedback">
                        <textarea type="text" rows="5" name="content" class="form-control has-feedback-left"
                            placeholder="Content"></textarea>
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text content_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="file" name="video" accept="video/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-video-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text video_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <input type="file" name="audio" accept="audio/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-audio-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text audio_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="file" name="image" accept="image/*" class="form-control has-feedback-left">
                        <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text image_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <input type="text" name="youtube" class="form-control has-feedback-left"
                            placeholder="YouTube Link">
                        <span class="fa fa-play form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text youtube_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <select class="form-control" name="route1">
                            <option selected disabled> -- Route 1 --</option>
                            @foreach ($subjects as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route1_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <select class="form-control" name="route2">
                            <option selected disabled> -- Route 2 --</option>
                            @foreach ($subjects as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route2_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <select class="form-control" name="route3">
                            <option selected disabled> -- Route 3 --</option>
                            @foreach ($subjects as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route3_error"></span> 
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <select class="form-control" name="route4">
                            <option selected disabled> -- Route 4 --</option>
                            @foreach ($subjects as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route4_error"></span> 
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>