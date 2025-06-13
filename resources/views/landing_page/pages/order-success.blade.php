
<!DOCTYPE html>
<html lang="en-US">

<head>
    @include('frontend.include.css') 
    <title>Order Success Page</title>
    <link rel="stylesheet" href="{{ asset('public/frontend/multicart/style.css') }}">
</head>

<body class="preload-wrapper">
    <div id="wrapper">

        @php
            $coupon = json_decode($order_details->coupon, true);
            $bio    = json_decode($order_details->order_address, true);

            $coupon_amount    = 0;
            if ( is_array($coupon) && isset($coupon['discount_type']) ){
                if ( $coupon['discount_type'] === 'percent' ) {
                    $coupon_amount = ( $order_details->subtotal * $coupon['discount'] ) / 100;
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


        <!-- thank-you section start -->
        <section class="section-b-space light-layout">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="success-text">
                            <div class="checkmark">
                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                    </path>
                                </svg>
                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                    </path>
                                </svg>
                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                    </path>
                                </svg>
                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                    </path>
                                </svg>
                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                    </path>
                                </svg>
                                <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                    </path>
                                </svg>
                                <svg class="checkmark__check" height="36" viewBox="0 0 48 36" width="48"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M47.248 3.9L43.906.667a2.428 2.428 0 0 0-3.344 0l-23.63 23.09-9.554-9.338a2.432 2.432 0 0 0-3.345 0L.692 17.654a2.236 2.236 0 0 0 .002 3.233l14.567 14.175c.926.894 2.42.894 3.342.01L47.248 7.128c.922-.89.922-2.34 0-3.23">
                                    </path>
                                </svg>
                                <svg class="checkmark__background" height="115" viewBox="0 0 120 115" width="120"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M107.332 72.938c-1.798 5.557 4.564 15.334 1.21 19.96-3.387 4.674-14.646 1.605-19.298 5.003-4.61 3.368-5.163 15.074-10.695 16.878-5.344 1.743-12.628-7.35-18.545-7.35-5.922 0-13.206 9.088-18.543 7.345-5.538-1.804-6.09-13.515-10.696-16.877-4.657-3.398-15.91-.334-19.297-5.002-3.356-4.627 3.006-14.404 1.208-19.962C10.93 67.576 0 63.442 0 57.5c0-5.943 10.93-10.076 12.668-15.438 1.798-5.557-4.564-15.334-1.21-19.96 3.387-4.674 14.646-1.605 19.298-5.003C35.366 13.73 35.92 2.025 41.45.22c5.344-1.743 12.628 7.35 18.545 7.35 5.922 0 13.206-9.088 18.543-7.345 5.538 1.804 6.09 13.515 10.696 16.877 4.657 3.398 15.91.334 19.297 5.002 3.356 4.627-3.006 14.404-1.208 19.962C109.07 47.424 120 51.562 120 57.5c0 5.943-10.93 10.076-12.668 15.438z">
                                    </path>
                                </svg>
                            </div>
                            <h2>thank you</h2>
                            <p>Payment is successfully processsed and your order is on the way</p>
                            <p class="font-weight-bold">Transaction ID: {{ $order_details->transaction_id }}</p>

                            <a href="{{ url()->previous() }}" class="tf-btn mt-4">
                                <span class="text">Go Back to home page</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section ends -->


        <!-- order-detail section start -->
        <section class="section-b-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="product-order">
                            <table class="tf-table-page-cart">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_products as $item)
                                    @php
                                        $variants = json_decode($item->variants, true); // Convert to array
                                        $total_price = $item->qty * ( $item->variant_total + $item->unit_price );
                                    @endphp
                                    
                                        <tr class="tf-cart-item file-delete">
                                            <td class="tf-cart-item_product">
                                                <a href="javascript:void();" class="img-box">
                                                    <img src="{{ asset($variants['image']) }}" alt="{{ asset($variants['slug']) }}">
                                                </a>
                                                <div class="variant-box">
                                                    <div class="tf-select">
                                                        <div class="product_variant">
                                                            {{ $item->product_name }}
                                                        </div>
                                                    </div>
                                                    
                                                    @if ( !empty($variants['color_name']) )
                                                        <div class="tf-select">
                                                            <div class="product_variant">
                                                                Color : {{ strtoupper($variants['color_name']) }} ( {{ $order_details->currency_symbol }}{{ $variants['color_price'] }} )
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if ( !empty($variants['size_name']) )
                                                        <div class="tf-select">
                                                            <div class="product_variant">
                                                                Size : {{ strtoupper($variants['size_name']) }} ( {{ $order_details->currency_symbol }}{{ $variants['size_price'] }} )
                                                            </div>  
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="tf-cart-item_price text-center">
                                                <div class="cart-price text-button price-on-sale">{{ $order_details->currency_symbol }}{{ number_format($item->unit_price, 2, '.', ''); }}</div>
                                            </td>
                                            <td class="tf-cart-item_quantity">
                                                <div class="cart-price text-button price-on-sale">{{ $item->qty }} {{ $item->units }}</div>
                                            </td>
                                            <td class="tf-cart-item_total text-center">
                                                <div class="cart-total text-button total-price">{{ $order_details->currency_symbol }}{{ number_format($total_price, 2, '.', ''); }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                            <div class="total-sec">
                                <ul>
                                    <li>subtotal <span>{{ $order_details->currency_symbol }}{{ number_format($order_details->subtotal, 2, '.', ''); }}</span></li>
                                    
                                    {{-- <li>shipping <span>$12.00</span></li> --}}
                                    <li>(+) Shipping Charge <span>{{ $order_details->currency_symbol }}{{ number_format($order_details->delivery_charge, 2, '.', ''); }}</span></li>

                                    <li>(-) Coupon 
                                        @if (is_array($coupon) && isset($coupon['discount_type']))
                                            @if ($coupon['discount_type'] === 'percent')
                                                ( {{ $coupon['discount'] }}% )
                                            @elseif ($coupon['discount_type'] === 'amount')
                                                ( {{ $coupon['discount'] }}{{ $order_details->currency_name }} )
                                            @endif
                                    
                                            <span>{{ $order_details->currency_symbol }}{{ number_format($coupon_amount, 2, '.', '') }}</span>
                                        @else
                                            <span>{{ $order_details->currency_symbol }}{{ number_format($coupon_amount, 2, '.', '') }}</span>
                                        @endif
                                    </li>
                                    {{-- <li>tax(GST) <span>$10.00</span></li> --}}
                                </ul>
                            </div>
                            <div class="final-total">
                                <h3>total <span>{{ $order_details->currency_symbol }}{{ number_format($order_details->total_amount, 2, '.', ''); }}</span></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 offset-lg-1 mt-5">
                        <div class="order-success-sec">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h4>summery</h4>
                                    <ul class="order-detail">
                                        <li>order ID: {{ $order_details->order_id }}</li>
                                        <li>Order Date: {{ date('F d, Y', strtotime($order_details->created_at)) }}</li>
                                        <li>Order Total: {{ $order_details->currency_symbol }}{{ number_format($order_details->total_amount, 2, '.', ''); }}</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <h4>Customer Details</h4>
                                    <ul class="order-detail">
                                        <li>Name : {{ $bio['full_name'] }}</li>
                                        @if ( !empty($bio['email']) )
                                            <li>Email : {{ $bio['email'] }}</li>
                                        @endif
                                        <li>Contact No : {{ $bio['phone'] }}</li>
                                        <li>Country : Bangladesh</li>
                                        @if ( !empty($bio['city']) )
                                            <li>City : {{ $bio['city'] }}</li>
                                        @endif
                                        <li>Payment Method : {{ $order_details->payment_method }}</li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 payment-mode mt-3">
                                    <h4>Delivery Address</h4>
                                    <p>{{ $bio['address'] }}</p>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="delivery-sec">
                                        <h3>expected date of delivery: <span>october 22, 2018</span></h3>
                                        <a href="order-tracking.html">track order</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section ends -->


        <!-- Javascript -->
        @include('frontend.include.script')

    </div>
</body>

</html>