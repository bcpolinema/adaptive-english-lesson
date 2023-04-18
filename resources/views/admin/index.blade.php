@extends('layout-admin')
@section('content')
<h1>Home Admin</h1>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <div class="img-container">
                    <img src="{{ asset('landing-page-v1/assets/images/login-logo.png') }}">
                </div>
                <br>
                <div class="img-container">
                    <img src="{{ asset('landing-page-v1/assets/images/logo-ael-new.png') }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection