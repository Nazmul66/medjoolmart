
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

@stack('add-meta')

<!-- Favicon and Touch Icons  -->
<link rel="icon" type="image/png" href="{{ asset('public/frontend/images/logo/favicon.png') }}">
<link rel="shortcut icon" href="{{ asset('public/frontend/images/logo/favicon.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('public/frontend/images/logo/favicon.png') }}">

<meta name="author" content="">

<!-- font -->
<link rel="stylesheet" href="{{ asset('public/frontend/fonts/fonts.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/fonts/font-icons.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/css/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/css/animate.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link rel="stylesheet" href="https://sibforms.com/forms/end-form/build/sib-styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/styles.css') }}" />

<!--Toaster Notification Css-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

@stack('add-css')

{!! getSetting()->facebook_pixel ?? "" !!}

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>