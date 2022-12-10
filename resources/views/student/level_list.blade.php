@extends('layout-student')
@section('content')
<div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <!-- <h2><strong></strong></h2> -->
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">
                    <ul class="list-unstyled timeline">
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <p class="tag">
                                        <span>Status</span>
                                    </p>
                                </div>
                                <div class="block_content">
                                    @foreach($level_list as $levelst)
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-6">
                                        <form id="start_form" action="{{ route('student.start') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="level_id" value="{{ $levelst->id }}">
                                            @section('script')
                                            <script>
                                                    $(document).ready(function() {
                                                        $('#start_form').on('submit', function(e){
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
                                                                        Swal.fire(
                                                                            'Oops!',
                                                                            'Something went wrong!.',
                                                                            'error'
                                                                        )
                                                                    } else {
                                                                        window.location.href = '/s/'+ data.stdlrn.id +'/content/'+ {{ $levelst->id }}
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    });
                                            </script>           
                                            @endsection
                                            <button role="button" type="submit">Level {{ $levelst->title }}</button>
                                        </form>
                                        
                                        <div>
                                   
                                    </div>
                                    @endforeach
                                    <div class="byline"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

