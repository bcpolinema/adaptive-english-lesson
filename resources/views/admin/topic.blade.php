@extends('layout-admin')
@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
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
                    <div class="col-md-12  form-group has-feedback">
                        <input type="text" name="name" class="form-control has-feedback-left" placeholder="Name">
                        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text name_error"></span>
                    </div>
                    <div class="col-md-12  form-group has-feedback">
                        <input type="text" name="description" class="form-control has-feedback-left" placeholder="Description">
                        <span class="fa fa-info form-control-feedback left" aria-hidden="true"></span>
                        <span class="text-danger error-text description_error"></span>
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
                <h2>Topic</h2>
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
                                <th class="column-title">ID </th>
                                <th class="column-title">Name</th>
                                <th class="column-title">Description</th>
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

@include('admin.edit_topic-modal')
@endsection

@section('script')
<script>
    $(document).ready(function() {
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
                        alert(data.msg);
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
                    name: "id"
                },
                {
                    data: "name",
                    name: "name"
                },
                {
                    data: "description",
                    name: "description"
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


        $(document).on('click', '#edit_topic_btn', function() {
            const topic_id = $(this).data('id');
            const url = '{{ route("admin.topic.detail") }}';
            $('.edit_topic_modal').find('form')[0].reset();
            $.post(url, {
                topic_id: topic_id
            }, function(data) {
                $('.edit_topic_modal').find('input[name="topic_id"]').val(data.details.id);
                $('.edit_topic_modal').find('input[name="name"]').val(data.details.name);
                $('.edit_topic_modal').find('input[name="description"]').val(data.details.description);
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
                        alert(data.msg);
                    }
                }
            });
        });

        /*$(document).on('click', '#delete_topic_btn', function() {
            var topic_id = $(this).data('id');
            var url = '{{ route("admin.delete.topic") }}';
            confirm("Are You sure want to delete !");
                    
           
                    $.post(url,{topic_id:topic_id}, function(data){
                        if(data.code == 1){
                            $('#topic_table').DataTable().ajax.reload(null, false);
                            alert(data.msg);
                        }else{
                            alert(data.msg);
                        }
                    },'json');
           
        });*/

        $(document).on('click', '#delete_topic_btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            // let csrf = '{{ csrf_token() }}';
            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    url: "{{ route('admin.delete.topic') }}",
                    method: "post",
                    data: {
                        id: id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.code == 0) {
                            alert(response.msg);
                        } else {
                            $('#topic_table').DataTable().ajax.reload(null, false);
                            alert(response.msg);
                        }
                    }
                });
            };

        });
    });
</script>
@endsection