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
                <form id="add_exercise" action="{{route('admin.add.exercise')}}" method="POST"
                    class="form-label-left input_mask">
                    @csrf
                    <div class="col-md-3 col-sm-6 form-group">
                        <br>
                        <label for="level_id">Choose Levels</label>
                        <select class="form-control" name="level_id">
                            <option selected disabled> -- Choose Levels --</option>
                            @forelse ($levels as $level)
                            <option value="{{$level-> {'id'} }}">( {{$level->subject->name}} )
                                {{$level-> {'title'} }} {{$level->topic->title}}</option>
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
                    <div class="col-md-7 col-sm-6 form-group has-feedback">
                        <label for="image">Image File</label>
                        <input type="file" name="image" accept="image/*" class="form-control has-feedback-left">
                        <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text image_error"></span>
                    </div>
                    <br>
                    <!-- <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <label for="audio">Audio File</label>
                        <input type="file" name="audio" accept="audio/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-audio-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text audio_error"></span>
                    </div> -->
                    <div class="col-md-6   form-group has-feedback">
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
                            <br>
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
<!-- <div class="col-md-6 form-group">
    <label for="subject_name">Filter Subject (Section)</label>
    <select class="form-control" name="subject_name" id="subject_name">
        <option value=""> All </option>
        @foreach ($levels as $level)
        <option value="{{ $level->subject->name }}"> {{ $level->subject->name }} </option>
        @endforeach
    </select>
</div>
<div class="col-md-6 form-group">
    <label for="topic_name">Filter Topic</label>
    <select class="form-control" name="topic_name" id="topic_name">
        <option value=""> All </option>
    </select>
</div> -->
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Exercise List</h2>
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
                                <th class="column-title">No</th>
                                <th class="column-title">Section</th>
                                <th class="column-title">Topic</th>
                                <th class="column-title">Level</th>
                                <th class="column-title">Question</th>
                                <th class="column-title">Answer Key</th>
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
$(document).ready(function() {
    // Get Filtering Topic By Filtering Subject
    $('#subject_name').change(function() {
        var subject_name = $(this).val();
        if (subject_name) {
            $.ajax({
                url: '{{ route("admin.level.get.f.topic") }}',
                type: 'GET',
                data: {
                    subject_name: subject_name
                },
                dataType: 'json',
                success: function(data) {
                    $('#topic_name').empty();
                    $('#topic_name').append(
                        '<option value=""> Choose Topic </option>');
                    $.each(data, function(index, topic) {
                        $('#topic_name').append('<option value="' + topic.title +
                            '">' + "(" + topic.subject.name + ")" + " " + topic
                            .title + '</option>');
                    });
                }
            });
        }
    });

    // Get Filtering Title By Filtering Topic
    $('#topic_name').change(function() {
        var topic_name = $(this).val();
        if (topic_name) {
            $.ajax({
                url: '{{ route("admin.level.get.f.title") }}',
                type: 'GET',
                data: {
                    topic_name: topic_name
                },
                dataType: 'json',
                success: function(data) {
                    $('#title_name').empty();
                    $('#title_name').append(
                        '<option value=""> Choose Level </option>');
                    $.each(data.levels, function(title) {
                        $('#title_name').append('<option value="' + title +
                            '">' + title + '</option>');
                    });
                }
            });
        }
    });

    $('#add_exercise').on('submit', function(e) {
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
                    Swal.fire(
                        'Added!',
                        'Exercise Data Added Successfully!',
                        'success'
                    )
                }
            }
        });
    });

    var table = $('#exercise_table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: "{{ route('admin.exercise.list') }}",
        columns: [{
                data: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: "level_subject_name",
                name: "level.subject.name"
            },
            {
                data: "level_topic_title",
                name: "level.topic.title"
            },
            {
                data: "level_title",
                name: "level.title"
            },
            {
                data: "question",
                name: "question"
            },
            {
                data: "answer_key",
                render: function(data, type, row) {
                    if (row.answer_key == 'A') {
                        return '<strong> (A) </strong>' + row.option_a;
                    } else if (row.answer_key == 'B') {
                        return '<strong> (B) </strong>' + row.option_b;
                    } else if (row.answer_key == 'C') {
                        return '<strong> (C) </strong>' + row.option_c;
                    } else if (row.answer_key == 'D') {
                        return '<strong> (D) </strong>' + row.option_d;
                    } else {
                        return '<strong> (E) </strong>' + row.option_e;
                    }
                },

            },
            {
                data: "actions",
                name: "actions"
            },
        ]
    });

    /// Add column filtering for subject_name column
    $('#subject_name').on('change', function() {
        table.column('level.subject.name:name')
            .search(this.value)
            .draw();
    });

    // Add column filtering for topic_title column
    $('#topic_name').on('change', function() {
        table.column('level.topic.title:name')
            .search(this.value)
            .draw();
    });

    // Add column filtering for title_level column
    $('#title_name').on('change', function() {
        table.column('level.title:name')
            .search(this.value)
            .draw();
    });

    $(document).on('click', '#edit_exercise_btn', function() {
        const exercise_id = $(this).data('id');
        const url = '{{ route("admin.exercise.detail") }}';
        $('.edit_exercise_modal').find('form')[0].reset();
        $.post(url, {
            exercise_id: exercise_id
        }, function(data) {
            $('.edit_exercise_modal').find('input[name="exercise_id"]').val(data.details.id);
            $('.edit_exercise_modal').find('select[name="level_id"]').val(data.details
                .level_id);
            $('.edit_exercise_modal').find('textarea[name="question"]').val(data.details
                .question);
            $('.edit_exercise_modal').find("#image").html(
                `<img src="storage/exercise_image/${data.details.image}" width="360" height="300">`
            );
            $('.edit_exercise_modal').find('input[name="option_a"]').val(data.details.option_a);
            $('.edit_exercise_modal').find('input[name="option_b"]').val(data.details.option_b);
            $('.edit_exercise_modal').find('input[name="option_b"]').val(data.details.option_b);
            $('.edit_exercise_modal').find('input[name="option_c"]').val(data.details.option_c);
            $('.edit_exercise_modal').find('input[name="option_d"]').val(data.details.option_d);
            $('.edit_exercise_modal').find('input[name="option_e"]').val(data.details.option_e);
            $('.edit_exercise_modal').find('select[name="answer_key"]').val(data.details
                .answer_key);
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
                    Swal.fire(
                        'Updated!',
                        'Exercise Data Updated Successfully!',
                        'success'
                    )
                }
            }
        });
    });

    $(document).on('click', '#delete_exercise_btn', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.delete.exercise') }}",
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.code == 0) {
                            Swal.fire(
                                'Oops!',
                                'Something went wrong!.',
                                'error'
                            )
                        } else {
                            $('#exercise_table').DataTable().ajax.reload(null,
                                false);
                            Swal.fire(
                                'Deleted!',
                                'Exercise data has been deleted.',
                                'success'
                            )
                        }
                    }
                });
            }
        })
    });
});
</script>
@endsection