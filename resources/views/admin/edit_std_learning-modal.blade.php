</button>

<!-- The modal -->
<div class="modal fade edit_std_learning_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Update Std Learning Data</h4>
            </div>
            <div class="modal-body">
                <form id="update_std_learning_form" action="{{route('admin.update.std_learning')}}" method="POST"
                    class="form-label-left input_mask">
                    @csrf
                    <input type="hidden" name="std_learning_id">
                    <div class="col-md-6 col-sm-6 form-group">
                        <select class="form-control" name="user_id">
                            <option selected disabled> -- Choose Student --</option>
                            @forelse ($user as $std)
                            <option value="{{$std-> {'id'} }}"> {{ $std->{'name'} }} </option>
                            @empty
                            <option value="0">-- No Student's Available -- </option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text user_id_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <select class="form-control" name="subject_id">
                            <option selected disabled> -- Choose Subject --</option>
                            @forelse ($subject as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @empty
                            <option value="0">-- No Subject's Available -- </option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text subject_id_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <input type="checkbox" name="is_validated" value="1">
                        <input type="hidden" name="is_validated" value="0">
                        <label for="is_validated"> Is Validated</label><br>
                        <span class="text-danger error-text is_validated_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="ts_start"> TS Start</label><br>
                        <input type="datetime-local" name="ts_start" class="form-control has-feedback-left"
                            placeholder="TS Start">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text ts_start_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="ts_exercise"> TS Exercise</label><br>
                        <input type="datetime-local" name="ts_exercise" class="form-control has-feedback-left"
                            placeholder="TS Exercise">
                        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text ts_exercise_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="text" name="score" class="form-control has-feedback-left"
                            placeholder="Score">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text score_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="text" name="next_learning" class="form-control has-feedback-left"
                            placeholder="Next Learning">
                        <span class="fa fa-arrow-right form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text next_learning_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group has-feedback">
                        <textarea type="text" rows="3" name="comment" class="form-control has-feedback-left"
                            placeholder="Comment"></textarea>
                        <span class="fa fa-question-circle form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text comment_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <input type="checkbox" name="is_termination" value="1">
                        <input type="hidden" name="is_termination" value="0">
                        <label for="is_termination"> Is Termination</label><br>
                        <span class="text-danger error-text is_termination_error"></span>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button class="btn btn-primary" type="reset">
                                Reset
                            </button>
                            <button type="submit" class="btn btn-success">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>