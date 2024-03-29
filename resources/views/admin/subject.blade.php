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
                <form id="add_subject" action="{{route('admin.add.subject')}}" method="POST"
                    class="form-label-left input_mask">
                    @csrf
                    <div class="col-md-12  form-group has-feedback">
                        <br>
                        <label for="name">Subject Name</label>
                        <input type="text" name="name" class="form-control has-feedback-left"
                            placeholder="Subject Name">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="col-md-12  form-group has-feedback">
                        <label for="description">Subject Description</label>
                        <input type="text" name="description" class="form-control has-feedback-left"
                            placeholder="Subject Description">
                        <span class="fa fa-info form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text description_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" name="thumbnail" accept="thumbnail/*" class="form-control has-feedback-left">
                        <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text thumbnail_error"></span>
                    </div>
                    <div class="col-md-6  form-group has-feedback">
                        <label for="icon">Icon</label>
                        <input type="file" name="icon" accept="icon/*" class="form-control has-feedback-left">
                        <span class="fa fa-image form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text icon_error"></span>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
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

<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Subject List</h2>
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
                                <th class="column-title">No</th>
                                <th class="column-title">Subject Name</th>
                                <th class="column-title">Subject Description</th>
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
    $('#add_subject').on('submit', function(e) {
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
                    Swal.fire(
                        'Added!',
                        'Subject Data Added Successfully!',
                        'success'
                    )
                }
            }
        });
    });


    $('#subject_table').DataTable({
        processing: true,
        info: true,
        ajax: "{{ route('admin.subject.list') }}",
        columns: [{
                data: "id",
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: "name",
                name: "name"
            },
            {
                data: "description",
                render: function(data, type, row, meta) {
                    if (type === 'display') {
                        return data.length > 30 ?
                            data.substr(0, 30) + '...' :
                            data;
                    } else {
                        return data;
                    }
                }
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
            $('.edit_subject_modal').find('input[name="name"]').val(data.details.name);
            $('.edit_subject_modal').find('input[name="description"]').val(data.details
                .description);
            $('.edit_subject_modal').find("#icon_preview").html(
                `<img src="storage/icon/${data.details.icon}" width="200" class="img-fluid img-thumbnail">`
            );
            $('.edit_subject_modal').find("#icon_image").val(data.details.icon);
            $('.edit_subject_modal').find("#thumbnail_preview").html(
                `<img src="storage/thumbnail/${data.details.thumbnail}" width="200" class="img-fluid img-thumbnail">`
            );
            $('.edit_subject_modal').find("#thumbnail_image").val(data.details.thumbnail);
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
                            $('#subject_table').DataTable().ajax.reload(null,
                                false);
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