@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || view order dashboard</title>
    <meta name="description" content="">

    <meta property="og:title" content="view order dashboard">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush


@push('add-css')
   
@endpush

@section('dashboard_orders', 'active')

@php
    $coupon = json_decode($order->coupon, true);
    $bio    = json_decode($order->order_address, true);

    $coupon_amount    = 0;
    if ( is_array($coupon) && isset($coupon['discount_type']) ){
        if ( $coupon['discount_type'] === 'percent' ) {
            $coupon_amount = ( $order->subtotal * $coupon['discount'] ) / 100;
        }
        elseif ( $coupon['discount_type'] === 'amount' ) {
            $coupon_amount   =  $coupon['discount'];
        }
        else{
            $coupon_amount = 0;
        }
    }
    else{
        $coupon_amount = 0;
    }
@endphp

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
                    <div class="account-order-details">
                        <div class="wd-form-order">
                            <div class="order-head">
                                <figure class="img-product">
                                    @if ( !empty(Auth::user()->image) )
                                        <img src="{{ asset(Auth::user()->image) }}" alt="product">
                                    @else
                                        <img src="{{ asset('public/backend/assets/images/user.jpg') }}" alt="product">
                                    @endif
                                </figure>

                                <div class="content">
                                    @if ( $order->order_status === "pending" )
                                        <span class="badge bg-warning">Shipped</span>
                                    @elseif ( $order->order_status === "processed_and_ready_to_ship" )
                                        <span class="badge bg-dark">Processed and ready to ship</span>
                                    @elseif ( $order->order_status === "shipped" )
                                        <span class="badge bg-secondary">Shipped</span>
                                    @elseif ( $order->order_status === "dropped_off" )
                                        <span class="badge bg-info">Dropped Off</span>
                                    @elseif ( $order->order_status === "out_for_delivery" )
                                        <span class="badge bg-success">Out For Delivery</span>
                                    @elseif ( $order->order_status === "delivered" )
                                    <span class="badge bg-success">Delivered</span>
                                    @elseif ( $order->order_status === "cancelled" )
                                    <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                    <h6 class="mt-8 fw-5">Order #{{ $order->order_id }}</h6>
                                </div>
                            </div>
                            <div class="tf-grid-layout md-col-2 gap-15">
                                <div class="item">
                                    <div class="text-2 text_black-2">Name</div>
                                    <div class="text-2 mt_4 fw-6">{{ Auth::user()->name }}</div>
                                </div>
                                <div class="item">
                                    <div class="text-2 text_black-2">Phone</div>
                                    <div class="text-2 mt_4 fw-6">{{ Auth::user()->phone }}</div>
                                </div>
                                <div class="item">
                                    <div class="text-2 text_black-2">Start Time</div>
                                    <div class="text-2 mt_4 fw-6">
                                        {{ date('d F Y, H:i:s A', strtotime($order->created_at)) }}
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="text-2 text_black-2">Address</div>
                                    <div class="text-2 mt_4 fw-6">{{ Auth::user()->address }}</div>
                                </div>
                            </div>

                            <div class="widget-tabs style-3 widget-order-tab">
                                <ul class="widget-menu-tab">
                                    <li class="item-title active">
                                        <span class="inner">Order History</span>
                                    </li>
                                    <li class="item-title">
                                        <span class="inner">Item Details</span>
                                    </li>
                                    <li class="item-title">
                                        <span class="inner">Courier</span>
                                    </li>
                                    <li class="item-title">
                                        <span class="inner">Receiver</span>
                                    </li>
                                </ul>
                                
                                <div class="widget-content-tab">
                                    <div class="widget-content-inner active">
                                        <div class="widget-timeline">
                                            <ul class="timeline">
                                                <li>
                                                    <div class="timeline-badge success"></div>
                                                    <div class="timeline-box">
                                                        <a class="timeline-panel" href="javascript:void(0);">
                                                            <div class="text-2 fw-6">Product Shipped</div>
                                                            <span>10/07/2024 4:30pm</span>
                                                        </a>
                                                        <p><strong>Courier Service : </strong>FedEx World Service Center</p>
                                                        <p><strong>Estimated Delivery Date : </strong>12/07/2024</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge success"></div>
                                                    <div class="timeline-box">
                                                        <a class="timeline-panel" href="javascript:void(0);">
                                                            <div class="text-2 fw-6">Product Shipped</div>
                                                            <span>10/07/2024 4:30pm</span>
                                                        </a>
                                                        <p><strong>Tracking Number : </strong>2307-3215-6759</p>
                                                        <p><strong>Warehouse : </strong>T-Shirt 10b</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge"></div>
                                                    <div class="timeline-box">
                                                        <a class="timeline-panel" href="javascript:void(0);">
                                                            <div class="text-2 fw-6">Product Packaging</div>
                                                            <span>12/07/2024 4:34pm</span>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge"></div>
                                                    <div class="timeline-box">
                                                        <a class="timeline-panel" href="javascript:void(0);">
                                                            <div class="text-2 fw-6">Order Placed</div>
                                                            <span>11/07/2024 2:36pm</span>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    
                                    <div class="widget-content-inner">
                                        @foreach ($order_products as $key => $item)
                                            @php
                                                $variants = json_decode($item->variants, true); // Convert to array
                                                $total_price = $item->qty * ( $item->variant_total + $item->unit_price );
                                            @endphp

                                            <div class="order-head">
                                                <figure class="img-product">
                                                    @if ( !empty($variants['image']) )
                                                        <img src="{{ asset($variants['image']) }}" alt="{{ $item->product_name }}">
                                                    @endif

                                                </figure>
                                                <div class="content">
                                                    <div class="text-2 fw-6">{{ $item->product_name }}</div>

                                                    <div class="mt_4"><span class="fw-6">Price :</span> {{ $order->currency_symbol }}{{ $item->unit_price }} X {{ $item->qty }}</div>

                                                    <div class="mt_4"><span class="fw-6">
                                                        @if ( !empty($variants['size_name']) )
                                                            Size :</span> {{ strtoupper($variants['size_name']) }} ( {{ $order->currency_symbol }}{{ $variants['size_price'] }} )
                                                        @endif
                                                    </div>

                                                    <div class="mt_4"><span class="fw-6">
                                                        @if ( !empty($variants['color_name']) )
                                                            Color :</span> {{ strtoupper($variants['color_name']) }} ( {{ $order->currency_symbol }}{{ $variants['color_price'] }} )
                                                        @endif
                                                    </div>

                                                    <div class="mt_4"><span class="fw-6">
                                                            Total :</span> {{ $order->currency_symbol }}{{ number_format($total_price, 2, '.', ''); }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <ul>
                                            <li class="d-flex justify-content-between text-2">
                                                <span>Total Price</span>
                                                <span class="fw-6">{{ $order->currency_symbol }}{{ number_format($order->subtotal, 2, '.', ''); }}</span>
                                            </li>

                                            <li class="d-flex justify-content-between text-2 mt_4 pb_8 line-bt">
                                                <span>(-) Coupon
                                                    @if (is_array($coupon) && isset($coupon['discount_type']))
                                                        @if ($coupon['discount_type'] === 'percent')
                                                            ( {{ $coupon['discount'] }}% )
                                                        @elseif ($coupon['discount_type'] === 'amount')
                                                            ( {{ $coupon['discount'] }}{{ $order->currency_name }} )
                                                        @endif
                                                    @endif
                                                </span>
                                                <span class="fw-6">
                                                    @if (is_array($coupon) && isset($coupon['discount_type']))
                                                        <span>{{ $order->currency_symbol }}{{ number_format($coupon_amount, 2, '.', '') }}</span>
                                                    @else
                                                        <span>{{ $order->currency_symbol }}{{ number_format($coupon_amount, 2, '.', '') }}</span>
                                                    @endif
                                                </span>
                                            </li>

                                            <li class="d-flex justify-content-between text-2 mt_4 pb_8 line-bt">
                                                <span>(+) Shipping Charge</span>
                                                <span class="fw-6">{{ $order->currency_symbol }}{{ number_format($order->delivery_charge, 2, '.', ''); }}</span>
                                            </li>

                                            <li class="d-flex justify-content-between text-2 mt_8">
                                                <span>Order Total</span>
                                                <span class="fw-6">{{ $order->currency_symbol }}{{ number_format($order->total_amount, 2, '.', ''); }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="widget-content-inner">
                                        <p>Our courier service is dedicated to providing fast, reliable, and secure delivery solutions tailored to meet your needs. Whether you're sending documents, parcels, or larger shipments, our team ensures that your items are handled with the utmost care and delivered on time. With a commitment to customer satisfaction, real-time tracking, and a wide network of routes, we make it easy for you to send and receive packages both locally and internationally. Choose our service for a seamless and efficient delivery experience.</p>
                                    </div>

                                    <div class="widget-content-inner">
                                        <p class="text-2 text-success">Thank you Your order has been received</p>
                                        <ul class="mt_20">
                                            <li>Order Number : <span class="fw-7">#{{ $order->order_id }}</span></li>
                                            <li>Date : <span class="fw-7"> {{ date('d F Y, H:i:s A', strtotime($order->created_at)) }}</span></li>
                                            <li>Total : <span class="fw-7">{{ $order->currency_symbol }}{{ number_format($order->total_amount, 2, '.', ''); }}</span></li>
                                            <li>Payment Methods : 
                                                <span class="fw-7">{{ $order->payment_method }}</span>
                                            </li>

                                        </ul>
                                    </div>

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