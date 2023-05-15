<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, AdminWrap lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Elegant admin lite design, Elegant admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Elegant Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Adaptive English Lesson | Politeknik Negeri Malang</title>
    <link rel="canonical" href="/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{ asset('admin/assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
    <!--c3 plugins CSS -->
    <link href="{{ asset('admin/assets/node_modules/c3-master/c3.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('admin/html/dist/css/style.css') }}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('admin/html/dist/css/pages/dashboard1.css') }}" rel="stylesheet">
    <!-- Graph CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('arg-graph-1.1/arg-graph.min.css') }}" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<style>
.thumbnail .image {
    height: 300px;
    overflow: hidden;
    border-radius: 2%;
}

.caption {
    padding: 9px 5px;
    background: #F7F7F7;
    border-radius: 2%;
    margin-bottom: 10px;
}

.caption p {
    margin-bottom: 5px;
}

.thumbnail {
    height: auto;
    overflow: hidden
}

.view {
    overflow: hidden;
    position: relative;
    text-align: center;
    box-shadow: 1px 1px 2px #e6e6e6;
    cursor: default
}

.view .mask,
.view .content {
    position: absolute;
    width: 100%;
    overflow: hidden;
    top: 0;
    left: 0
}

.view img {
    display: block;
    position: relative
}

.view .tools {
    text-transform: uppercase;
    color: #fff;
    text-align: center;
    position: relative;
    font-size: 17px;
    padding: 3px;
    background: rgba(0, 0, 0, 0.35);
    margin: 220px 0 0 0
}

.mask.no-caption .tools {
    margin: auto
}

.view .tools a {
    display: inline-block;
    color: #FFF;
    font-size: 18px;
    font-weight: 400;
    padding: 0 4px
}

.view p {
    font-family: Georgia, serif;
    font-style: italic;
    font-size: 12px;
    position: relative;
    color: #fff;
    padding: 10px 20px 20px;
    text-align: center
}

.view a.info {
    display: inline-block;
    text-decoration: none;
    padding: 7px 14px;
    background: #000;
    color: #fff;
    text-transform: uppercase;
    box-shadow: 0 0 1px #000
}

.view-first img {
    transition: all 0.2s linear
}

.view-first .mask {
    opacity: 0;
    background-color: rgba(0, 0, 0, 0.5);
    transition: all 0.4s ease-in-out
}

.view-first .tools {
    transform: translateY(-100px);
    opacity: 0;
    transition: all 0.2s ease-in-out
}

.view-first p {
    transform: translateY(100px);
    opacity: 0;
    transition: all 0.2s linear
}

.view-first:hover img {
    transform: scale(1.1)
}

.view-first:hover .mask {
    opacity: 1
}

.view-first:hover .tools,
.view-first:hover p {
    opacity: 1;
    transform: translateY(0px)
}

.view-first:hover p {
    transition-delay: 0.1s
}

.profile_pic {
    width: 35%;
    float: left
}

.img-circle.profile_img {
    width: 70%;
    background: #fff;
    margin-left: 15%;
    z-index: 1000;
    position: inherit;
    margin-top: 20px;
    border: 1px solid rgba(52, 73, 94, 0.44);
    padding: 4px
}

.profile_info {
    padding: 25px 10px 10px;
    width: 65%;
    float: left
}

.profile_info span {
    font-size: 13px;
    line-height: 30px;
    color: #BAB8B8
}

.profile_info h2 {
    font-size: 14px;
    color: #ECF0F1;
    margin: 0;
    font-weight: 300
}

.profile.img_2 {
    text-align: center
}

.profile.img_2 .profile_pic {
    width: 100%
}

.profile.img_2 .profile_pic .img-circle.profile_img {
    width: 50%;
    margin: 10px 0 0
}

.profile.img_2 .profile_info {
    padding: 15px 10px 0;
    width: 100%;
    margin-bottom: 10px;
    float: left
}

.button-topic {
    appearance: none;
    backface-visibility: hidden;
    background-color: #025773;
    border-radius: 10px;
    border-style: none;
    box-shadow: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: Inter, -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif;
    font-size: 15px;
    font-weight: 500;
    height: 42px;
    line-height: 1;
    outline: none;
    overflow: hidden;
    padding: 14px 30px;
    position: relative;
    text-align: center;
    text-decoration: none;
    transform: translate3d(0, 0, 0);
    transition: all .3s;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: top;
    white-space: nowrap;
    margin-left: 40%;
}

.button-topic:hover {
    background-color: #1366d6;
    box-shadow: rgba(0, 0, 0, .05) 0 5px 30px, rgba(0, 0, 0, .05) 0 1px 4px;
    opacity: 1;
    transform: translateY(0);
    transition-duration: .35s;
}

