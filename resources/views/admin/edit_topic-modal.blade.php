
<!-- The modal -->
<div class="modal fade edit_topic_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Update Topic Data</h4>
            </div>
            <div class="modal-body">
                <form id="update_topic_form" action="{{route('admin.update.topic')}}" method="POST" class="form-label-left input_mask">
                    @csrf
                    <input type="hidden" name="topic_id">
                    <div class="col-md-6 col-sm-6 form-group">
                        <label for="subject_id">Choose Subject</label> 
                        <select class="form-control" name="subject_id">
                            <option selected disabled> -- Choose Subject --</option>
                            @forelse ($subjects as $subject)
                            <option value="{{ $subject-> {'id'} }}"> {{ $subject-> {'name'} }} </option>
                            @empty
                            <option value="1">1</option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text subject_id_error"></span>
                    </div>
                    <div class="col-md-12  form-group has-feedback">
                        <label for="title">Topic Name</label>  
                        <input type="text" name="title" class="form-control has-feedback-left" placeholder="Topic Name">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>