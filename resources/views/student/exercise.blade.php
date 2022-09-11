@extends('layout-student')
@section('content')
<h1>Exercise</h1>
@forelse ($subjects as $subject)
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Question</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display: block;">
                <!-- <audio controls>
                    <source src="{{ asset('storage/audio/' . $subject->audio) }}">
                    Your browser does not support the audio element.
                </audio> -->
                <form id="exercise_form" action="{{route('student.submit')}}" method="POST">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{$subject_id}}">
                    <?php $number = 1; ?>
                    @forelse ($exercises as $exercise)
                    <br>
                    <div class="form-group row">
                        <label>{{ $number }}. {{ $exercise->{'question'} }} </label>
                        <?php $number++; ?>
                        <div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="A"> A. {{ $exercise->{'option_a'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="B"> B. {{ $exercise->{'option_b'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="C"> C. {{ $exercise->{'option_c'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="D"> D. {{ $exercise->{'option_d'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="E"> E. {{ $exercise->{'option_e'} }}
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
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        processData: false,
                        data: new FormData(form),
                        dataType: 'json',
                        contentType: false,
                        success: function(response) {
                            if (response.code == 0) {
                                Swal.fire(
                                    'Oops!',
                                    'Something went wrong!.',
                                    'error'
                                )
                            } else {
                                $(form)[0].reset();
                                Swal.fire(
                                    'Added!',
                                    'Your answer has submitted!',
                                    'success'
                                )
                                return redirect()->back();
                            }
                        }
                    });
                }       
            })
        });
    });
</script>
@endsection