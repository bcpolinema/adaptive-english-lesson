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
    <h1>Lesson</h1>
    @forelse($level_1 as $level_one)
    <form id="start_form" action="{{route('student.start')}}" method="POST">
        <button class="button-65" role="button" type="submit">
            <a href="{{ route('student.level', ['id'=>$level_one->id] )}}" class="start">Start Lesson</a>
        </button>
    </form>
    @empty
    <code>No Lessons Available</code>
    @endforelse
    <!-- @forelse ($levels as $level)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $level->title }}</h2>
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
                                    @if(empty($level->stdlearnings->isEmpty() ? '0': $level->stdlearnings[0]->score))
                                    <a href="{{ route('student.level', ['id'=>$level->id] )}}" class="tag">
                                        <span>Start</span>
                                    </a>
                                    @else
                                    <a href="#" class="tag">
                                        <span>Next</span>
                                    </a>
                                    @endif
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <p>Score : {{ $level->stdlearnings->isEmpty() ? '0': $level->stdlearnings[0]->score }}</p>
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
    <code>no lessons available</code>
    @endforelse -->
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#start_form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            const level_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Start it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        processData: false,
                        data: new FormData(form),
                        dataType: 'json',
                        contentType: false,
                        success: function(response) {
                            if (response.code == 0) {
                                Swal.fire(
                                    'Oops!',
                                    'Something went wrong!.',
                                    'error'
                                )
                            } else {
                                $(form)[0].reset();
                                Swal.fire(
                                    'Added!',
                                    'Your answer has submitted!',
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