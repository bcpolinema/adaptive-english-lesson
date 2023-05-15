@extends('layout-admin')
@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Level</h1>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Level Data</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form id="add_level" action="{{route('admin.add.level')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 form-group">
                        <br>
                        <label for="subject_id">Subject</label>
                        <select class="form-control" name="subject_id" id="subject_id">
                            <option selected disabled> -- Choose Subject --</option>
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"> {{ $subject->name }} </option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text subject_id_error"></span>
                    </div>
                    <div class="col-md-6 form-group">
                        <br>
                        <label for="topic_id">Choose Topic</label>
                        <select class="form-control" name="topic_id" id="topic_id">
                            <option value=""> -- Choose Topic --</option>
                        </select>
                        <span class="text-danger error-text topic_id_error"></span>
                    </div>
                    <div class="col-md-12 form-group has-feedback">
                        <label for="title">Level</label>
                        <input type="text" name="title" class="form-control has-feedback-left"
                            placeholder="Level Title">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="col-md-12 form-group has-feedback">
                        <strong><strong style="color:red;font-size:16px;">*</strong> Example input form level title
                            :
                            Level
                            1</strong>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <input type="checkbox" name="is_pretest" value="1">
                        <input type="hidden" name="is_pretest" value="0">
                        <label for="is_pretest"> Is Pretest</label><br>
                        <span class="text-danger error-text is_pretest_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <input type="checkbox" name="is_termination" value="1">
                        <input type="hidden" name="is_terminaton" value="0">
                        <label for="is_termination"> Is Termination</label><br>
                        <span class="text-danger error-text is_termination_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group has-feedback">
                        <label for="content">Level Content</label>
                        <textarea type="text" rows="5" name="content" class="form-control has-feedback-left"
                            placeholder="Level Content"></textarea>
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text content_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="video">Video File</label>
                        <input type="file" name="video" accept="video/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-video-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text video_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <label for="audio">Audio File</label>
                        <input type="file" name="audio" accept="audio/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-audio-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text audio_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="image">Image File</label>
                        <input type="file" name="image" accept="image/*" class="form-control has-feedback-left">
                        <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text image_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group has-feedback">
                        <label for="youtube">Youtube Link</label>
                        <input type="text" name="youtube" class="form-control has-feedback-left"
                            placeholder="YouTube Link">
                        <span class="fa fa-play form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text youtube_error"></span>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <br>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 form-group">
    <label for="subject_name">Filter Subject (Section)</label>
    <select class="form-control" name="subject_name" id="subject_name">
        <option value=""> All </option>
        @foreach ($subjects as $subject)
        <option value="{{ $subject->name }}"> {{ $subject->name }} </option>
        @endforeach
    </select>
</div>
<div class="col-md-6 form-group">
    <label for="topic_name">Filter Topic</label>
    <select class="form-control" name="topic_name" id="topic_name">
        <option value=""> All </option>
    </select>
</div>
<!-- <div class="col-md-4 form-group">
    <label for="title_name">Filter Level</label>
    <select class="form-control" name="title_name" id="title_name">
        <option value=""> All </option>
    </select>
