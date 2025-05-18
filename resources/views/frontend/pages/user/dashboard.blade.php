@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || user dashboard</title>
    <meta name="description" content="">

    <meta property="og:title" content="user dashboard">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
   
@endpush

@section('dashboard', 'active')


@section('body-content')

    <!-- page-title -->
    <div class="page-title" style="background-image: url(
        @if( !empty(getSetting()->banner_breadcrumb_img) )
            {{ asset(getSetting()->banner_breadcrumb_img) }}
        @else
            {{ asset('public/frontend/images/section/page-title.jpg') }}
        @endif
        );">
        
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <h3 class="heading text-center">My Account</h3>
                    <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                        <li>
                            <a class="link" href="{{ route('home') }}">Homepage</a>
                        </li>
                        <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>
                            <a class="link" href="{{ route('product.page') }}">Shop</a>
                        </li>
                        <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>
                            My Account
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- my-account -->
    <section class="flat-spacing">
        <div class="container">
            <div class="my-account-wrap">

                @include('frontend.include.user_sidebar')

                <div class="my-account-content">
                    <div class="account-details">
                        <div class="account-info">
                            <h5 class="title">Dashboard</h5>
                            <div class="row">
                                <div class="col-xl-6 col-md-6 mb-3">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body" style="height: 110px;">
                                            <div class="analytics_card">
                                                 <div class="icon_design bg-primary">
                                                    <i class="bx bx-package"></i>
                                                 </div>
                        
                                                 <div class="cart_text">
                                                     <h6>Total Orders</h6>
                                                     <p>{{ $all_orders }}</p>
                                                 </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body" style="height: 110px;">
                                            <div class="analytics_card">
                                                 <div class="icon_design bg-info">
                                                    <i class="bx bx-chart"></i>
                                                 </div>
                        
                                                 <div class="cart_text">
                                                     <h6>Pending Orders</h6>
                                                     <p>{{ $pending_orders }}</p>
                                                 </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body" style="height: 110px;">
                                            <div class="analytics_card">
                                                 <div class="icon_design bg-info">
                                                    <i class="bx bx-trending-up"></i>
                                                 </div>
                        
                                                 <div class="cart_text">
                                                     <h6>Complete Orders</h6>
                                                     <p>{{ $complete_order }}</p>
                                                 </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body" style="height: 110px;">
                                            <div class="analytics_card">
                                                 <div class="icon_design bg-warning">
                                                    <i class='bx bx-cart'></i>
                                                 </div>
                        
                                                 <div class="cart_text">
                                                     <h6>Total Wishlist</h6>
                                                     <p>{{ $wishlists }}</p>
                                                 </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body" style="height: 110px;">
                                            <div class="analytics_card">
                                                 <div class="icon_design bg-success">
                                                    <i class="bx bx-money"></i>
                                                 </div>
                        
                                                 <div class="cart_text">
                                                     <h6>Total Spend</h6>
                                                     <p>{{ getSetting()->currency_symbol }}{{ $total_spend }}</p>
                                                 </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body" style="height: 110px;">
                                            <div class="analytics_card">
                                                 <div class="icon_design bg-warning">
                                                    <i class="bx bxs-star"></i>
                                                 </div>
                        
                                                 <div class="cart_text">
                                                     <h6>Total Review</h6>
                                                     <p>{{ $reviews }}</p>
                                                 </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>

                                <div class="col-xl-6 col-md-6 mb-3">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <a href="{{ route('user.dashboard.profile') }}" class="card-body" style="height: 110px;">
                                            <div class="analytics_card">
                                                 <div class="icon_design bg-dark">
                                                    <i class='bx bx-user'></i>
                                                 </div>
                        
                                                 <div class="cart_text">
                                                     <h6>Profiles</h6>
                                                     <p>--</p>
                                                 </div>
                                            </div>
                                        </a><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /my-account -->

@endsection

@push('add-js')

    @include('frontend.include.full_ajax_cart')

@endpush