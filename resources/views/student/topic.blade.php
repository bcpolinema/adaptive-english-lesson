@extends('layout-student')
@section('content')
<div>
    <h1>Topics</h1>
    @forelse($level_1 as $level_one)
    <form id="start_form" action="{{ route('student.start') }}" method="POST">
        @csrf
        <input type="hidden" name="level_id" value="{{ $level_one->id }}">
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
                                    window.location.href = '/s/'+ data.stdlrn.id +'/level/'+ {{ $level_one->id }}
                                }
                            }
                        });
                    });
                });
        </script>           
        @endsection
        <button class="button-65" role="button" type="submit">Start Lesson</button>
    </form>
    @empty
    <code>No Topics Available</code>
    @endforelse
    <!-- @foreach ($levels as $l)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $l->topic->title }}</h2>
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
                                    <a href="#" class="tag">
                                        <span>Start</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <p>Level {{ $l->title }}</p>
                                    </h2>
                                    <div class="byline"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endforeach  -->
</div>
@endsection

