
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="images/favicon.png">
    
    @stack('add-meta')

    <!-- Box-Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('public/user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/jquery.calendar.css') }}">

    <!-- toaster css plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('public/user/css/add_row_custon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/mobile_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/multiple-image-video.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/ranger_style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/jquery.classycountdown.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/venobox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('public/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/responsive.css') }}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->

    @stack('add-css')
</head>