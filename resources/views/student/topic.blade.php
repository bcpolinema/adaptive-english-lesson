@extends('layout-master')
@section('content')
<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <br>
                    <h2 style="text-align:center;"><strong>List Topic Of {{ $subject_name }}</strong></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">
                    <ul class="list-unstyled timeline">
                        <li>
                            <div class="block">
                                <div class="block_content">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <ol class="list-topic" style="--length: 5" role="list">
                                                @foreach ($topics as $topic)
                                                <li class="list-topic" style="--i: 5">
                                                    <h3 class="list-topic">{{ $topic->title }}</h3>
                                                    <p class="list-topic">Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua. Adipiscing diam donec adipiscing tristique risus.
                                                    </p><br>
                                                    <a href="{{ route('student.level_list', ['tpc_id' => $topic->id ] ) }}"
                                                        class="button-topic">
                                                        <span><strong>Start Topic</strong></span>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ol>
                                            <div class="byline"></div>
                                        </div>
                                    </div>
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