.button-topic:hover:after {
    opacity: .5;
}

.button-topic:active {
    box-shadow: rgba(0, 0, 0, .1) 0 3px 6px 0, rgba(0, 0, 0, .1) 0 0 10px 0, rgba(0, 0, 0, .1) 0 1px 4px -1px;
    transform: translateY(2px);
    transition-duration: .35s;
}

.button-topic:active:after {
    opacity: 1;
}

@media (min-width: 768px) {
    .button-topic {
        padding: 14px 22px;
        width: 176px;
    }
}

.button-level {
    appearance: none;
    backface-visibility: hidden;
    background-color: #002F47;
    border-radius: 10px;
    border-style: none;
    box-shadow: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: Inter, -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif;
    font-size: 15px;
    font-weight: 500;
    height: 50px;
    letter-spacing: normal;
    line-height: 1.5;
    outline: none;
    overflow: hidden;
    padding: 14px 30px;
    position: relative;
    text-align: center;
    text-decoration: none;
    transform: translate3d(0, 0, 0);
    transition: all .3s;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: top;
    white-space: nowrap;
    margin-left: 40%;
    margin-bottom: 3%;
}

.button-level:hover {
    background-color: #1366d6;
    box-shadow: rgba(0, 0, 0, .05) 0 5px 30px, rgba(0, 0, 0, .05) 0 1px 4px;
    opacity: 1;
    transform: translateY(0);
    transition-duration: .35s;
}

.button-level:hover:after {
    opacity: .5;
}

.button-level:active {
    box-shadow: rgba(0, 0, 0, .1) 0 3px 6px 0, rgba(0, 0, 0, .1) 0 0 10px 0, rgba(0, 0, 0, .1) 0 1px 4px -1px;
    transform: translateY(2px);
    transition-duration: .35s;
}

.button-level:active:after {
    opacity: 1;
}

.button-level:disabled,
.button-level[disabled] {
    border: 1px solid #999999;
    background-color: #cccccc;
    color: #666666;
}

@media (min-width: 768px) {
    .button-level {
        padding: 14px 22px;
        width: 176px;
    }
}


.container {
    height: 100px;
}


.start {
    margin: auto auto;
    color: white;
}

#output {
    white-space: pre;
    font-family: monospace;
}

.arg-Graph_item {
    text-align: center;
    text-transform: uppercase;
    background-image: none;
    padding: 4px 10px;
    border-radius: 3px;
    border: 1px solid transparent;
    color: white;
    border-color: transparent;
    background: #26c6da;
}

ol.list-topic {
    list-style: none;
    counter-reset: list;
    padding: 0 1rem;
}

p.list-topic {
    margin: 0;
    line-height: 1.6;
}

h3.list-topic {
    display: flex;
    align-items: baseline;
    margin: 0 0 1rem;
    color: rgb(70 70 70);
}

h3.list-topic::before {
    display: flex;
    justify-content: center;
    align-items: center;
    flex: 0 0 auto;
    margin-right: 1rem;
    width: 3rem;
    height: 3rem;
    content: counter(list);
    padding: 1rem;
    border-radius: 50%;
    background-color: #025773;
    color: white;
}

li.list-topic {
    --stop: calc(100% / var(--length) * var(--i));
    --l: 62%;
    --l2: 88%;
    --h: calc((var(--i) - 1) * (180 / var(--length)));
    --c1: hsl(var(--h), 71%, var(--l));
    --c2: hsl(var(--h), 71%, var(--l2));

    position: relative;
    counter-increment: list;
    max-width: 50rem;
    margin: 2rem auto;
    padding: 2rem 1rem 1rem;
    box-shadow: 0.1rem 0.1rem 1.5rem rgba(0, 0, 0, 0.3);
    border-radius: 1.5rem;
    overflow: hidden;
    background-color: white;
}

