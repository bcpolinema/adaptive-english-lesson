@extends('layout-master')
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
    @forelse ($subjects as $s)
    <div class="col-md-6">
        <div class="thumbnail">
            <div class="image view view-first">
                <img style="width: 100%; display: block;" src="{{ url('storage/thumbnail/'.$s->{'thumbnail'}) }}"
                    alt="image">
                <div class="mask">
                    <p>Start Lesson</p>
                    <div class="tools tools-bottom">
                        <a href="{{ route('student.subject', ['id' => $s->{'id'} ] ) }}"><i
                                class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="caption">
                <img src="{{ url('storage/icon/'.$s->{'icon'}) }}" height="40" width="40">&nbsp;&nbsp;
                <strong style="font-size: 20px;color:black;"> {{ $s-> {'name'} }}</strong>
                <p style="font-size: 15px;color:black;">{{ $s->description }}</p>
            </div>
        </div>
    </div>
    @empty
    <code>no topic available at the moment</code>
    @endforelse
</div>
@endsection