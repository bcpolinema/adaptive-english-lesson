@extends('layout-student')
@section('content')
<h1>Exercise</h1>
@forelse ($subjects as $subject)
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>afds</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display: block;">
                <audio controls>
                    <source src="{{ asset('storage/audio/' . $subject->audio) }}">
                    Your browser does not support the audio element.
                </audio>
                <form action="" method="POST">
                    @forelse ($exercises as $exercise)
                    <br>
                    <div class="form-group row">
                        <label>{{ $exercise->{'question'} }} </label>
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="a"> A. {{ $exercise->{'option_a'} }}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="b"> B. {{ $exercise->{'option_b'} }}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="c"> C. {{ $exercise->{'option_c'} }}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="d"> D. {{ $exercise->{'option_d'} }}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="e"> E. {{ $exercise->{'option_e'} }}
                                </label>
                            </div>
                        </div>
                    </div>
                    @empty
                    <code>no exercise available</code>
                    @endforelse
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@empty
<code>no data available</code>
@endforelse
@endsection