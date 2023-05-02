@extends('layout-student')
@section('content')
<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><strong>( {{ $subjectName }} ) {{ $topicName }} - Level List</strong></h2>
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
                                            <div class="container">
                                                <h2><strong>Specific Graph Progress</strong></h2>
                                                <div class="arg-Graph">
                                                    <div id="item1" class="arg-Graph_item"
                                                        style="left: 135px; top: 18px" data-neighbors="item2,item3">
                                                        Level 1
                                                        <span class="arg-Graph_connector-handler"></span>
                                                        <span class="arg-Graph_delete-item"></span>
                                                    </div>
                                                    <div id="item2" class="arg-Graph_item"
                                                        style="left: 270.0px; top: 18px" data-neighbors="item4">
                                                        Level 2
                                                        <span class="arg-Graph_connector-handler"></span>
                                                        <span class="arg-Graph_delete-item"></span>
                                                    </div>
                                                    <div id="item3" class="arg-Graph_item"
                                                        style="left: 405.0px; top: 18px" data-neighbors="item4">
                                                        Level 3
                                                        <span class="arg-Graph_connector-handler"></span>
                                                        <span class="arg-Graph_delete-item"></span>
                                                    </div>
                                                    <div id="item4" class="arg-Graph_item"
                                                        style="left: 540.0px; top: 18px" data-neighbors="item5">
                                                        Level 4
                                                        <span class="arg-Graph_connector-handler"></span>
                                                        <span class="arg-Graph_delete-item"></span>
                                                    </div>
                                                    <div id="item5" class="arg-Graph_item"
                                                        style="left: 675.0px; top: 18px">
                                                        Level 5
                                                        <span class="arg-Graph_connector-handler"></span>
                                                        <span class="arg-Graph_delete-item"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <ol class="list-topic" style="--length: 5" role="list">
                                                @foreach($level_list as $levelst)
                                                <li class="list-topic" style="--i: 5">
                                                    <!-- Score -->
                                                    <h3 class="list-topic">Score
                                                        {{ ( $levelst->stdlearningStudent->isEmpty() || $levelst->stdlearningStudent[0]->score == null ) ? '0': $levelst->stdlearningStudent[0]->score }}/100
                                                    </h3>
                                                    <!-- End Score -->
                                                    <p class="list-topic">Lorem ipsum dolor sit amet, consectetur
                                                        adipiscing elit, sed
                                                        do eiusmod tempor incididunt ut labore et dolore magna
                                                        aliqua. Adipiscing diam donec adipiscing tristique risus.
                                                    </p>
                                                    <!-- Level Action -->
                                                    @if($current_level != null)
                                                    <button class="button-level" id="{{ $levelst->id }}" type="button"
                                                        value="{{ $levelst->id }}" {{ 
                                                    ( 
                                                        ($current_level->level_id == $levelst->id || $current_level->next_learning == $levelst->id) 
                                                        || 
                                                        $levelst->title == 1 
                                                    )  ? '' : 'disabled' 
                                                    }}> {{ $levelst->title }}</button>
                                                    @else
                                                    <button class="button-level" id="{{ $levelst->id }}" type="button"
                                                        value="{{ $levelst->id }}" {{ 
                                                    ( 
                                                        $levelst->title == 1 
                                                    )  ? '' : 'disabled' }}>
                                                        {{ $levelst->title }}</button>
                                                    @endif
                                                    <!-- End Level Action -->
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

@section('script')
<script>
var argGraph;
$(function() {
    argGraph = $(".arg-Graph").ArgGraph({
        onGraphChange: function() {
            var json = argGraph.exportJson();
            $("#output").html(document.createTextNode(json));
        },
    });

    // $("#import").on("click", function () {
    //   var json = $("#input").html();
    //   argGraph.importJson(json);
    // });

    // var json = argGraph.exportJson();
    // $("#output").html(document.createTextNode(json));
});
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