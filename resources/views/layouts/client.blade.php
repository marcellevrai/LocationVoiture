
<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    
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
                                    @if(auth('client')->check())
                                        <span class="badge bg-c-pink">
                                            {{ auth('client')->user()->unreadNotifications->count() }}
                                        </span>
                                    @endif

                                    
                                </a>
                                <ul class="show-notification">
                                    
                                    @if(auth('client')->check())
                                        <ul class="show-notification">
                                            <li>
                                                <h6>Notifications</h6>
                                                <label class="label label-danger">New</label>
                                            </li>
                                            @forelse(auth('client')->user()->unreadNotifications as $notification)
                                                <li>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <p class="notification-msg">{{ $notification->data['message'] }}</p>
                                                            <span class="notification-time text-muted small">
                                                                Expire le {{ \Carbon\Carbon::parse($notification->data['date_expiration'])->format('d/m/Y H:i') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <li><span class="text-muted">Aucune notification.</span></li>
                                            @endforelse
                                        </ul>
                                    @endif


                                        
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
                                            @if (Auth::guard('client')->check())
                                            <div class="main-menu-header">                                                                  
                                                @auth('client')
                                                 <div class="rounded-circle bg-info text-white d-flex justify-content-center align-items-center me-2"
                                                   style="width: 40px; height: 40px; font-size: 1.2rem;">
                                                   {{ strtoupper(substr(auth('client')->user()->name, 0, 1)) }}
                                                 </div>
                                                @endauth                                               
                                                <div class="user-details">                                                    
                                                    <span>{{ Auth::guard('client')->user()->firstname }} {{ Auth::guard('client')->user()->name }}</span>
                                                    <span id="more-details">{{ auth('client')->user()->email }}<i class="ti-angle-down"></i></span>                                  
                                                </div>
                                            </div>            
                                            <div class="main-menu-content">
                                                <ul>
                                                    <li class="more-details">
                                                    <a href="{{ route('client.profil')}}">
                                                        <i class="ti-user"></i> Profil
                                                    </a>                                                
                                                    <form id="logout-form" action="{{ route('client.logout')}}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>                                              
                                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <i class="icofont icofont-logout"></i> Déconnexion
                                                    </a>                                                
                                                    </li>                                       
                                                </ul>
                                            </div>
                                            @endif
                                        </div>
                            
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Mon Espace</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="{{ request()->routeIs('voitures.public.index') ? 'active' : '' }}">
                                    <a href="{{route('voitures.public.index')}}">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">voitures Disponible</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                
                            </ul>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="{{ request()->routeIs('reservation.index') ? 'active' : '' }}">
                                    <a href="{{route('reservation.index')}}">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Mes reservation</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                
                                
                            </ul>
                            <ul class="pcoded-item pcoded-left-item">
                                @if(!Auth::guard('client')->check())
                                    <li>
                                        <a href="{{ route('client.login') }}">
                                            <span class="pcoded-micon"><i class="ti-lock"></i></span>
                                            <span class="pcoded-mtext">Se connecter</span>
                                        </a>
                                    </li>
                                @endif
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
<script>
    setTimeout(() => {
        const flash = document.getElementById('flash-message');
        if (flash) {
            flash.style.transition = 'opacity 0.5s ease-out';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }
    }, 4000); // 4000 = 4 secondes
</script>
 
<script>
    // date reservation
    document.getElementById('form-reservation').addEventListener('submit', function (e) {
        const today = new Date().toISOString().split('T')[0];
        const debut = document.querySelector('input[name="date_debut"]').value;
        const fin = document.querySelector('input[name="date_fin"]').value;

        if (debut < today) {
            e.preventDefault();
            alert("La date de début ne peut pas être antérieure à aujourd'hui.");
            return;
        }

        if (fin < debut) {
            e.preventDefault();
            alert("La date de fin ne peut pas être antérieure à la date de début.");
            return;
        }
    });
</script>

</body>

</html>
