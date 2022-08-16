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
  @yield('content')
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
  <!-- endinject -->
  @yield('footer-script')
</body>

</html>