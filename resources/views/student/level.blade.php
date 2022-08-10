@extends('layout-student')
@section('content')
<h1>Content</h1>
@forelse ($levels as $level)
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <strong style="font-size:18px">{{ $level->title }}</strong>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display: block;">
                @if(!empty($level->image))
                <div class="polaroid">
                    <img src="{{ url('storage/image/'.$level->image) }}" alt="" style="width:100%; height:auto">
                </div>
                @else
                <code>Image Not Available</code>
                @endif
                <hr>
                <h4>{{ $level->content }}</h4>
            </div>
            <div class="col-md-9 col-sm-9  offset-md-3">
                <a href="{{ route('student.exercise', ['id'=>$level->id]) }}">
                <button class="btn btn-success">Take Exercise</button></a>
            </div>
        </div>
    </div>
</div>
@empty
<code>no exercise available</code>
@endforelse
@endsection

@section('script')
@endsection