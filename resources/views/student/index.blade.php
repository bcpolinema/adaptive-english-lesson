@extends('layout-student')
@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-success alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span>
            </button>
            <strong>Selamat Datang</strong> di website pembelajaran Bahasa Inggris Polinema!
        </div>
    </div>
</div>
<div class="row">
    @forelse ($topics as $topic)
    <div class="col-md-6">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="{{ url('storage/thumbnail/'.$topic->{'thumbnail'}) }}" alt="image">
                <div class="mask">
                    <p>Start Lesson</p>
                    <div class="tools tools-bottom">
                        <a href="{{ route('student.topic', ['id' => $topic->{'id'} ] ) }}"><i class="fa fa-info-circle"></i></a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <img src="{{ url('storage/icon/'.$topic->{'icon'}) }}" height="40" width="40">
                <strong style="font-size: 17px">  {{ $topic-> {'name'} }}</strong><br>
                <p style="font-size: 11.5px">{{ $topic->description }}</p>
            </div>
        </div>
    </div>
    @empty
    <code>no topic available at the moment</code>
    @endforelse
</div>
@endsection