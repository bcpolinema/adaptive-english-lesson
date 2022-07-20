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
                <form id="exercise_form" action="{{route('student.submit')}}" method="POST">
                    @csrf
                    <input type="hidden" name="subject_id">
                    @forelse ($exercises as $exercise)
                    <br>
                    <div class="form-group row">
                        <label>{{ $exercise->{'question'} }} </label>
                        <div>
                            <div class="radio">
                                <label>
                                    <input data-exercise_id = {{$exercise->{'id'} }} name="answer" type="radio" value="a"> A. {{ $exercise->{'option_a'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="answer" type="radio" value="b"> B. {{ $exercise->{'option_b'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="answer" type="radio" value="c"> C. {{ $exercise->{'option_c'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="answer" type="radio" value="d"> D. {{ $exercise->{'option_d'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="answer" type="radio" value="e"> E. {{ $exercise->{'option_e'} }}
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
<code>no exercise available</code>
@endforelse
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#exercise_form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            alert("submited");
            // $.ajax({
            //     url: $(form).attr('action'),
            //     method: $(form).attr('method'),
            //     data: new FormData(form),
            //     processData: false,
            //     dataType: 'json',
            //     contentType: false,
            //     beforeSend: function() {
            //         $(this).find('span.error-text').text('');
            //     },
            //     success: function(data) {
            //         if (data.code == 0) {
            //             $.each(data.error, function(prefix, val) {
            //                 $(form).find('span.' + prefix + '_error').text(val[0]);
            //             });
            //         } else {
            //             $(form)[0].reset();
            //             $('#topic_table').DataTable().ajax.reload(null, false);
            //             alert(data.msg);
            //         }
            //     }
            // });
        });
    });
</script>
@endsection