li.list-topic::before {
    content: '';
    display: block;
    width: 100%;
    height: 1rem;
    position: absolute;
    top: 0;
    left: 0;
    background: linear-gradient(to left, #025773, #2c3e50);
}

@media (min-width: 40em) {
    li.list-topic {
        margin: 3rem auto;
        padding: 3rem 2rem 2rem;
    }
}


h3.list-question {
    display: flex;
    align-items: baseline;
    margin: 0 0 1rem;
    color: black;
}

h3.list-question::before {
    display: flex;
    justify-content: center;
    align-items: center;
    flex: 0 0 auto;
    margin-right: 1rem;
}

ol.list-question {
    list-style: none;
    counter-reset: list;
    padding: 0 1rem;
}

p.list-question {
    margin: 0;
    line-height: 1.6;
}

li.list-question {
    --stop: calc(100% / var(--length) * var(--i));
    --l: 62%;
    --l2: 88%;
    --h: calc((var(--i) - 1) * (180 / var(--length)));
    --c1: hsl(var(--h), 71%, var(--l));
    --c2: hsl(var(--h), 71%, var(--l2));

    position: relative;
    counter-increment: list;
    max-width: 900rem;
    margin: 2rem auto;
    padding: 2rem 1rem 1rem;
    box-shadow: 0.1rem 0.1rem 1.5rem rgba(0, 0, 0, 0.3);
    border-radius: 1rem;
    overflow: hidden;
    background-color: white;
}

li.list-question::before {
    content: '';
    display: block;
    width: 100%;
    height: 1rem;
    position: absolute;
    top: 0;
    left: 0;
    background: linear-gradient(to left, white, #2c3e50);
}

@media (min-width: 40em) {
    li.list-question {
        margin: 3rem auto;
        padding: 3rem 2rem 2rem;
    }
}
</style>

<body class="skin-default-dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure">
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('landing-page-v1/assets/images/logo-ael-new.png') }}" alt="homepage"
                                class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{ asset('landing-page-v1/assets/images/logo-ael-new.png') }}" alt="homepage"
                                class="light-logo" />
                        </b>

                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light"
                                href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                                href="javascript:void(0)"><i class="fa fa-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a
                                    class="srh-btn"><i class="fa fa-times"></i></a>
                            </form>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="{{ asset('images/user.png') }}" alt="user" class="img-circle" width="30"></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{ asset('images/user.png') }}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        @auth
                        <h2> {{Auth::user()->name}} </h2>
                        @endauth
                    </div>
                </div>
                <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i
                        class="ti-menu"></i></a>
                <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
            </div>
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- <li>
                            <a class="waves-effect waves-dark" href="{{ route('student.home') }}"
                                aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">
                                    <div class="profile clearfix">
                                        <div class="profile_pic">
                                            <img src="{{ asset('images/user.png') }}" alt="..."
                                                class="img-circle profile_img">
                                        </div>
                                        <div class="profile_info">
                                            <span>Welcome,</span>
                                            @auth
                                            <h2> {{Auth::user()->name}} </h2>
                                            @endauth
                                        </div>
                                    </div>
                                </span></a>

                        </li>
                        <br> -->
                        <li> <a class="waves-effect waves-dark" href="{{ route('student.home') }}"
                                aria-expanded="false"><i class="fa fa-home"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i
                                    class="fa fa-user"></i><span class="hide-menu">Profile</span></a></li>
                        <div class="text-center m-t-30">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                                class="btn waves-effect waves-light btn-success hidden-md-down"><i
                                    class="fa fa-sign-out"></i> Log Out </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Yearly Sales -->
                <!-- ============================================================== -->
                <div class="right_col" role="main">
                    <br>
                    @yield('content')
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                <div class="pull-right">
                    Adaptive English Learning by <a href="https://www.polinema.ac.id/" target="_blank">Politeknik Negeri
                        Malang</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="{{ asset('admin/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="{{ asset('admin/assets/node_modules/popper/popper.min.js') }}"></script>
        <script src="{{ asset('admin/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="{{ asset('admin/html/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
        <!--Wave Effects -->
        <script src="{{ asset('admin/html/dist/js/waves.js') }}"></script>
        <!--Menu sidebar -->
        <script src="{{ asset('admin/html/dist/js/sidebarmenu.js') }}"></script>
        <!--Custom JavaScript -->
        <script src="{{ asset('admin/html/dist/js/custom.min.js') }}"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->
        <!--morris JavaScript -->
        <script src="{{ asset('admin/assets/node_modules/raphael/raphael-min.js') }}"></script>
        <script src="{{ asset('admin/assets/node_modules/morrisjs/morris.min.js') }}"></script>
        <script src="{{ asset('admin/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <!--c3 JavaScript -->
        <script src="{{ asset('admin/assets/node_modules/d3/d3.min.js') }}"></script>
        <script src="{{ asset('admin/assets/node_modules/c3-master/c3.min.js') }}"></script>
        <!-- Chart JS -->
        <script src="{{ asset('admin/html/dist/js/dashboard1.js') }}"></script>

        <!-- Graph -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
        </script>
        <script src="{{ asset('arg-graph-1.1/arg-graph.min.js') }}" type="text/javascript"></script>

        <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @include('sweetalert::alert')

        @yield('script')
</body>

</html>