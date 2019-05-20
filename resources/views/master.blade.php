<?php
if (!isset($_SESSION['userinfo2']))
        {
            return redirect('/login2');
        }
else {
  $userinfo = $_SESSION['userinfo2'];
  $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/plugins/images/favicon.png')}}">
    <title>@yield('title')</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{url('assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/plugins/bower_components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="{{url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{url('assets/css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">
     <!-- Form -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
         page. However, you can choose any other skin from folder css / colors .
    -->
    <link href="{{url('assets/css/colors/blue.css')}}" id="theme" rel="stylesheet"> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .styled-select {
         height: 29px;
         overflow: hidden;
         width: 240px;
        }
        .semi-square {
         -webkit-border-radius: 5px;
         -moz-border-radius: 5px;
         border-radius: 5px;
        }

        input[type="text"]:disabled{background-color:white;}
        textarea[class="form-control"]:disabled{background-color:white;}
    </style>
    @yield('add-css')
</head>

<body class="fix-header">
<!-- Preloader -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>

<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <!-- Logo -->
                <a class="logo" href="index.html">
                    <!-- Logo icon image, you can use font-icon also --><b>
                    <!--This is dark logo icon--><img src="{{url('assets/plugins/images/admin-logo.png')}}" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="{{url('assets/plugins/images/admin-logo-dark.png')}}" alt="home" class="light-logo" />
                 </b>
                    <!-- Logo text image you can use text also --><span class="hidden-xs">
                    <!--This is dark logo text--><img src="{{url('assets/plugins/images/admin-text.png')}}" alt="home" class="dark-logo" /><!--This is light logo text--><img src="{{url('assets/plugins/images/admin-text-dark.png')}}" alt="home" class="light-logo" />
                 </span> </a>
            </div>
            <!-- /Logo -->
            <!-- /Search Bar -->
            <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
                    <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                        <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{url('assets/plugins/images/users/varun.jpg')}}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php echo $username; ?></b><span class="caret"></span> </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <div class="dw-user-box">
                                <div class="u-img">{{-- <img src="../plugins/images/users/varun.jpg" alt="user" /> --}}</div>
                                <div class="u-text"><h4><?php echo $username; ?></h4><p class="text-muted"></p></div>
                            </div>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout2') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                
                <!-- /.dropdown -->
            </ul>
        </div>
    </nav>

<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> 
        </div>
        <ul class="nav" id="side-menu">
        @if ($_SESSION['userinfo2'] == "azkayasin2@gmail.com")
            <li><a href="{{ url('dokumen') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Standar Biaya Institut</span></a> </li>
            <li><a href="{{ url('versisbi') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Versi SBI</span></a> </li>
            <li><a href="{{ url('datapegawai') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Data Pegawai</span></a> </li>
            <li><a href="{{ url('buatkda') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Buat KDA</span></a> </li>
            <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">KDA<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('kda') }}"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">KDA Semua</span></a></li>
                    <li><a href="{{ url('kdasendiri') }}"><i class="fa-fw">S</i><span class="hide-menu">KDA Sendiri</span></a></li>
                </ul>
            </li>
            <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Temuan KDA<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('temuankda') }}"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Temuan Semua</span></a></li>
                    <li><a href="{{ url('temuankdasendiri') }}"><i class="fa-fw">S</i><span class="hide-menu">Temuan Sendiri</span></a></li>
                </ul>
            </li>
            <li><a href="{{ url('templatekda') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Template KDA</span></a> </li>
            <li><a href="{{ url('kdatriwulan') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Laporan KDA</span></a> </li>
        @elseif ($_SESSION['userinfo2'] == "nenylukitasari@gmail.com")
            <li><a href="{{ url('dokumen') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Standar Biaya Institut</span></a> </li>
            <li><a href="{{ url('versisbi') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Versi SBI</span></a> </li>
            <li><a href="{{ url('datapegawai') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Data Pegawai</span></a> </li>
            <li><a href="{{ url('buatkda') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Buat KDA</span></a> </li>
            <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">KDA<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('kda') }}"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">KDA Semua</span></a></li>
                    <li><a href="{{ url('kdasendiri') }}"><i class="fa-fw">S</i><span class="hide-menu">KDA Sendiri</span></a></li>
                </ul>
            </li>
            <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Temuan KDA<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('temuankda') }}"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Temuan Semua</span></a></li>
                    <li><a href="{{ url('temuankdasendiri') }}"><i class="fa-fw">S</i><span class="hide-menu">Temuan Sendiri</span></a></li>
                </ul>
            </li>
            <li><a href="{{ url('templatekda') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Template KDA</span></a> </li>
            <li><a href="{{ url('kdatriwulan') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Laporan KDA</span></a> </li>
        @else
            <li><a href="{{ url('dokumen') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Standar Biaya Institut</span></a> </li>
            <li><a href="{{ url('datapegawai') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Data Pegawai</span></a> </li>
            <li><a href="{{ url('buatkda') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Buat KDA</span></a> </li>
            <li><a href="{{ url('kdasendiri') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">KDA</span></a> </li>
            <li><a href="{{ url('temuankdasendiri') }}" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i><span class="hide-menu">Temuan</span></a> </li>
        @endif
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <!-- .page title -->
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">@yield('title')</h4> </div>
            <!-- /.page title -->
            <!-- .breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    @yield('right_title')
                </ol>
            </div>
            <!-- /.breadcrumb -->
        </div>
        <!-- .row -->
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- .row -->
    </div>
    <!-- /.container-fluid -->
@yield('footer')
{{-- <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer> --}}
</div>
<!-- /#page-wrapper -->
</div>
<!-- jQuery -->
    <script src="{{url('assets/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{url('assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{url('assets/js/waves.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{url('assets/js/custom.min.js')}}"></script>
    <script src="{{url('assets/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>
    <!--Style Switcher -->
    <script src="{{url('assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <!-- form -->
    <script src="{{url('assets/bower_components/select2/dist/js/select2.full.min.js')}}"></script>        
    @yield('add-script')
</body>

</html>