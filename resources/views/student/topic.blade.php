@extends('layout-student')
@section('content')
<div>
    <h1>Topics</h1>
    @foreach ($topics as $topic)
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><strong>{{ $topic->title }}</strong></h2>
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
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href= "{{ route('student.level_list', ['tpc_id' => $topic->id ] ) }}" class="button-65">
                                                <span><strong>Start Topic</strong></span>           
                                            </a>
                                        <div>
                                    </div>
                                    <div class="byline"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

