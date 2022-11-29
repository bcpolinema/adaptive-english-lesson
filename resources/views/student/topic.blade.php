@extends('layout-student')
@section('content')
<style>
    .button-65 {
    appearance: none;
    backface-visibility: hidden;
    background-color: #2f80ed;
    border-radius: 10px;
    border-style: none;
    box-shadow: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: Inter,-apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif;
    font-size: 15px;
    font-weight: 500;
    height: 50px;
    letter-spacing: normal;
    line-height: 1.5;
    outline: none;
    overflow: hidden;
    padding: 14px 30px;
    position: relative;
    text-align: center;
    text-decoration: none;
    transform: translate3d(0, 0, 0);
    transition: all .3s;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: top;
    white-space: nowrap;
    margin-left: 40%;
    margin-top: 2%;
    margin-bottom: 5%;
    }

    .button-65:hover {
    background-color: #1366d6;
    box-shadow: rgba(0, 0, 0, .05) 0 5px 30px, rgba(0, 0, 0, .05) 0 1px 4px;
    opacity: 1;
    transform: translateY(0);
    transition-duration: .35s;
    }

    .button-65:hover:after {
    opacity: .5;
    }

    .button-65:active {
    box-shadow: rgba(0, 0, 0, .1) 0 3px 6px 0, rgba(0, 0, 0, .1) 0 0 10px 0, rgba(0, 0, 0, .1) 0 1px 4px -1px;
    transform: translateY(2px);
    transition-duration: .35s;
    }

    .button-65:active:after {
    opacity: 1;
    }

    @media (min-width: 768px) {
    .button-65 {
        padding: 14px 22px;
        width: 176px;
    }
    }

    .start{
        margin: auto auto;
        color: white;
    }
</style>

<div>
    <h1>Topics</h1>
    @forelse($level_1 as $level_one)
    <form id="start_form" action="{{route('student.start')}}" method="POST">
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
                                    window.location.href = "{{ route('student.level', ['id'=>$level_one->id] )}}"
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
    <!-- @forelse ($topic as $t)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $t->title }}</h2>
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
                                        <p></p>
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
    @empty
    <code>no topics available</code>
    @endforelse -->
</div>
@endsection

