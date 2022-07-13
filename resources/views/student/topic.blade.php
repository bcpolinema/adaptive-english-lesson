@extends('layout-student')
@section('content')
<h1>Lessons</h1>
@forelse ($subjects as $subject)
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ $subject->{'title'} }}</h2>
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
                                <a href="" class="tag">
                                    <span>Link</span>
                                </a>
                            </div>
                            <div class="block_content">
                                <h2 class="title">
                                    <a>Judul pembelajaran {{ $subject->{'id'} }}</a>
                                </h2>
                                <div class="byline">
                                    <span>by </span> teacher <a>Jane Smith</a>
                                </div>
                                <p class="excerpt">Description</a>
                                </p>
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