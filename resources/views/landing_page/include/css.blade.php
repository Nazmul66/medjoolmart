    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <title>
          @stack('meta-title') | {{ config('app.name') }} 
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- toaster css plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Font Awesome CDN File -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('public/landing_page/style.css') }}">

@stack('add-css')

{!! getSetting()->facebook_pixel ?? "" !!}

