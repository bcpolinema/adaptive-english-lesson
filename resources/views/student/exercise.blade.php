@extends('layout-master')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Exercise</h2>
            </div>
            <div class="x_content" style="display: block;">
                <form id="exercise_form" action="{{route('student.submit')}}" method="POST">
                    <input type="hidden" name="stdlrn_id" value="{{ $stdlrn->id }}">
                    @csrf
                    <?php $number = 1; ?>
                    <ol class="list-question" style="--length: 10" role="list">
                        @forelse ($exercises as $exercise)
                        <li class="list-question" style="--i: 5">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="list-question">{{ $number }}. {{ $exercise->{'question'} }} </h3>
                                <?php $number++; ?>
                                @if($exercise->image)
                                <div class="img-container">
                                    <img src="{{ url('storage/exercise_image/'.$exercise->{'image'}) }}" height="auto"
                                        width="300px">
                                </div>
                                @endif
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="radio">
                                        <label>
                                            <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="A">
                                            A.
                                            {{ $exercise->{'option_a'} }}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="B">
                                            B.
                                            {{ $exercise->{'option_b'} }}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="C">
                                            C.
                                            {{ $exercise->{'option_c'} }}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="D">
                                            D.
                                            {{ $exercise->{'option_d'} }}
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input name="soal[{{ $exercise->{'id'} }}]" type="radio" value="E">
                                            E.
                                            {{ $exercise->{'option_e'} }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @empty
                        <code>no exercise available</code>
                        @endforelse
                    </ol>

                    <div class="col-md-12 col-sm-12 form-group has-feedback">
                        <label for="comment">Comment</label>
                        <textarea type="text" rows="5" name="comment" class="form-control has-feedback-left"
                            placeholder="Comment"></textarea>
                        <span class="text-danger error-text comment_error"></span>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 offset-md-9 pull-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
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
        const take_id = $(this).data('id');
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
                            console.log(response);
                            $(form)[0].reset();
                            Swal.fire(
                                'Added!',
                                'Your answer has submitted!',
                                'success'
                            )
                            window.history.go(-2);
                        }
                    }
                });
            }
        })
    });
});
</script>
@endsection