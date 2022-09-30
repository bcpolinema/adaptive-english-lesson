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
                @if(!empty($sum_score))
                    <div>
                        <p><strong style="font-size: 14px;">Your Latest Score : </strong>{{ $sum_score }}</p>
                    </div>  
                @else
                @endif      
                @if(!empty($level->image))
                <div class="polaroid">
                    <img src="{{ url('storage/image/'.$level->image) }}" alt="" style="width:100%; height:auto">
                </div>
                @endif
                <!-- @if(!empty($level->audio))
                <div class="polaroid">
                    <audio controls="controls">
                        <source src="{{ url('storage/audio/'.$level->audio) }}" type="audio/mp3" />
                    </audio>
                </div>
                @endif -->
                <h4>{{ $level->content }}</h4>
                <!-- @if(!empty($level->video))
                <video controls="controls" width="260" height="120">
                    <source src="{{ url('storage/video/'.$level->video) }}" type="video/mp4" />
                </video>
                @endif -->
                <div class="col-md-9 col-sm-9  offset-md-3">
                    <a href="{{ route('student.exercise', ['id'=>$level->id]) }}">
                    <button class="btn btn-success">Take Exercise</button></a>
                </div>
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