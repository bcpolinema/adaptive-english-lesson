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
  <link href="{{ asset('gentelella/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('gentelella/nprogress/nprogress.css') }}" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{ asset('gentelella//iCheck/skins/flat/green.css') }}" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="{{ asset('gentelella/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
  <!-- JQVMap -->
  <link href="{{ asset('gentelella/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="{{ asset('gentelella/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="/" class="site_title"><i class="fa fa-book"></i> <span>A E L</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="{{ asset('images/img.jpg') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              @auth
              <h2>{{Auth::user()->name}}</h2>
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
                <li><a href="{{ route('student.home') }}"><i class="fa fa-home"></i> Home </a>
                </li>
                <li><a href="/"><i class="fa fa-edit"></i> Exercises </span></a>
                </li>
                <li><a><i class="fa fa-user"></i> Student <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="/">Exercises</a></li>
                    <li><a href="/">Learnings</a></li>
                  </ul>
                </li>
                <li><a href="/"><i class="fa fa-table"></i> Subjects </a>
                </li>
                <li><a href="/"><i class="fa fa-book"></i> Topics </a>
                </li>
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
                  <img src="{{ asset('images/img.jpg') }}" alt="">
                  @auth
                  {{ Auth::user()->name }}
                  @endauth
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="javascript:;"> Profile</a></li>
                  <li>
                    <a href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                  </li>
                  <li><a href="javascript:;">Help</a></li>
                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log
                      Out</a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
          Adaptive English Lesson by <a href="https://colorlib.com">Politeknik Negeri Malang</a>
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

</body>

</html>