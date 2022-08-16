<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Start Project </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/feather/feather.css">
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{url('')}}/admin/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{url('')}}/admin/typicons/typicons.css">
    <link rel="stylesheet" href="{{url('')}}/admin/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="{{url('')}}/admin/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/css/developer.css">
    <link rel="stylesheet" href="{{url('')}}/admin/fontawesome-free-6.1.1-web/css/all.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{env('ASSET_URL')}}/admin/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{env('ASSET_URL')}}/admin/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{env('ASSET_URL')}}/admin/images/logo.svg" alt="logo">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="fw-light">Sign in to continue.</h6>

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
                            </div>
                            <!-- message sections ends here--->

                            <form action="{{url('admin/login')}}" method="post" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" value="{{$username}}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" value="{{$password}}" autocomplete="off">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="log_button">
                                        <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a>
                                    </button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="remember" class="form-check-input" @php if($rem=='on' ) { echo 'checked="checked"' ; } @endphp>
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                                </div>
                                <!-- <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                        <i class="ti-facebook me-2"></i>Connect using facebook
                    </button>
                    </div> -->
                                <!-- <div class="text-center mt-4 fw-light">
                    Don't have an account? <a href="register.html" class="text-primary">Create</a>
                    </div> -->
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
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
    <script src="{{env('ASSET_URL')}}/admin/js/off-canvas.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/hoverable-collapse.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/template.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/settings.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/todolist.js"></script>
    <script src="{{env('ASSET_URL')}}/admin/js/developer.js"></script>
    <!-- endinject -->
</body>

</html>