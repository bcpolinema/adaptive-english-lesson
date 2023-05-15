<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Adaptive English Lesson | Politeknik Negeri Malang</title>

    <base href="{{ \URL::to('/') }} ">
    <!-- Bootstrap -->
    <link href="{{ asset('gentelella/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- NProgress -->
    <link href="{{ asset('gentelella/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('gentelella//iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('gentelella/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('gentelella/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('gentelella/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">

    <!-- Graph CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('arg-graph-1.1/arg-graph.min.css') }}" />
</head>

<style>
div.polaroid {
    width: 80%;
    background-color: white;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    margin: auto auto;
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

h3,
button,
#newItem,
#output {
    margin: 20px 20px 5px 20px;
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
    max-width: 500rem;
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
    max-width: 500rem;
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

<body class="nav-md">

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="/" class="site_title"><i class="fas fa-book"></i><span
                                style="font-size:14px;">&nbsp;&nbsp;Adaptive
                                English Learning</span>
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
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
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="{{ route('student.home') }}"><i
                                            class="fas fa-home"></i>&nbsp;&nbsp;Dashboard
                                    </a>
                                </li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i
                                            class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Log
                                        Out </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <!-- <li><a><i class="fa fa-user"></i> Student <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/">Exercises</a></li>
                                        <li><a href="/">Learnings</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="{{ asset('images/user.png') }}" alt="">
                                    @auth
                                    {{ Auth::user()->name }}
                                    @endauth
                                    &nbsp;
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <!-- <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li> -->
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log
                                            Out</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </li>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer class="footer_fixed">
                <div class="pull-right">
                    Adaptive English Lesson by <a href="https://www.polinema.ac.id/" target="_blank">Politeknik Negeri
                        Malang</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('gentelella/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('gentelella/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('gentelella/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('gentelella/nprogress/nprogress.js') }}"></script>
    <!-- Chart -->
    <script src="{{ asset('gentelella/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge -->
    <script src="{{ asset('gentelella/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('gentelella/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('gentelella/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('gentelella/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('gentelella/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('gentelella/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('gentelella/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('gentelella/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('gentelella/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('gentelella/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('gentelella/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('gentelella/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('gentelella/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('gentelella/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('gentelella/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('gentelella/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('gentelella/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('gentelella/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('build/js/custom.min.js') }}"></script>


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