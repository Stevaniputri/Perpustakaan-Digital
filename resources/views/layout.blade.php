<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Digital Library</title>

    <link rel="shortcut icon" type="image/x-icon" href={{asset("assets/img/favicon.jpg")}}>

    <link rel="stylesheet" href={{asset("assets/css/bootstrap.min.css")}}>
    <link rel="stylesheet" href={{asset("assets/plugins/select2/css/select2.min.css")}}>

    <link rel="stylesheet" href={{asset("assets/css/animate.css")}}>

    <link rel="stylesheet" href={{asset("assets/css/dataTables.bootstrap4.min.css")}}>

    <link rel="stylesheet" href={{asset("assets/plugins/fontawesome/css/fontawesome.min.css")}}>
    <link rel="stylesheet" href={{asset("assets/plugins/fontawesome/css/all.min.css")}}>

    <link rel="stylesheet" href={{asset("assets/css/style.css")}}>
</head>

<body>
    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <h2 style="font-weight: 600">DigiLibrary</h2>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="#">
                            <div class="searchinputs">
                                <input type="text" placeholder="Search Here ...">
                                <div class="search-addon">
                                    <span><img src={{asset("assets/img/icons/closes.svg")}} alt="img"></span>
                                </div>
                            </div>
                            <a class="btn" id="searchdiv"><img src={{asset("assets/img/icons/search.svg")}} alt="img"></a>
                        </form>
                    </div>
                </li>

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src={{asset("assets/img/profiles/avator1.jpg")}} alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src={{asset("assets/img/profiles/avator1.jpg")}} alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    @auth
                                    <h6>{{ Auth::user()->fullname }}</h6>
                                    <h5>{{ Auth::user()->role }}</h5>    
                                    @endauth
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i> My
                                Profile</a>
                            <a class="dropdown-item" href="generalsettings.html"><i class="me-2"
                                    data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="{{route('logout')}}"><img
                                    src={{asset("assets/img/icons/log-out.svg")}} class="me-2" alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>


            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="">My Profile</a>
                    <a class="dropdown-item" href="">Settings</a>
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </div>

        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'petugas')
                        <li class="active">
                            <a href="{{route('dashboard')}}"><img src={{asset("assets/img/icons/dashboard.svg")}} alt="img"><span> Dashboard</span></a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="fas fa-book" style="font-size: 20px; color: #212b36"></i>
                                <span>
                                    Book</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{route('booklist')}}">Book List</a></li>
                                <li><a href="{{route('category')}}">Book Category</a></li>
                            </ul>
                        </li> 
                        <li>
                            <a href="{{route('userlist')}}">
                                <i class="fas fa-user" style="font-size: 20px; color: #212b36"></i>
                                <span>User</span>
                            </a>
                        </li> 
                        <li>
                            <a href="{{route('borrowedAdmin')}}">
                                <i class="fa fa-book-open"></i>
                                <span>Borrowed Book</span>
                            </a>
                        </li>  
                        @else
                        <li class="active">
                            <a href="{{route('dashboarduser')}}"><img src={{asset("assets/img/icons/dashboard.svg")}} alt="img"><span> Dashboard</span></a>
                        </li>
                        <li>
                            <a href="{{ route('mycollection') }}">
                                <i class="fas fa-bookmark" style="font-size: 20px; color: #212b36"></i>
                                <span>My Collection</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('borrowedUser')}}">
                                <i class="fa fa-book-open"></i>
                                <span>Borrowed Book</span>
                            </a>
                        </li>
                        @endif                    
                        
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            @yield('content')
        </div>
    </div>
    <script src={{asset("assets/js/jquery-3.6.0.min.js")}}></script>

    <script src={{asset("assets/js/feather.min.js")}}></script>

    <script src={{asset("assets/js/jquery.slimscroll.min.js")}}></script>

    <script src={{asset("assets/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("assets/js/dataTables.bootstrap4.min.js")}}></script>

    <script src={{asset("assets/js/bootstrap.bundle.min.js")}}></script>

    <script src={{asset("assets/plugins/apexchart/apexcharts.min.js")}}></script>
    <script src={{asset("assets/plugins/apexchart/chart-data.js")}}></script>

    <script src={{asset("assets/plugins/select2/js/select2.min.js")}}></script>

    <script src={{asset("assets/plugins/fileupload/fileupload.min.js")}}></script>

    {{-- <script src={{asset("assets/plugins/sweetalert/sweetalert2.all.min.js")}}></script>
    <script src={{asset("assets/plugins/sweetalert/sweetalerts.min.js")}}></script> --}}

    <script src={{asset("assets/js/script.js")}}></script>
</body>
</html>