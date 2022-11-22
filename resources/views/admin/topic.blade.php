@extends('layout-admin')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Topic</h1>
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Topic Data</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form id="add_topic" action="{{route('admin.add.topic')}}" method="POST" class="form-label-left input_mask">
                    @csrf
                    <div class="col-md-6 col-sm-6 form-group">
                        <label for="subject_id">Choose Subject</label> 
                        <select class="form-control" name="subject_id">
                            <option selected disabled> -- Choose Subject --</option>
                            @forelse ($subjects as $subject)
                            <option value="{{ $subject-> {'id'} }}"> {{ $subject-> {'name'} }} </option>
                            @empty
                            <option value="1">1</option>
                            @endforelse
                        </select>
                        <span class="text-danger error-text subject_id_error"></span>
                    </div>
                    <div class="col-md-12  form-group has-feedback">
                        <label for="title">Topic Name</label>  
                        <input type="text" name="title" class="form-control has-feedback-left" placeholder="Topic Name">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text title_error"></span>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
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
                <h2>Topic List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table id="topic_table" class="table table-striped jambo_table">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">No</th>
                                <th class="column-title">Section</th>
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
@include('admin.edit_topic-modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add_topic').on('submit', function(e) {
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
                        $('#topic_table').DataTable().ajax.reload(null, false);
                        Swal.fire(
                            'Added!',
                            'Topic Data Added Successfully!',
                            'success'
                        )
                    }
                }
            });
        });


        $('#topic_table').DataTable({
            processing: true,
            info: true,
            ajax: "{{ route('admin.topic.list') }}",
            columns: [{
                    data: "id",
                    name: "id",
                    render: function(data, type, row, meta) {
                        return i++;
                    }
                },
                {
                    data: "subject_name",
                    name: "subject.name"
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

        $(document).on('click', '#edit_topic_btn', function() {
            const topic_id = $(this).data('id');
            const url = '{{ route("admin.topic.detail") }}';
            $('.edit_topic_modal').find('form')[0].reset();
            $.post(url, {
                topic_id: topic_id
            }, function(data) {
                $('.edit_topic_modal').find('input[name="topic_id"]').val(data.details.id);
                $('.edit_topic_modal').find('select[name="subject_id"]').val(data.details.subject_id);
                $('.edit_topic_modal').find('input[name="title"]').val(data.details.title);
                $('.edit_topic_modal').modal('show');
            }, 'json');
        });

        $('#update_topic_form').on('submit', function(e) {
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
                        $('#topic_table').DataTable().ajax.reload(null, false);
                        $('.edit_topic_modal').modal('hide');
                        Swal.fire(
                            'Updated!',
                            'Topic Data Updated Successfully!',
                            'success'
                        )
                    }
                }
            });
        });

        $(document).on('click', '#delete_topic_btn', function(e) {
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
                        url: "{{ route('admin.delete.topic') }}",
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
                                $('#topic_table').DataTable().ajax.reload(null, false);
                                Swal.fire(
                                    'Deleted!',
                                    'Topic data has been deleted.',
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