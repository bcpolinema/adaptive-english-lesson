@extends('layout-admin')
@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Route</h1>
        <div class="x_panel">
            <div class="x_title">
                <h2>Rules of Route</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p style="font-size:14px; font-weight:bold;">Route 1 = Score 0 - 50</p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p style="font-size:14px; font-weight:bold;">Route 2 = Score 51 - 70</p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p style="font-size:14px; font-weight:bold;">Route 3 = Score 71 - 90</p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p style="font-size:14px; font-weight:bold;">Route 4 = Score 91 - 100</p>
                    </div>
                    <br><br><br>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p style="font-size:14px; font-weight:bold; color:red;">Note: Apabila ingin menghapus data route
                            dengan ID tertentu, maka dapat menghapus melalui tabel
                            Levels.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Route Data</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                </br>
                <form id="add_route" action="{{route('admin.add.route')}}" method="POST"
                    class="form-label-left input_mask" enctype="multipart/form-data">
                    @csrf
                    <!-- <div class="col-md-6 form-group">
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
                    </div> -->
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="">Route 1</label>
                        <select class="form-control" name="route1">
                            <option selected disabled> -- Route 1 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}"> {{ $level-> {'title'} }} (
                                {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="">Route 2</label>
                        <select class="form-control" name="route2">
                            <option selected disabled> -- Route 2 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}"> {{ $level-> {'title'} }} (
                                {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="">Route 3</label>
                        <select class="form-control" name="route3">
                            <option selected disabled> -- Route 3 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}"> {{ $level-> {'title'} }} (
                                {{ $level->topic->title }} )</option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 form-group has-feedback">
                        <label for="">Route 4</label>
                        <select class="form-control" name="route4">
                            <option selected disabled> -- Route 4 --</option>
                            @foreach($levels as $level)
                            <option value="{{ $level-> {'id'} }}"> {{ $level-> {'title'} }} (
                                {{ $level->topic->title }} ) </option>
                            @endforeach
                            <option value="0"> -- It Self --</option>
                        </select>
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
                <h2>Route List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="route_table" class="table table-striped jambo_table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">No</th>
                                <th class="column-title">Route 1</th>
                                <th class="column-title">Route 2</th>
                                <th class="column-title">Route 3</th>
                                <th class="column-title">Route 4</th>
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
@include('admin.edit_route-modal')
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Get Data Topic By Data Subject ( Insert Data )
    // $('#subject_id').change(function() {
    //     var subject_id = $(this).val();
    //     if (subject_id) {
    //         $.ajax({
    //             url: '{{ route("admin.level.get.topic") }}',
    //             type: 'GET',
    //             data: {
    //                 subject_id: subject_id
    //             },
    //             dataType: 'json',
    //             success: function(data) {
    //                 $('#topic_id').empty();
    //                 $('#topic_id').append(
    //                     '<option value=""> -- Choose Topic --</option>');
    //                 $.each(data, function(index, topic) {
    //                     $('#topic_id').append('<option value="' + topic.id +
    //                         '">' + "(" + topic.subject.name + ")" + " " +
    //                         topic.title + '</option>');
    //                 });
    //             }
    //         });
    //     }
    // });

    $("#add_route").on("submit", function(e) {
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
                    $('#route_table').DataTable().ajax.reload(null, false);
                    Swal.fire(
                        'Added!',
                        'Route Data Added Successfully!',
                        'success'
                    )
                }
            },
        });
    });


    $('#route_table').DataTable({
        processing: true,
        info: true,
        pageLength: 25,
        ajax: "{{ route('admin.route.list') }}",
        columns: [{
                data: "id",
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: "title_route1",
                render: function(data, type, row, meta) {
                    if (data != null) {
                        return data;
                    } else {
                        return "NULL";
                    }

                }
            },
            {
                data: "title_route2",
                render: function(data, type, row, meta) {
                    if (data != null) {
                        return data;
                    } else {
                        return "NULL";
                    }
                }
            },
            {
                data: "title_route3",
                render: function(data, type, row, meta) {
                    if (data != null) {
                        return data;
                    } else {
                        return "NULL";
                    }
                }
            },
            {
                data: "title_route4",
                render: function(data, type, row, meta) {
                    if (data != null) {
                        return data;
                    } else {
                        return "NULL";
                    }
                }
            },
            {
                data: "actions",
                name: "actions"
            },
        ]
    });


    $(document).on('click', '#edit_route_btn', function() {
        const level_id = $(this).data('id');
        const url = '{{ route("admin.route.detail") }}';
        $('.edit_route_modal').find('form')[0].reset();
        $.post(url, {
            level_id: level_id
        }, function(data) {
            $('.edit_route_modal').find('input[name="level_id"]').val(data.details.id);
            $('.edit_route_modal').find('select[name="route1"]').val(data.details.route1);
            $('.edit_route_modal').find('select[name="route2"]').val(data.details.route2);
            $('.edit_route_modal').find('select[name="route3"]').val(data.details.route3);
            $('.edit_route_modal').find('select[name="route4"]').val(data.details.route4);
            $('.edit_route_modal').modal('show');
        }, 'json');
    });

    $('#update_route_form').on('submit', function(e) {
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
                    $('#route_table').DataTable().ajax.reload(null, false);
                    $('.edit_route_modal').modal('hide');
                    Swal.fire(
                        'Updated!',
                        'Route Data Updated Successfully!',
                        'success'
                    )
                }
            }
        });
    });
});
</script>
@endsection