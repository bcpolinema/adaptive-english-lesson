@extends('layout-student')
@section('content')
<h1>Lessons</h1>
@forelse ($levels as $level)
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
@endforelse

@endsection