@extends('layout-admin')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Student Learning</h1>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Std Learning Data</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form id="add_std_learning" action="{{route('admin.add.std_learning')}}" method="POST"
                    class="form-label-left input_mask">
                    @csrf
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

<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Student Learning</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="std_learning_table" class="table table-striped jambo_table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">ID </th>
                                <!-- <th class="column-title">Student Name</th> -->
                                <th class="column-title">Subject</th>
                                <th class="column-title">TS Start</th>
                                <th class="column-title">TS Exercise</th>
                                <th class="column-title">Score</th>
                                <th class="column-title">TS Entri</th>
                                <th class="column-title">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.edit_std_learning-modal')
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#add_std_learning').on('submit', function(e){
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(this).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.code == 0) {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        alert(data.msg);
                    }
                }
            });
        });

        $('#std_learning_table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.std_learning.list') }}",
            columns: [{
                    data: "id",
                    name: "id"
                },
                {
                    data: "subject_title",
                    name: "subject.title"
                },
                {
                    data: "ts_start",
                    name: "ts_start"
                },
                {
                    data: "ts_exercise",
                    name: "ts_exercise"
                },
                {
                    data: "score",
                    name: "score"
                },
                {
                    data: "ts_entri",
                    name: "ts_entri"
                },
                {
                    data: "actions",
                    name: "actions"
                },
            ]
        });


        $(document).on('click', '#edit_std_learning_btn', function() {
            const std_learning_id = $(this).data('id');
            const url = '{{ route("admin.std_learning.detail") }}';
            $('.edit_std_learning_modal').find('form')[0].reset();
            $.post(url, {
                std_learning_id: std_learning_id
            }, function(data) {
                $('.edit_std_learning_modal').find('input[name="std_learning_id"]').val(data.details.id);
                $('.edit_std_learning_modal').find('select[name="user_id"]').val(data.details.user_id);
                $('.edit_std_learning_modal').find('select[name="subject_id"]').val(data.details.subject_id);
                $('.edit_std_learning_modal').find('input[name="ts_start"]').val(data.details.ts_start);
                $('.edit_std_learning_modal').find('input[name="ts_exercise"]').val(data.details.ts_exercise);
                $('.edit_std_learning_modal').find('input[name="score"]').val(data.details.score);
                $('.edit_std_learning_modal').find('input[name="next_learning"]').val(data.details.next_learning);
                $('.edit_std_learning_modal').find('textarea[name="comment"]').val(data.details.comment);
                $('.edit_std_learning_modal').modal('show');
            }, 'json');
        });

        $('#update_std_learning_form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(this).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        $('#std_learning_table').DataTable().ajax.reload(null, false);
                        $('.edit_std_learning_modal').modal('hide');
                        alert(data.msg);
                    }
                }
            });
        });

        $(document).on('click', '#delete_std_learning_btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    url: "{{ route('admin.delete.std_learning') }}",
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.code == 0) {
                            alert(response.msg);
                        } else {
                            $('#std_learning_table').DataTable().ajax.reload(null, false);
                            alert(response.msg);
                        }
                    }
                });
            };

        });
    });
</script>
@endsection