</div> -->
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Level List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="level_table" class="table table-striped jambo_table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">No</th>
                                <th class="column-title">Section</th>
                                <th class="column-title">Topic</th>
                                <th class="column-title">Level</th>
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
@include('admin.edit_level-modal')
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Get Data Topic By Data Subject ( Insert Data )
    $('#subject_id').change(function() {
        var subject_id = $(this).val();
        if (subject_id) {
            $.ajax({
                url: '{{ route("admin.level.get.topic") }}',
                type: 'GET',
                data: {
                    subject_id: subject_id
                },
                dataType: 'json',
                success: function(data) {
                    $('#topic_id').empty();
                    $('#topic_id').append(
                        '<option value=""> -- Choose Topic --</option>');
                    $.each(data, function(index, topic) {
                        $('#topic_id').append('<option value="' + topic.id +
                            '">' + "(" + topic.subject.name + ")" + " " +
                            topic.title + '</option>');
                    });
                }
            });
        }
    });

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

    // Insert Data
    $("#add_level").on("submit", function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: new FormData(form),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function() {
                $(this).find("span.error-text").text("");
            },
            success: function(data) {
                if (data.code == 0) {
                    $.each(data.error, function(prefix, val) {
                        $(form)
                            .find("span." + prefix + "_error")
                            .text(val[0]);
                    });
                } else {
                    $(form)[0].reset();
                    $('#level_table').DataTable().ajax.reload(null, false);
                    Swal.fire(
                        'Added!',
                        'Level Data Added Successfully!',
                        'success'
                    )
                }
            },
        });
    });

    // DataTables
    var table = $('#level_table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: "{{ route('admin.level.list') }}",
        columns: [{
                data: "id",
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }

            },
            {
                data: "subject_name",
                name: "subject.name"
            },
            {
                data: "topic_title",
                name: "topic.title"
            },
            {
                data: "title",
                name: "title"
            },
            {
                data: "actions",
                name: "actions"
            },
        ]
    });

    // Add column filtering for subject_name column
    $('#subject_name').on('change', function() {
        table.column('subject.name:name')
            .search(this.value)
            .draw();
    });

    // Add column filtering for topic_title column
    $('#topic_name').on('change', function() {
        table.column('topic.title:name')
            .search(this.value)
            .draw();
    });

    // Add column filtering for title_level column
    $('#title_name').on('change', function() {
        table.column('title:name')
            .search(this.value)
            .draw();
    });

    // View Edit Data
    $(document).on('click', '#edit_level_btn', function() {
        const level_id = $(this).data('id');
        const url = '{{ route("admin.level.detail") }}';
        $('.edit_level_modal').find('form')[0].reset();
        $.post(url, {
            level_id: level_id
        }, function(data) {
            $('.edit_level_modal').find('input[name="level_id"]').val(data.details.id);
            $('.edit_level_modal').find('input[name="title"]').val(data.details.title);
            $('.edit_level_modal').find('select[name="subject_id"]').val(data.details
                .subject_id);
            $('.edit_level_modal').find('select[name="topic_id"]').val(data.details
                .topic_id);
            $('.edit_level_modal').find('textarea[name="content"]').val(data.details.content);
            $('.edit_level_modal').find('input[name="is_pretest"]').prop('checked', data.details
                .is_pretest);
            $('.edit_level_modal').find('input[name="is_termination"]').prop('checked', data
                .details.is_termination);
            $('.edit_level_modal').find("#image").html(
                `<img src="storage/image/${data.details.image}" width="260" height="120">`);
            $('.edit_level_modal').find("#video").html(
                `<video controls="controls" width="260" height="120">
                        <source src="storage/video/${data.details.video}" type="video/mp4" />
                    </video>`);
            $('.edit_level_modal').find("#audio").html(
                `<audio controls="controls">
                        <source src="storage/audio/${data.details.audio}" type="audio/mp3" />
                    </audio>`);
            $('.edit_level_modal').find("#level_image").val(data.details.image);
            $('.edit_level_modal').find("#level_video").val(data.details.video);
            $('.edit_level_modal').find("#level_audio").val(data.details.audio);
            $('.edit_level_modal').find('input[name="youtube"]').val(data.details.youtube);
            $('.edit_level_modal').find('select[name="route1"]').val(data.details.route1);
            $('.edit_level_modal').find('select[name="route2"]').val(data.details.route2);
            $('.edit_level_modal').find('select[name="route3"]').val(data.details.route3);
            $('.edit_level_modal').find('select[name="route4"]').val(data.details.route4);
            $('.edit_level_modal').modal('show');
        }, 'json');
    });

    // Update Data
    $('#update_level_form').on('submit', function(e) {
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
                    $('#level_table').DataTable().ajax.reload(null, false);
                    $('.edit_level_modal').modal('hide');
                    Swal.fire(
                        'Updated!',
                        'Level Data Updated Successfully!',
                        'success'
                    )
                }
            }
        });
    });

    // Delete Data
    $(document).on('click', '#delete_level_btn', function(e) {
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
                    url: "{{ route('admin.delete.level') }}",
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
                            $('#level_table').DataTable().ajax.reload(null, false);
                            Swal.fire(
                                'Deleted!',
                                'Level data has been deleted.',
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