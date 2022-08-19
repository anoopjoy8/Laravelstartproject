<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Start Project </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/css/developer.css">
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/feather/feather.css">
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{url('')}}/admin/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{url('')}}/admin/typicons/typicons.css">
    <link rel="stylesheet" href="{{url('')}}/admin/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="{{url('')}}/admin/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{url('')}}/admin/fontawesome-free-6.1.1-web/css/all.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{env('ASSET_URL')}}/admin/images/favicon.png" />
    @yield('header-script')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard')}}">
                        <h4 class="welcome-text main-title">{{Config::get('constants.PROJECT_NAME')}}</h4>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img src="{{env('ASSET_URL')}}/admin/images/logo-mini.svg" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <div class="col-md-8">
                    <ul class="navbar-nav">
                        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                            <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold capitalize">{{session()->get('start_project_adminuser')}}</span></h1>
                        </li>
                    </ul>
                </div>
                <!-- message sections starts here--->
                <div class="sticky-top" id="msg1">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-primary" role="alert">
                        <div class="col-md-12"><i class="fa-solid fa-check-double"></i></div>
                        <i class="fa-solid fa-xmark fa-xl cls_button" id="clmsg"></i>
                        <?= $message ?? "" ?>
                    </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <div class="col-md-12"><i class="fa-solid fa-circle-exclamation"></i></div>
                        <i class="fa-solid fa-xmark fa-xl cls_button" id="clmsg"></i>
                        <?= $message ?? "" ?>
                    </div>
                    @endif
                    @if(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <div class="col-md-12"><i class="fa-solid fa-circle-exclamation"></i></div>
                        <i class="fa-solid fa-xmark fa-xl cls_button" id="clmsg"></i>
                        @foreach($errors->all() as $error)
                        <?= $error ?? "" ?><br>
                        @endforeach
                    </div>
                    @endif
                </div>
                <!-- message sections ends here--->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{env('ASSET_URL')}}/admin/images/faces/face8.jpg" alt="Profile image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{env('ASSET_URL')}}/admin/images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{session()->get('start_project_adminuser')}}</p>
                            </div>
                            <a class="dropdown-item" href="{{url('admin/logout')}}"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger">
                    <i class="ti-settings"></i>
                </div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3">
                        </div>
                        Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3">
                        </div>
                        Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item {{$dash_status ?? "false"}}">
                        <a class="nav-link" href="{{ url('admin/dashboard')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Menu</li>
                    @php
                    $menu_data = App\Models\Menu::get_menu_list();
                    @endphp
                    @if(!empty($menu_data))
                    @foreach($menu_data as $key=>$val)
                    @php
                    $menu_status = getStatus(Request::segment(2),$val->active_url);
                    $sub_menu_results = App\Models\SubMenu::get_sub_list($val->id);
                    @endphp
                    @if(($val->url !="list-admin") || (($val->url == "list-admin") && (session()->get('start_project_admintype') == "admin")))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/'.$val->url) }}" data-bs-toggle="collapse" data-bs-target="#cl_{{$val->id}}" aria-expanded={{$menu_status['main_accrodian']}}>
                            <!-- <i class="menu-icon mdi mdi-floor-plan"></i> --->
                            <i class="fa-xl fa-solid fa-{{$val->icon}} ic"></i>
                            <span class="menu-title">{{$val->name}}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        @if(!empty($sub_menu_results))
                        @foreach($sub_menu_results as $key=>$val1)
                        <div id="cl_{{$val->id}}" class="collapse {{$menu_status['accordian_stat']}}" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/'.$val1->url) }}">{{$val1->name}}</a></li>
                            </ul>
                        </div>
                        @endforeach
                        @endif
                    </li>
                    @endif
                    @endforeach
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#menu1" aria-expanded="{{$accor_status ?? "false"}}" aria-controls="ui-basic">
                            <!-- <i class="menu-icon mdi mdi-floor-plan"></i> --->
                            <i class="fa-xl fa-solid fa-gears ic"></i>
                            <span class="menu-title">General Settings</span>
                            <i class="menu-arrow"></i>
                        </a>
                        @if(($val->url !="list-admin") || (($val->url == "list-admin") && (session()->get('start_project_admintype') == "admin")))
                        <div id="menu1" class="collapse {{$accor_show ?? ""}}" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/list-menu') }}">Manage Menu</a></li>
                            </ul>
                        </div>
                        @endif
                        <div id="menu1" class="collapse {{$accor_show ?? ""}}" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/change-password') }}">Manage Password</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper nopaddding">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Developed by Anoop Joy</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
    </div>
    </div>

    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{env('ASSET_URL')}}/admin/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{env('ASSET_URL')}}/admin/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{env('ASSET_URL')}}/admin/js/jquery.min.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/off-canvas.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/developer.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/hoverable-collapse.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/template.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/settings.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/todolist.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/fontawesome-free-6.1.1-web/js/all.js"></script>
    @yield('footer-script')
</body>

</html>