<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('theme/images/ico/apple-icon-120.png') }}') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/jkanban/jkanban.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/editors/quill/katex.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('theme/vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendors/css/editors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('theme/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('theme/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/form-quill-editor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/pages/app-kanban.css') }}">

    <link href="{{ asset('theme/summernote/summernote.css') }}" rel="stylesheet">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('theme/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
    <style>
        body, tr, .form-control, .form-select{
            color: black;
        }

    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
@include('user.layouts.header')
<!-- END: Header-->

<!-- BEGIN: Main Menu-->
@include('user.layouts.navbar')
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content kanban-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        {{ $slot }}
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
@include('user.layouts.footer')
<!-- END: Footer-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('theme/summernote/js/summernote.min.js') }}"></script>
<script src="{{ asset('theme/summernote/summernote-init.js') }}"></script>
<script src="{{ asset('theme/vendors/js/extensions/moment.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/jkanban/jkanban.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/editors/quill/katex.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/editors/quill/highlight.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/editors/quill/quill.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('theme/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('theme/js/core/app-menu.js') }}"></script>
<script src="{{ asset('theme/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->

<!-- END: Page JS-->
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    let token = '{{csrf_token()}}';
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
    $(document).ready(function () {
        var interval = setInterval(function () {
            var momentNow = moment();
            $('#now_time').html(momentNow.format('hh:mm:ss YYYY年MM月DD日'));
        }, 100);
    });
</script>
</body>
<!-- END: Body-->
</html>
