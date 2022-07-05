@extends('layout-master')
@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-success alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span>
            </button>
            <strong>Selamat Datang</strong> di website pembelajaran Bahasa Inggris Polinema!
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel" style="height: auto;">
            <div class="x_title">
                <h2>Pembelajaran Listening 1</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display: none;">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                      Cras justo odio
                    </a>
                    <a href="#" class="list-group-item">Dapibus ac facilisis in <span class="badge bg-green"> <i><i class="fa fa-play"></i></i> </span></a>
                    <a href="#" class="list-group-item">Morbi leo risus</a>
                    <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                    <a href="#" class="list-group-item">Vestibulum at eros</a>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection