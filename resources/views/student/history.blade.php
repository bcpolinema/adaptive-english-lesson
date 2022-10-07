@extends('layout-student')
@section('content')
<h1>History</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Your Answer</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display: block;">
                <form id="exercise_form" action="" method="POST">
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
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="{{ $exercise->{'answer'} }}"> A. {{ $exercise->{'option_a'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="{{ $exercise->{'answer'} }}"> B. {{ $exercise->{'option_b'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="{{ $exercise->{'answer'} }}"> C. {{ $exercise->{'option_c'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="{{ $exercise->{'answer'} }}"> D. {{ $exercise->{'option_d'} }}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="{{ $exercise->{'answer'} }}"> E. {{ $exercise->{'option_e'} }}
                                </label>
                            </div>
                        </div>
                    </div>
                    @empty
                    <code>no exercise available</code>
                    @endforelse
                    <div class="ln_solid"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#exercise_form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            const subject_id = $(this).data('id');
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
                                window.history.back();
                            }
                        }
                    });
                }       
            })
        });
    });
</script>
@endsection