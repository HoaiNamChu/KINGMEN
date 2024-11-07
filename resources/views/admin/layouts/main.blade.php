<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.getappui.com/larkon/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 14:05:25 GMT -->
<head>
    <!-- Title Meta -->
    <meta charset="utf-8"/>
    <title>Dashboard | Larkon - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully responsive premium admin dashboard template"/>
    <meta name="author" content="Techzaa"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('theme/admin/assets/images/favicon.ico') }}">

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('theme/admin/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('theme/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
{{--    để thêm link của trang đó hoặc là thêm nếu cần--}}

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('theme/admin/assets/js/config.js') }}"></script>

    @yield('links')
    @yield('styles')
</head>

<body>

<!-- START Wrapper -->
<div class="wrapper">

    <!-- ========== Topbar Start ========== -->
    @include('admin.layouts.header')

    <!-- Activity Timeline -->
    @include('admin.layouts.activity-timeline')

    <!-- Right Sidebar (Theme Settings) -->
    @include('admin.layouts.right-sidebar')
    <!-- ========== Topbar End ========== -->

    <!-- ========== App Menu Start ========== -->
    @include('admin.layouts.main-nav')
    <!-- ========== App Menu End ========== -->

    <!-- ==================================================== -->
    <!-- Start right Content here -->
    <!-- ==================================================== -->
    <div class="page-content">

        <!-- Start Container Fluid -->
        @yield('content')
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        @include('admin.layouts.footer')
        <!-- ========== Footer End ========== -->

    </div>
    <!-- ==================================================== -->
    <!-- End Page Content -->
    <!-- ==================================================== -->

</div>
<!-- END Wrapper -->

<!-- Vendor Javascript (Require in all Page) -->
<script src="{{ asset('theme/admin/assets/js/vendor.js') }}"></script>

<!-- App Javascript (Require in all Page) -->
<script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>


{{--// js dành cho trang dó thôi--}}
@yield('lib-script')
{{--// js tự viết hoặc thêm (nếu có)--}}
@yield('script')

</body>


<!-- Mirrored from techzaa.getappui.com/larkon/admin/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 14:06:00 GMT -->
</html>
