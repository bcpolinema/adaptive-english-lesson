@extends('layout-admin')
@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Subject</h1>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Subject Data</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form id="add_subject" action="{{route('admin.add.subject')}}" method="POST"
                    class="form-label-left input_mask" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 form-group has-feedback">
                        <input type="text" name="title" class="form-control has-feedback-left" placeholder="Subject Title">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <select class="form-control" name="topic_id">
                            <option selected disabled> -- Choose Topic --</option>
                            @forelse ($topics as $topic)
                            <option value="{{$topic-> {'id'} }}"> {{$topic-> {'name'} }} </option>
                            @empty
                            <option value="1">1</option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text topic_id_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group">
                        <input type="checkbox" name="is_pretest" value="1">
                        <input type="hidden" name="is_pretest" value="0">
                        <label for="is_pretest"> Is Pretest</label><br>
                        <span class="text-danger error-text is_pretest_error"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 form-group has-feedback">
                        <textarea type="text" rows="5" name="content" class="form-control has-feedback-left"
                            placeholder="Subject Content"></textarea>
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text content_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="file" name="video" accept="video/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-video-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text video_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <input type="file" name="audio" accept="audio/*" class="form-control has-feedback-left">
                        <span class="fa fa-file-audio-o form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text audio_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <input type="file" name="image" accept="image/*" class="form-control has-feedback-left">
                        <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text image_error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 form-group">
                        <input type="text" name="youtube" class="form-control has-feedback-left"
                            placeholder="YouTube Link">
                        <span class="fa fa-play form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text youtube_error"></span>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <select class="form-control" name="route1">
                            <option selected disabled> -- Route 1 --</option>
                            @forelse ($subjects as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @empty
                            <option value="1">1</option>
                            @endforelse
                        </select>
                        <!-- <span class="text-danger error-text topic_id_error"></span>
                        <input type="number" name="route1" class="form-control has-feedback-left" placeholder="Route 1">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text route1_error"></span> -->
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <select class="form-control" name="route2">
                            <option selected disabled> -- Route 2 --</option>
                            @forelse ($subjects as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @empty
                            <option value="1">1</option>
                            @endforelse
                        </select>
                        <!-- <input type="number" name="route2" class="form-control has-feedback-left" placeholder="Route 2">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text route2_error"></span> -->
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <select class="form-control" name="route3">
                            <option selected disabled> -- Route 3 --</option>
                            @forelse ($subjects as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @empty
                            <option value="1">1</option>
                            @endforelse
                        </select>
                        <!-- <input type="number" name="route3" class="form-control has-feedback-left" placeholder="Route 3">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text route3_error"></span> -->
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <select class="form-control" name="route4">
                            <option selected disabled> -- Route 4 --</option>
                            @forelse ($subjects as $s)
                            <option value="{{$s-> {'id'} }}"> {{$s-> {'title'} }} </option>
                            @empty
                            <option value="1">1</option>
                            @endforelse
                        </select>
                        <!-- <input type="number" name="route4" class="form-control has-feedback-left" placeholder="Route 4">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text route4_error"></span> -->
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Add</button>
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
                <h2>Subject</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="subject_table" class="table table-striped jambo_table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">ID </th>
                                <th class="column-title">Subject Title</th>
                                <th class="column-title">Topic</th>
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
@include('admin.edit_subject-modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $("#add_subject").on("submit", function(e) {
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
                        $('#subject_table').DataTable().ajax.reload(null, false);
                        Swal.fire(
                            'Added!',
                            'Subject Data Added Successfully!',
                            'success'
                        )
                    }
                },
            });
        });


        $('#subject_table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.subject.list') }}",
            columns: [{
                    data: "id",
                    name: "id"
                },
                {
                    data: "title",
                    name: "title"
                },
                {
                    data: "topic_name",
                    name: "topic.name"
                },
                {
                    data: "actions",
                    name: "actions"
                },
            ]
        });

        
        $(document).on('click', '#edit_subject_btn', function() {
            const subject_id = $(this).data('id');
            const url = '{{ route("admin.subject.detail") }}';
            $('.edit_subject_modal').find('form')[0].reset();
            $.post(url, {
                subject_id: subject_id
            }, function(data) {
                $('.edit_subject_modal').find('input[name="subject_id"]').val(data.details.id);
                $('.edit_subject_modal').find('input[name="title"]').val(data.details.title);
                $('.edit_subject_modal').find('select[name="topic_id"]').val(data.details.topic_id);
                $('.edit_subject_modal').find('textarea[name="content"]').val(data.details.content);
                $('.edit_subject_modal').find('input[name="youtube"]').val(data.details.youtube);
                $('.edit_subject_modal').find('input[name="route1"]').val(data.details.route1);
                $('.edit_subject_modal').find('input[name="route2"]').val(data.details.route2);
                $('.edit_subject_modal').find('input[name="route3"]').val(data.details.route3);
                $('.edit_subject_modal').find('input[name="route4"]').val(data.details.route4);
                $('.edit_subject_modal').modal('show');
            }, 'json');
        });

        $('#update_subject_form').on('submit', function(e) {
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
                        $('#subject_table').DataTable().ajax.reload(null, false);
                        $('.edit_subject_modal').modal('hide');
                        Swal.fire(
                            'Updated!',
                            'Subject Data Updated Successfully!',
                            'success'
                        )
                    }
                }
            });
        });

        $(document).on('click', '#delete_subject_btn', function(e) {
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
                        url: "{{ route('admin.delete.subject') }}",
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
                                $('#subject_table').DataTable().ajax.reload(null, false);
                                Swal.fire(
                                    'Deleted!',
                                    'Subject data has been deleted.',
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