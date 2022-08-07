</button>

<!-- The modal -->
<div class="modal fade edit_topic_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Update Level Data</h4>
            </div>
            <div class="modal-body">
                <form id="update_topic_form" action="{{route('admin.update.topic')}}" method="POST" class="form-label-left input_mask">
                    @csrf
                    <input type="hidden" name="topic_id">
                    <input type="hidden" name="icon_image" id="icon_image">
                    <div class="col-md-12  form-group has-feedback">
                        <label for="name">Subject Name</label>  
                        <input type="text" name="name" class="form-control has-feedback-left" placeholder="Subject Name">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="col-md-12  form-group has-feedback">
                        <label for="description">Subject Description</label>
                        <input type="text" name="description" class="form-control has-feedback-left" placeholder="Subject Description">
                        <span class="fa fa-info form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="icon">Icon</label>
                        <input type="file" name="icon" accept="icon/*" class="form-control has-feedback-left">
                        <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text icon_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="icon">Icon Preview</label>
                        <div class="mt-2" id="image_preview"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div> 
                </form>
            </div>
            
        </div>
    </div>
</div>