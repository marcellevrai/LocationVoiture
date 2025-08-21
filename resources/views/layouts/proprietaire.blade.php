<!DOCTYPE html>
<html lang="en">

<head>
    <title>GURU Able - Free Lite Admin Template </title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="CodedThemes">
      <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
      <meta name="author" content="CodedThemes">
      <!-- Favicon icon -->
<link rel="icon" href="{{ asset('template/guruable-master/assets/images/favicon.ico') }}" type="image/x-icon">

<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

<!-- Required Framework -->
<link rel="stylesheet" type="text/css" href="{{ asset('template/guruable-master/assets/css/bootstrap/css/bootstrap.min.css') }}">

<!-- Themify Icons -->
<link rel="stylesheet" type="text/css" href="{{ asset('template/guruable-master/assets/icon/themify-icons/themify-icons.css') }}">

<!-- Icofont -->
<link rel="stylesheet" type="text/css" href="{{ asset('template/guruable-master/assets/icon/icofont/css/icofont.css') }}">

<!-- Main Style -->
<link rel="stylesheet" type="text/css" href="{{ asset('template/guruable-master/assets/css/style.css') }}">

<!-- Custom Scrollbar -->
<link rel="stylesheet" type="text/css" href="{{ asset('template/guruable-master/assets/css/jquery.mCustomScrollbar.css') }}">

  </head>

  <body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">

                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="index.html">
                            <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-pink"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>     
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    @auth('proprietaire')
                                    <div class="rounded-circle bg-info text-white d-flex justify-content-center align-items-center me-2"
                                      style="width: 40px; height: 40px; font-size: 1.2rem;">
                                      {{ strtoupper(substr(auth('proprietaire')->user()->name, 0, 1)) }}
                                    </div>
                                   @endauth                                      
                                    <div class="user-details">
                                        <span>{{ Auth::guard('proprietaire')->user()->firstname }} {{ Auth::guard('proprietaire')->user()->name }}</span>
                                        <span id="more-details">{{ Auth::guard('proprietaire')->user()->email }}<i class="ti-angle-down"></i></span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                        <a href="{{ route('proprietaire.profil') }}">
                                            <i class="ti-user"></i> Profil
                                        </a>
                                    
                                        <form id="logout-form" action="{{ route('proprietaire.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icofont icofont-logout"></i> Déconnexion
                                        </a>
                                        </li>                                       
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Mon Espace</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="{{ request()->routeIs('proprietaire.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('proprietaire.dashboard')}}">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                        <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">Gestion</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="{{ request()->routeIs('proprietaire.voitures.create') ? 'active' : '' }}">
                                            <a href="{{route('proprietaire.voitures.create')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Ajouter une voiture</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="{{ request()->routeIs('proprietaire.voitures.index') ? 'active' : '' }}">
                                            <a href="{{route('proprietaire.voitures.index')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Listes des voitures</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>                                     
                                    </ul>
                                </li>
                            </ul>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="{{ request()->routeIs('proprietaire.reservations.index') ? 'active' : '' }}">
                                    <a href="{{route('proprietaire.reservations.index')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-book-alt bg-c-blue text-white me-3"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Les Reservations</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                                
                            </ul>

                            

                            
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        @yield('content')
                    </div>
                </div>
                
            </div>
        </div>

<!-- Warning Section Ends --><!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/js/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/js/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/js/popper.js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/js/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/js/modernizr/modernizr.js') }}"></script>

<!-- am chart -->
<script src="{{ asset('template/guruable-master/assets/pages/widget/amchart/amcharts.min.js') }}"></script>
<script src="{{ asset('template/guruable-master/assets/pages/widget/amchart/serial.min.js') }}"></script>

<!-- Todo js -->
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/pages/todo/todo.js') }}"></script>

<!-- Custom js -->
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/pages/dashboard/custom-dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/guruable-master/assets/js/SmoothScroll.js') }}"></script>
<script src="{{ asset('template/guruable-master/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('template/guruable-master/assets/js/demo-12.js') }}"></script>
<script src="{{ asset('template/guruable-master/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

<script>
var $window = $(window);
var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
         nav.addClass('active');
     }
     else {
         nav.removeClass('active');
     }
 });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
