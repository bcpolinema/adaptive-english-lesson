<!-- The modal -->
<div class="modal fade edit_route_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalLabel">Update Route Data</h4>
            </div>
            <div class="modal-body">
                <form id="update_route_form" action="{{route('admin.update.route')}}" method="POST"
                    class="form-label-left input_mask" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="level_id">
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="route1">Route 1</label>
                        <select class="form-control" name="route1">
                            <option selected disabled> -- Route 1 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}"> {{ $level-> {'title'} }} (
                                {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route1_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="route2">Route 2</label>
                        <select class="form-control" name="route2">
                            <option selected disabled> -- Route 2 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}"> {{ $level-> {'title'} }} (
                                {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route2_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="route3">Route 3</label>
                        <select class="form-control" name="route3">
                            <option selected disabled> -- Route 3 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}"> {{ $level-> {'title'} }} (
                                {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route3_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="route4">Route 4</label>
                        <select class="form-control" name="route4">
                            <option selected disabled> -- Route 4 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}"> {{ $level-> {'title'} }} (
                                {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                        <span class="text-danger error-text route4_error"></span>
                    </div>
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