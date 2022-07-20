@extends('layout-admin')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Student Exercise</h1>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Std Exercise Data</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form id="add_std_exercise" action="{{route('admin.add.std_exercise')}}" method="POST"
                    class="form-label-left input_mask">
                    @csrf
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

<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Student Exercise</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="std_exercise_table" class="table table-striped jambo_table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">ID </th>
                                <th class="column-title">Student Name</th>
                                <th class="column-title">Exercise</th>
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

@include('admin.edit_std_exercise-modal')
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#add_std_exercise').on('submit', function(e){
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
                        $('#std_exercise_table').DataTable().ajax.reload(null, false);
                        $(form)[0].reset();
                        alert(data.msg);
                    }
                }
            });
        });

        $('#std_exercise_table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.std_exercise.list') }}",
            columns: [{
                    data: "id",
                    name: "id"
                },
                {
                    data: "user_name",
                    name: "user.name"
                },
                {
                    data: "exercise_question",
                    name: "exercise.question"
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


        $(document).on('click', '#edit_std_exercise_btn', function() {
            const std_exercise_id = $(this).data('id');
            const url = '{{ route("admin.std_exercise.detail") }}';
            $('.edit_std_exercise_modal').find('form')[0].reset();
            $.post(url, {
                std_exercise_id: std_exercise_id
            }, function(data) {
                $('.edit_std_exercise_modal').find('input[name="std_exercise_id"]').val(data.details.id);
                $('.edit_std_exercise_modal').find('select[name="learning_id"]').val(data.details.learning_id);
                $('.edit_std_exercise_modal').find('select[name="user_id"]').val(data.details.user_id);
                $('.edit_std_exercise_modal').find('select[name="exercise_id"]').val(data.details.exercise_id);
                $('.edit_std_exercise_modal').find('select[name="answer"]').val(data.details.answer);
                $('.edit_std_exercise_modal').find('input[name="score"]').val(data.details.score);
                $('.edit_std_exercise_modal').modal('show');
            }, 'json');
        });

        $('#update_std_exercise_form').on('submit', function(e) {
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
                        $('#std_exercise_table').DataTable().ajax.reload(null, false);
                        $('.edit_std_exercise_modal').modal('hide');
                        alert(data.msg);
                    }
                }
            });
        });

        $(document).on('click', '#delete_std_exercise_btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    url: "{{ route('admin.delete.std_exercise') }}",
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.code == 0) {
                            alert(response.msg);
                        } else {
                            $('#std_exercise_table').DataTable().ajax.reload(null, false);
                            alert(response.msg);
                        }
                    }
                });
            };

        });
    });
</script>
@endsection