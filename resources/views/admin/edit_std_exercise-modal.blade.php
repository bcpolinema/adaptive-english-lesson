
<!-- The modal -->
<div class="modal fade edit_std_exercise_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Update Std Exercise Data</h4>
            </div>
            <div class="modal-body">
                <form id="update_std_exercise_form" action="{{route('admin.update.std_exercise')}}" method="POST"
                    class="form-label-left input_mask">
                    @csrf
                    <input type="hidden" name="std_exercise_id">
                    <div class="col-md-4 col-sm-6 form-group">
                        <select class="form-control" name="learning_id">
                            <option selected disabled> -- Choose Learning --</option>
                            @forelse ($stdlrn as $stdlr)
                            <option value="{{$stdlr-> {'id'} }}"> {{$stdlr->{'subject_id'} }} </option>
                            @empty
                            <option value="0">-- No Learning's Available -- </option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text learning_id_error"></span>
                    </div>
                    <div class="col-md-4 col-sm-6 form-group">
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
                    <div class="col-md-4 col-sm-6 form-group">
                        <select class="form-control" name="exercise_id">
                            <option selected disabled> -- Choose Exercise --</option>
                            @forelse ($exrcs as $exr)
                            <option value="{{$exr-> {'id'} }}"> {{$exr-> {'question'} }} </option>
                            @empty
                            <option value="0">-- No Exercise's Available -- </option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text exercise_id_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <input type="checkbox" name="is_correct" value="1">
                        <input type="hidden" name="is_correct" value="0">
                        <label for="is_correct"> Is Correct</label><br>
                        <span class="text-danger error-text is_correct_error"></span>
                    </div>
                    <div class="col-md-6 form-group has-feedback">
                        <select class="form-control" name="answer">
                            <option selected disabled> -- Choose Answer --</option>
                            <option value="a"> Option A </option>
                            <option value="b"> Option B </option>
                            <option value="c"> Option C </option>
                            <option value="d"> Option D </option>
                            <option value="e"> Option E </option>
                        </select>
                        <span class="text-danger error-text answer_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="text" name="score" class="form-control has-feedback-left"
                            placeholder="Score">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text score_error"></span>
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