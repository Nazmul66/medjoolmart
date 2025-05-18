
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <title>
        {{ config('app.name') }} | @stack('title')
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->

    @if ( !empty(getSetting()->favicon) )
        <link rel="shortcut icon" href="{{ asset(getSetting()->favicon) }}">
    @else
        <link rel="shortcut icon" href="{{ asset('public/backend/assets/images/favicon.ico') }}">
    @endif

    <!-- plugin css -->
    <link href="{{ asset('public/backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('public/backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="{{ asset('public/backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- toaster css plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- App Css-->
    <link href="{{ asset('public/backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Style Css-->
    <link href="{{ asset('public/backend/assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Font Awesome CDN File -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    @stack('add-css')

    <!-- Style Css-->
    <link href="{{ asset('public/backend/assets/css/style.css') }}" />

    <style>
        .select2-container {
            display: block !important;
            width: 100% !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 37px;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-search--dropdown .select2-search__field {
            outline: none;
        }
    </style>
</head>
