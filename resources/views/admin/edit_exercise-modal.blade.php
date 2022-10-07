</button>

<!-- The modal -->
<div class="modal fade edit_exercise_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Update Exercise Data</h4>
            </div>
            <div class="modal-body">
                <form id="update_exercise_form" action="{{route('admin.update.exercise')}}" method="POST"
                    class="form-label-left input_mask">
                    @csrf
                    <input type="hidden" name="exercise_id">
                    <div class="col-md-3 col-sm-6 form-group">
                        <label for="level_id">Choose Levels</label>
                        <select class="form-control" name="level_id">
                            <option selected disabled> -- Choose Levels --</option>
                            @forelse ($subjects as $level)
                            <option value="{{$level-> {'id'} }}"> {{$level-> {'title'} }} </option>
                            @empty
                            <option value="0">-- No Levels Available -- </option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text level_id_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group has-feedback">
                        <label for="">Question</label>
                        <textarea type="text" rows="3" name="question" class="form-control has-feedback-left"
                            placeholder="Question"></textarea>
                        <span class="fa fa-question-circle form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text question_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="">Option A</label>
                        <input type="text" name="option_a" class="form-control has-feedback-left"
                            placeholder="Option A">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_a_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="">Option D</label>
                        <input type="text" name="option_d" class="form-control has-feedback-left"
                            placeholder="Option D">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_d_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="">Option B</label>
                        <input type="text" name="option_b" class="form-control has-feedback-left"
                            placeholder="Option B">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_b_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="">Option E</label>
                        <input type="text" name="option_e" class="form-control has-feedback-left"
                            placeholder="Option E">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_e_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="">Option C</label>
                        <input type="text" name="option_c" class="form-control has-feedback-left"
                            placeholder="Option C">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_c_error"></span>
                    </div>
                    <div class="col-md-3 form-group has-feedback">
                        <label for="">Answer Key</label>
                        <select class="form-control" name="answer_key">
                            <option selected disabled> -- Choose Answer --</option>
                            <option value="A"> Option A </option>
                            <option value="B"> Option B </option>
                            <option value="C"> Option C </option>
                            <option value="D"> Option D </option>
                            <option value="E"> Option E </option>
                        </select>
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="col-md-3 form-group has-feedback">
                        <label for="">Weight</label>
                        <input type="number" min="1" max="6" step="1" name="weight"
                            class="form-control has-feedback-left" placeholder="Weight">
                        <span class="fa fa-level-up form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button class="btn btn-primary" type="reset">
                                Reset
                            </button>
                            <button type="submit" class="btn btn-success">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>