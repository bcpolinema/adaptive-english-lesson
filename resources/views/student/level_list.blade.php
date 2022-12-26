@extends('layout-student')
@section('content')
<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><strong>List of Level</strong></h2>
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
                                        <div class="col">
                                            @forelse($level_list as $levelst)
                                            <button class="button-level" id="{{ $levelst->id }}" type="button"
                                                value="{{ $levelst->id }}">Level {{ $levelst->title }}</button>
                                            @empty
                                            <code>no list level available at the moment</code>
                                            @endforelse
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

@section('script')
<script>
$('.button-level').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: "{{ route('student.start') }}",
        type: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            level_id: $(this).val()
        },
        success: function(data) {
            console.log(data);
            if (data.code == 0) {
                Swal.fire(
                    'Oops!',
                    'Something went wrong!.',
                    'error'
                )
            } else {
                window.location.href = '/s/' + data.stdlrn.id + '/content/' + data.stdlrn.level_id;
            }
        }
    });
});
</script>
@endsection