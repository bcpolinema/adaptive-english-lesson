@extends('layout-admin')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Exercise</h1>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Exercise Data</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form id="add_exercise" action="{{route('admin.add.exercise')}}" method="POST"
                    class="form-label-left input_mask">
                    @csrf
                    <div class="col-md-3 col-sm-6 form-group">
                        <select class="form-control" name="subject_id">
                            <option selected disabled> -- Choose Subject --</option>
                            @forelse ($subjects as $subject)
                            <option value="{{$subject-> {'id'} }}"> {{$subject-> {'title'} }} </option>
                            @empty
                            <option value="0">-- No Subject Available -- </option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text subject_id_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group has-feedback">
                        <textarea type="text" rows="3" name="question" class="form-control has-feedback-left"
                            placeholder="Question"></textarea>
                        <span class="fa fa-question-circle form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text question_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="text" name="option_a" class="form-control has-feedback-left"
                            placeholder="Option A">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_a_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="text" name="option_d" class="form-control has-feedback-left"
                            placeholder="Option D">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_d_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="text" name="option_b" class="form-control has-feedback-left"
                            placeholder="Option B">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_b_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="text" name="option_e" class="form-control has-feedback-left"
                            placeholder="Option E">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_e_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="text" name="option_c" class="form-control has-feedback-left"
                            placeholder="Option C">
                        <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text option_c_error"></span>
                    </div>
                    <div class="col-md-3 form-group has-feedback">
                        <select class="form-control" name="answer_key">
                            <option selected disabled> -- Choose Answer --</option>
                            <option value="a"> Option A </option>
                            <option value="b"> Option B </option>
                            <option value="c"> Option C </option>
                            <option value="d"> Option D </option>
                            <option value="e"> Option E </option>
                        </select>
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="col-md-3 form-group has-feedback">
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
                <h2>Exercise</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="exercise_table" class="table table-striped jambo_table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">ID </th>
                                <th class="column-title">Subject</th>
                                <th class="column-title">Question</th>
                                <th class="column-title">Answer Key</th>
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

@include('admin.edit_exercise-modal')
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('#add_exercise').on('submit', function(e){
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
                        $('#exercise_table').DataTable().ajax.reload(null, false);
                        alert(data.msg);
                    }
                }
            });
        });

        $('#exercise_table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.exercise.list') }}",
            columns: [{
                    data: "id",
                    name: "id"
                },
                {
                    data: "subject_title",
                    name: "subject.title"
                },
                {
                    data: "question",
                    name: "question"
                },
                {
                    data: "answer_key",
                    name: "answer_key"
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


        $(document).on('click', '#edit_exercise_btn', function() {
            const exercise_id = $(this).data('id');
            const url = '{{ route("admin.exercise.detail") }}';
            $('.edit_exercise_modal').find('form')[0].reset();
            $.post(url, {
                exercise_id: exercise_id
            }, function(data) {
                $('.edit_exercise_modal').find('input[name="exercise_id"]').val(data.details.id);
                $('.edit_exercise_modal').find('select[name="subject_id"]').val(data.details.subject_id);
                $('.edit_exercise_modal').find('textarea[name="question"]').val(data.details.question);
                $('.edit_exercise_modal').find('input[name="option_a"]').val(data.details.option_a);
                $('.edit_exercise_modal').find('input[name="option_b"]').val(data.details.option_b);
                $('.edit_exercise_modal').find('input[name="option_b"]').val(data.details.option_b);
                $('.edit_exercise_modal').find('input[name="option_c"]').val(data.details.option_c);
                $('.edit_exercise_modal').find('input[name="option_d"]').val(data.details.option_d);
                $('.edit_exercise_modal').find('input[name="option_e"]').val(data.details.option_e);
                $('.edit_exercise_modal').find('select[name="answer_key"]').val(data.details.answer_key);
                $('.edit_exercise_modal').find('input[name="weight"]').val(data.details.weight);
                $('.edit_exercise_modal').modal('show');
            }, 'json');
        });

        $('#update_exercise_form').on('submit', function(e) {
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
                        $('#exercise_table').DataTable().ajax.reload(null, false);
                        $('.edit_exercise_modal').modal('hide');
                        alert(data.msg);
                    }
                }
            });
        });

        $(document).on('click', '#delete_exercise_btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    url: "{{ route('admin.delete.exercise') }}",
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.code == 0) {
                            alert(response.msg);
                        } else {
                            $('#exercise_table').DataTable().ajax.reload(null, false);
                            alert(response.msg);
                        }
                    }
                });
            };

        });
    });
</script>
@endsection