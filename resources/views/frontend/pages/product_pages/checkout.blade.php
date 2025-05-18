@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || Checkout</title>
    <meta name="description" content="">

    <meta property="og:title" content="Checkout">
    <meta property="og:description" content="">
    <meta property="og:image" content="{{ asset(getSetting()->logo ) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
    {{-- <link rel="stylesheet" href="{{ asset('public/frontend/css/select2.min.css') }}"> --}}
@endpush


@section('body-content')

<!-- page-title -->
<div class="page-title skeleton" style="background-image: url(
    @if( !empty(getSetting()->banner_breadcrumb_img) )
        {{ asset(getSetting()->banner_breadcrumb_img) }}
    @else
        {{ asset('public/frontend/images/section/page-title.jpg') }}
    @endif
    );">
    
    <div class="container">
        <h3 class="heading text-center">Check Out</h3>
        <ul class="breadcrumbs d-flex align-items-center justify-content-center">
            <li><a class="link" href="{{ route('home') }}">Homepage</a></li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li><a class="link" href="{{ route('product.page') }}">Shop</a></li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li><a class="link" href="{{ route('show-cart') }}">View Cart</a></li>
        </ul>
    </div>
</div>
<!-- /page-title -->


    <!-- Section checkout -->
    <section class="">
        <div class="container main_checkout_data">

            <div class="row">
                <div class="col-xl-6">
                    <div class="flat-spacing tf-page-checkout">

                        {{-- @if ( !Auth::guard('web')->check() )
                            <div class="wrap">
                                <div class="title-login">
                                    <p>Create New Account?</p>
                                    <a href="{{ route('register') }}" class="text-button">Register here</a>
                                </div>

                                <form class="login-box" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="grid-2">
                                        <div class="">
                                            <input type="text" placeholder="Email Address or Phone Number" name="login" tabindex="2" value="{{ old('login') }}" aria-required="true">
                                            <x-input-error :messages="$errors->get('login')" class="mt-1 text-danger" style="margin-top: -20px !important; " />
                                        </div>
                                        
                                        <div class="">
                                            <input type="password" name="password" placeholder="Password" aria-required="true" autocomplete="off">
                                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" style="margin-top: -20px !important;" />
                                        </div>
                                    </div>

                                    <button class="tf-btn" type="submit">
                                        <span class="text">Login</span>
                                    </button>
                                </form>
                            </div>
                        @endif --}}

                        <div class="wrap">
                            <h5 class="title skeleton">Information</h5>

                            <form id="payment-form" class="form-payment info-box" action="" method="POST">
                                @csrf 

                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <label for="" class="mb-2 skeleton" style="font-weight: 500;">Full Name <span class="text-danger">*</span></label>

                                        <div class="skeleton">
                                            <input type="text" name="full_name" placeholder="Full Name*" value="{{ old('full_name', Auth::check() ? Auth::user()->name : '') }}" class="mb-1">
                                        </div>
    
                                        @error('full_name')
                                            <div class="text-danger error_validation" >{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="col-lg-6">
                                        <label for="" class="skeleton mb-2" style="font-weight: 500;">Email Address ( Optional )</label>

                                        <div class="skeleton">
                                            <input type="text" name="email" class="skeleton" placeholder="Email Address" @if( !empty(Auth::user()->email) ) disabled @endif value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}">
                                        </div>
    
                                        @error('email')
                                            <div class="text-danger error_validation" >{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <label for="" class="mb-2 skeleton" style="font-weight: 500;">Phone Number <span class="text-danger">*</span></label>

                                        <div class="skeleton">
                                            <input type="text" name="phone" pattern="^0\d{10}$" maxlength="11" placeholder="Phone Number*" value="{{ old('phone', Auth::check() ? Auth::user()->phone : '') }}" class="mb-1">
                                        </div>
    
                                        @error('phone')
                                            <div class="text-danger error_validation" >{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-2">
                                        <label for="" class="skeleton mb-2" style="font-weight: 500;">Delivery Charge <span class="text-danger">*</span></label>

                                        <div class="skeleton">
                                            @if ( !empty(getSetting()->inside_city) && !empty(getSetting()->outside_city) )
                                                <div class="tf-select">
                                                    <select class="text-title" id="shippingRules" style="border-radius: 8px;" required>
                                                        <option value="{{ getSetting()->inside_city }}" {{ session('shippingCost') == getSetting()->inside_city ? 'selected' : '' }}>InSide Dhaka ( {{ getSetting()->currency_symbol . getSetting()->inside_city }} )</option>
                                                        <option value="{{ getSetting()->outside_city }}" {{ session('shippingCost') == getSetting()->outside_city ? 'selected' : '' }}>OutSide Dhaka ( {{ getSetting()->currency_symbol . getSetting()->outside_city }} )</option>
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="grid-1">
                                    <label for="" class="mb-2" style="font-weight: 500;">Town/City </label>
                                    <input type="text" name="city" placeholder="Town/City" value="{{ old('city', Auth::check() ? Auth::user()->city : '') }}">

                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="grid-1">
                                    <label for="" class="skeleton mb-2" style="font-weight: 500;">Full Address <span class="text-danger">*</span></label>

                                    <div class="skeleton">
                                        <textarea name="address" id="address" placeholder="Address*" cols="30" rows="6">{{ old('address', Auth::check() ? Auth::user()->address : '') }}</textarea>    
                                    </div>

                                    @error('address')
                                        <div class="text-danger error_validation">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 class="title skeleton mt-5">Choose payment Option:</h5>

                                <div class="payment-box" id="payment-box">
                                    <!-- Cash on Delivery -->
                                    <div class="payment-item skeleton">
                                        <label for="delivery-method" class="payment-header" data-payment-route="{{ route('payment.cod') }}">
                                            <input type="radio" name="payment-method" class="tf-check-rounded" required id="delivery-method" value="cod">
                                            <span class="text-title">Cash on delivery</span>
                                        </label>
                                    </div>

                                    <div class="payment-item skeleton">
                                        <label for="sslcommerz-method" class="payment-header" data-payment-route="{{ route('payment.ssl_commercz') }}">
                                            <input type="radio" name="payment-method" class="tf-check-rounded" id="sslcommerz-method" value="sslcommerz" required>
                                            <span class="text-title apple-pay-title align-items-center"><img src="{{ asset('public/frontend/images/payment/ssl_commerz.png') }}" alt=""></span>
                                        </label>
                                    </div>

                                    {{-- <div class="payment-item skeleton paypal-item">
                                        <label for="bKash-method" class="payment-header" data-payment-route="{{ route('payment.bkash') }}">
                                            <input type="radio" name="payment-method" class="tf-check-rounded" id="bKash-method" value="bkash">
                                            <span class="paypal-title apple-pay-title align-items-center"><img src="{{ asset('public/frontend/images/payment/Bkash.png') }}" alt=""></span>
                                        </label>
                                    </div> --}}
                                </div>

                                <button type="submit" id="pay-now-button" class="skeleton tf-btn btn-reset">Payment</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-1">
                    <div class="line-separation"></div>
                </div>

                <div class="col-xl-5">
                    <div class="flat-spacing flat-sidebar-checkout">
                        <div class="sidebar-checkout-content">
                            <h5 class="title skeleton">Shopping Cart</h5>
                            <div class="list-product" id="list_product">

                                @if ($cartItems->count() > 0)
                                    @foreach ($cartItems as $item)
                                        @php
                                            $totalPrice = ($item->price + ($item->options->size_price ?? 0) + ($item->options->color_price ?? 0)) * $item->qty;

                                            $variant_price = ($item->price + ($item->options->size_price ?? 0) + ($item->options->color_price ?? 0));
                                        @endphp

                                        <div class="item-product checkout_product" id="checkout-{{ $item->rowId }}">
                                            <a href="{{ route('product.details', $item->options->slug) }}" class="img-product skeleton">
                                                <img src="{{ asset($item->options->image) }}" alt="{{ $item->slug }}">
                                            </a>

                                            <div class="content-box">
                                                <div class="info">
                                                    <a href="{{ route('product.details', $item->options->slug) }}" class="name-product link text-title skeleton">{{ $item->name }}</a>

                                                    <div class="variant text-caption-1 text-secondary"><span class="size skeleton">{{ strtoupper($item->options->size_name) }} ( {{ getSetting()->currency_symbol }}{{ $item->options->size_price ?? 0 }} )</span> / <span class="color skeleton">{{ $item->options->color_name }} ( {{ getSetting()->currency_symbol }}{{ $item->options->color_price ?? 0 }} )</span></div>

                                                    <div class="wg-quantity skeleton">
                                                        <span class="btn-quantity product-decrease">-</span>
                                                        <input type="text" name="number" class="product_quantity" data-row_id="{{ $item->rowId }}" value="{{ $item->qty }}">
                                                        <span class="btn-quantity product-increase">+</span>
                                                    </div>
                                                </div>

                                                <div class="total-price text-button" style="flex-direction: column">
                                                    <div class="text-button tf-btn-remove remove checkout_remove_cart skeleton" data-row_id="{{ $item->rowId }}">Remove</div>

                                                    <div class="skeleton">
                                                        <span class="count" data-row_id="{{ $item->rowId }}" id="qty{{ $item->rowId }}">{{ $item->qty .' '. $item->options->units }}</span>
                                                        <span class="x-mark">X</span>  <span class="price">{{ getSetting()->currency_symbol }}{{ $item->price }}</span>
                                                    </div>

                                                    <div id="{{ $item->rowId }}" class="cart_total text-button total_price skeleton">{{ getSetting()->currency_symbol }}{{ $totalPrice }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger text-center" style="margin: 0 24px;" role="alert">
                                        <p class="mb-1">No items in the cart. </p>
                                        <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                    </div>
                                @endif
                            </div>

                            <div class="whole_discount_container">
                                <div class="group-discount" style="display: block;">
                                    <div class="sec-discount">
                                        @if ( getCartTotal() > 0 )
                                            <div dir="ltr" class="swiper tf-sw-categories" data-preview="2.25" data-tablet="3" data-mobile-sm="2.5" data-mobile="1.2" data-space-lg="20" data-space-md="20" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                                                <div class="swiper-wrapper skeleton">
                                                    @foreach ($coupons as $item)
                                                        <div class="swiper-slide">
                                                            @if ( date('Y-m-d') >= $item->start_date && date('Y-m-d') <= $item->end_date && $item->quantity >= $item->total_used)
                                                                <div class="box-discount {{ $item->code }} {{ Session::has('coupon') && Session::get('coupon')['coupon_code'] === $item->code ? 'active' : '' }}">
                                                                    <div class="discount-top">
                                                                        <div class="discount-off">
                                                                            <div class="text-caption-1">Discount</div>
                                                                            <span class="sale-off text-btn-uppercase">
                                                                                @if ( $item->discount_type === "amount" )
                                                                                    {{ getSetting()->currency_symbol }}{{ $item->discount }} OFF
                                                                                @elseif( $item->discount_type === "percent")
                                                                                    {{ $item->discount }}% OFF
                                                                                @endif
                                                                            </span>
                                                                        </div>

                                                                        <div class="discount-from">
                                                                            <p class="text-caption-1">For all orders <br> from <span class="main_cart_total">{{ getSetting()->currency_symbol }}{{ getMainCartTotal() }}</span></p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="discount-bot">
                                                                        <span class="text-btn-uppercase">{{ $item->code }}</span>
                                                                        <button type="button" class="tf-btn tf_btn_discount" data-code="{{ $item->code }}"><span class="text">Apply Code</span></button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <form class="coupon_form">
                                            @csrf
                        
                                            <div class="ip-discount-code skeleton">
                                                <input type="text" name="coupon_code" id="coupon_codes" placeholder="Add voucher discount"
                                                @if ( Session::has('coupon') )
                                                    value="{{ Session::get('coupon')['coupon_code'] }}"
                                                @endif
                                                >
                                                <button type="submit" class="tf-btn"><span class="text">Apply Code</span></button>
                                            </div>
                                        </form>

                                        {{-- <p>Discount code is only used for orders with a total value of products over $500.00</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="sec-total-price">
                                <div class="top">
                                    <h5 class="item d-flex align-items-center justify-content-between ">
                                        <span class="skeleton">SubTotal</span>
                                        <span class="skeleton tf-totals-total-value">
                                            {{ getSetting()->currency_symbol }}{{ getCartTotal() }}
                                        </span>
                                    </h5>

                                    <div class="item d-flex align-items-center justify-content-between text-button">
                                        <span class="skeleton">(-) Discounts
                                            <code class="percent_show">
                                                @if ( Session::has('coupon') && Session::get('coupon')['discount_type'] === "percent")
                                                    ({{ Session::get('coupon')['discount'] }}%)
                                                @endif
                                            </code>
                                        </span>

                                        <span class="total_discount skeleton">
                                            @if ( Session::has('coupon') )
                                                @if ( Session::get('coupon')['discount_type'] === "amount")
                                                    {{ getSetting()->currency_symbol }}{{ Session::get('coupon')['discount'] }}
                                                @elseif( Session::get('coupon')['discount_type'] === "percent" )
                                                    {{ getSetting()->currency_symbol }}{{ ( getCartTotal() * Session::get('coupon')['discount'] ) / 100; }}
                                                @endif
                                            @else
                                                {{ getSetting()->currency_symbol }}0
                                            @endif
                                        </span>
                                    </div>

                                    <div class="item d-flex align-items-center justify-content-between text-button">
                                        {{-- <span>(+) Shipping</span> --}}
                                        <span class="skeleton">(+) Delivery Charge</span>
                                        <span class="skeleton shipping_amount">
                                            @if ( Session::has('shippingCost') && Session::get('shippingCost'))
                                                {{ getSetting()->currency_symbol }}{{ Session::get('shippingCost') ?: 0 }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <h5 class="d-flex justify-content-between">
                                        <span class="skeleton">Total</span>
                                        <span class="skeleton total-price-checkout main_cart_total">{{ getSetting()->currency_symbol }}{{ getMainCartTotal() }}</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /Section checkout -->


@endsection

@push('add-js')

<script>
    $(document).ready(function(){
        var currency_symbol = "{{ getSetting()->currency_symbol }}";
        var currency_name   = "{{ getSetting()->currency_name }}";

        //__ Product Quantity Increament __//
        $(document).on('click', '.product-increase', function() {
            let input = $(this).siblings('.product_quantity');
            let rowId = input.data('row_id');
            let quantity = parseInt(input.val()) || 0;
            quantity += 1; 
            input.val(quantity); 
            console.log(rowId);

            $.ajax({
                url: "{{ route('cart.update.quantity') }}",
                method: 'POST',
                data: {
                    quantity : quantity,
                    rowId    : rowId,
                },
                success: function(data) {
                    console.log(data);
                    if( data.status === 'success' ){ 
                        let productId = '#' + rowId;
                        let qtyId = '#qty' + rowId;
                        $(productId).text(`${currency_symbol}` + data.productTotal);
                        $(qtyId).text(data.productQty);

                        calculationCouponDiscount();
                        getSidebarCartTotal();
                        sidebarCartData();
                        toastr.success(data.message);
                    }
                    else if( data.status === 'error' ){
                        input.val(data.recent_stock);
                        sidebarCartData();
                        toastr.error(data.message);
                    }
                },
                error: function(err) {
                    console.log(err);
                },
            })
        })

        //__ Product Quantity Decrement __//
        $(document).on('click', '.product-decrease', function() {
            let input = $(this).siblings('.product_quantity');
            let rowId = input.data('row_id');
            let quantity = parseInt(input.val()) || 0;
            quantity -= 1; 
            if( quantity < 1 ){
                quantity = 1
            }
            input.val(quantity); 
            // console.log(rowId);

            $.ajax({
                url: "{{ route('cart.update.quantity') }}",
                method: 'POST',
                data: {
                    quantity : quantity,
                    rowId    : rowId,
                },
                success: function(data) {
                    // console.log(data);
                    if( data.status === 'success' ){ 
                        let productId = '#' + rowId;
                        let qtyId = '#qty' + rowId;
                        $(productId).text(`${currency_symbol}` + data.productTotal);
                        $(qtyId).text(data.productQty);

                        calculationCouponDiscount();
                        getSidebarCartTotal();
                        sidebarCartData();
                        toastr.success(data.message);
                    }
                    else if( data.status === 'stock_out' ){
                        toastr.error(data.message);
                    }
                },
                error: function(err) {
                    console.log(err);
                },
            })
        })

        //__ Single product clear __//
        // $(document).on('click', '.remove_product_cart', function(e) {
        //     e.preventDefault();
        //     let id = $(this).data('id');    
        //     // console.log(id); 

        //     $.ajax({
        //         url: "{{ url('/cart/remove-product') }}/" + id,
        //         method: 'GET',
        //         dataType: 'json',
        //         data: { id: id },
        //         success: function(data) {
        //             // console.log(data);
        //             if( data.status === 'success' ){ 
        //                 calculationCouponDiscount();
        //                 getSidebarCartTotal();
        //                 let singleProductRemove = '#remove-' +id;
        //                 $(singleProductRemove).remove();

        //                 // Check if the table is empty and display the message
        //                 const tableBody = $('#cart-table-body');
        //                 if (tableBody.children('tr.tf-cart-item').length === 0) {
        //                     tableBody.html(`
        //                         <tr>
        //                             <td colspan="5">
        //                                 <div class="alert alert-danger text-center" role="alert" style="margin: 0 24px;">
        //                                     <p class="mb-1">No items in the cart. </p>
        //                                     <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
        //                                 </div>
        //                             </td>
        //                         </tr>
        //                     `);

        //                     $('.tf-mini-cart-threshold').remove();
        //                     $('#tf-mini-cart-actions-field').remove();
        //                     $('#coupon_codes').val('');
        //                     $('.group-discount').remove();
        //                 }
        //                 sidebarCartData();
        //                 getCartCount(); 
        //                 toastr.success(data.message);
        //             }
        //         },
        //         error: function(err) {
        //             console.log(err);
        //         },
        //     })
        // })

        //__ Sidebar Single product clear __//
        $(document).on('click', '.side_remove_cart', function(e) {
            e.preventDefault();
            let id = $(this).data('row_id');    
            // console.log(id); 

            $.ajax({
                url: "{{ url('/cart/remove-product') }}/" + id,
                method: 'GET',
                dataType: 'json',
                data: { id: id },
                success: function(data) {
                    // console.log(data);
                    if( data.status === 'success' ){ 
                        getSidebarCartTotal();
                        let singleProductRemove = '#side_remove-' +id;
                        $(singleProductRemove).remove();

                        // Check if the table is empty and display the message
                        const tableBody = $('#cart-sidebar-table-body'); // Replace with the actual tbody ID or class
                        if (tableBody.children('.tf-mini-cart-item').length === 0) {
                            tableBody.html(`
                                <div class="alert alert-danger text-center" role="alert" style="margin: 0 24px;">
                                    <p class="mb-3">No items in the cart. </p>
                                    <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                </div>
                            `);

                            // $('.main_checkout_data').html(`
                            //     <div class="row my-5">
                            //         <div class="alert alert-danger text-center" style="margin: 0 24px; padding: 4rem 0;" role="alert">
                            //             <p class="mb-3">Oops! Your cart looks empty. Find something amazing and add it to your cart.</p>
                            //             <a href="http://localhost/shadhin_bazaar/products" class="tf-btn btn-reset">Continue Shopping</a>
                            //         </div>
                            //     </div>
                            // `);
                            $('.tf-mini-cart-threshold').remove();
                            $('#tf-mini-cart-actions-field').remove();
                            $('#coupon_codes').val('');
                            $('.group-discount').remove();
                        }
                        calculationCouponDiscount(); 
                        CheckoutPageData();
                        CartPageData();
                        getCartCount(); 
                        toastr.success(data.message);
                    }
                },
                error: function(err) {
                    console.log(err);
                },
            })
        })

        //__ Checkout product clear __//
        $(document).on('click', '.checkout_remove_cart', function (e) {
            e.preventDefault();

            // Extract the correct rowId without the prefix
            let rowId = $(this).data('row_id');

            $.ajax({
                url: "{{ url('/cart/remove-product') }}/" + rowId,
                method: 'GET',
                success: function (data) {
                    if (data.status === 'success') {
                        $(`#checkout-${rowId}`).remove();

                        // Check if the cart is empty and update accordingly
                        if ($('#list_product .checkout_product').length === 0) {
                            $('#list_product').html(`
                                <div class="alert alert-danger text-center" role="alert" style="margin: 0 24px;">
                                    <p class="mb-3">No items in the cart.</p>
                                    <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                </div>
                            `);
                            // $('.main_checkout_data').html(`
                            //     <div class="row my-5">
                            //         <div class="alert alert-danger text-center" style="margin: 0 24px; padding: 4rem 0;" role="alert">
                            //             <p class="mb-3">Oops! Your cart looks empty. Find something amazing and add it to your cart.</p>
                            //             <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                            //         </div>
                            //     </div>
                            // `);
                            $('.tf-mini-cart-threshold').remove();
                            $('#tf-mini-cart-actions-field').remove();
                            $('#coupon_codes').val('');
                            $('.group-discount').remove();
                        }

                        sidebarCartData();  
                        getSidebarCartTotal();
                        calculationCouponDiscount(); 
                        getCartCount(); 
                        CartPageData();
                        toastr.success(data.message);
                    }
                },
                error: function (err) {
                    console.error(err);
                    toastr.error('Failed to remove item from cart.');
                }
            });
        });

        //__ Shipping Rules add __//
        const $shippingRules = $('#shippingRules');

        function applyShippingRule(selectedValue) {
            if (selectedValue) {
                $.ajax({
                    url: "{{ route('apply.shipping') }}", // Ensure the route exists
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Laravel CSRF token
                        shippingRule: selectedValue
                    },
                    success: function (res) {
                        if (res.status === true) {
                            $('.shipping_amount').text(`${currency_symbol}` + res.shippingCost);
                            $('.main_cart_total').text(`${currency_symbol}` + res.cartTotal);
                            toastr.success(res.message);
                        } else {
                            $('.shipping_amount').text(`${currency_symbol}` + res.shippingCost);
                            toastr.error(res.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error applying shipping rule:', error);
                        toastr.error(res.message);
                    }
                });
            }
        }

        // Trigger the AJAX call on page load for the default selected option
        applyShippingRule($shippingRules.val());

        // Trigger AJAX call on dropdown change
        $shippingRules.on('change', function () {
            applyShippingRule($(this).val());
        });


        // Fetch all cart data from Sidebar
        function sidebarCartData() {
            $.ajax({
                method: 'GET',
                url: "{{ route('get.sidebar.cart') }}",
                success: function(response) {
                    let cartHtml = '';

                    // Check if the cart is empty
                    if (response.isEmpty) {
                        cartHtml = `
                            <div class="alert alert-danger text-center" role="alert" style="margin: 0 24px;">
                                <p class="mb-3">No items in the cart.</p>
                                <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                            </div>
                        `;
                    } else {
                        // Loop through cart items if not empty
                        response.cartItems.forEach(item => {
                            cartHtml += `
                                <div class="tf-mini-cart-item file_delete" id="side_remove-${item.rowId}">
                                    <div class="tf-mini-cart-image">
                                        <img class="lazyload" data-src="${item.image}" src="${item.image}" alt="${item.slug}">
                                    </div>
                                    <div class="tf-mini-cart-info flex-grow-1">
                                        <div class="mb_12 d-flex align-items-center justify-content-between de-flex gap-12">
                                            <div class="text-title">
                                                <a href="/product-details/${item.slug}" class="link text-line-clamp-1">${item.name}</a>
                                            </div>
                                            <div class="text-button tf-btn-remove remove side_remove_cart" data-row_id="${item.rowId}">Remove</div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between de-flex gap-12">
                                            <div class="text-secondary-2">
                                                ${item.size_name ? item.size_name.toUpperCase() + ` (${currency_symbol}${item.size_price})` : ''} 
                                                ${item.color_name ? ` / ${item.color_name} (${currency_symbol}${item.color_price})` : ''}
                                            </div>
                                            <div class="text-button">${item.qty} ${item.units} X ${currency_symbol}${item.price}</div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between de-flex gap-12">
                                            <div class="text-secondary-2">Amount</div>
                                            <div class="text-button">${currency_symbol}${item.total}</div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    }

                    // Update the cart sidebar body
                    $('#cart-sidebar-table-body').html(cartHtml);
                    sidebarCartActionElement();
                },
                error: function(err) {
                    toastr.error('Failed to fetch cart data.');
                    console.log(err);
                }
            });
        }

        // Fetch all cart data for Cart Page
        function CartPageData(){
            $.ajax({
                method: 'GET',
                url: "{{ route('get.sidebar.cart') }}", // Update with your route
                success: function(response) {
                    if (response.status === true) {
                        let cartHtml = '';

                        if (response.isEmpty) {
                            // If cart is empty, display a message
                            cartHtml = `
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-danger text-center" role="alert">
                                            <p class="mb-3">There is no cart item</p>
                                            <a href="{{ route('checkout') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        } else {
                            // Loop through cart items and generate HTML
                            response.cartItems.forEach(item => {
                                cartHtml += `
                                    <tr class="tf-cart-item file-delete" id="remove-${item.rowId}">
                                        <td class="tf-cart-item_product">
                                            <a href="/product-details/${item.slug}" class="img-box">
                                                <img src="${item.image}" alt="${item.slug}">
                                            </a>
                                            <div class="cart-info">
                                                <a href="/product-details/${item.slug}" class="cart-title link">${item.name}</a>
                                                <div class="variant-box">
                                                    <div class="tf-select">
                                                        <div class="product_variant">
                                                            Color: ${item.color_name || 'N/A'} (${currency_symbol}${item.color_price})
                                                        </div>
                                                    </div>
                                                    <div class="tf-select">
                                                        <div class="product_variant">
                                                            Size: ${item.size_name || 'N/A'} (${currency_symbol}${item.size_price})
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-cart-title="Price" class="tf-cart-item_price text-center">
                                            <div class="cart_price text-button price_on_sale">${currency_symbol}${item.price}</div>
                                        </td>
                                        <td data-cart-title="Quantity" class="tf-cart-item_quantity">
                                            <div class="wg-quantity mx-md-auto">
                                                <span class="btn-quantity product-decrease" data-row_id="${item.rowId}">-</span>
                                                <input type="text" name="number" class="product_quantity" data-row_id="${item.rowId}" value="${item.qty}">
                                                <span class="btn-quantity product-increase" data-row_id="${item.rowId}">+</span>
                                            </div>
                                        </td>
                                        <td data-cart-title="Total" class="tf-cart-item_total text-center">
                                            <div id="${item.rowId}" class="cart_total text-button total_price">${currency_symbol}${item.total}</div>
                                        </td>
                                        <td class="remove-cart remove_item_alignemnt" id="remove_cart">
                                            <i class="icon bx bx-x icon-close-popup remove_product_cart" style="font-size: 20px;" data-id="${item.rowId}"></i>
                                        </td>
                                    </tr>
                                `;
                            });
                        }

                        // Update the cart table body
                        $('#cart-table-body').html(cartHtml);
                    }
                },
                error: function(err) {
                    toastr.error('Failed to fetch cart data.');
                    console.log(err);
                }
            });
        }

        // Fetch all cart data for Checkout Page
        function CheckoutPageData(){
            $.ajax({
                method: 'GET',
                url: "{{ route('get.sidebar.cart') }}", // Update with your route
                success: function(response) {
                    if (response.status === true) {
                        let cartHtml = '';

                        if (response.isEmpty) {
                            // If cart is empty, display a message
                            cartHtml = `
                                <div class="alert alert-danger text-center" role="alert" style="margin: 0 24px;">
                                    <p class="mb-3">No items in the cart.</p>
                                    <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                </div>
                            `;
                        } else {
                            // Loop through cart items and generate HTML
                            response.cartItems.forEach(item => {
                                cartHtml += `
                                <div class="item-product checkout_product" id="checkout-${item.rowId}">
                                    <a href="/product-details/${item.slug}" class="img-product">
                                        <img src="${item.image}" alt="${item.slug}">
                                    </a>

                                    <div class="content-box">
                                        <div class="info">
                                            <a href="/product-details/${item.slug}" class="name-product link text-title">${item.name}</a>

                                            <div class="variant text-caption-1 text-secondary"><span class="size">${item.color_name || 'N/A'} ( ${currency_symbol}${item.color_price} )</span> / <span class="color">${item.size_name || 'N/A'} ( ${currency_symbol}${item.size_price} )</span></div>

                                            <div class="wg-quantity">
                                                <span class="btn-quantity product-decrease">-</span>
                                                <input type="text" name="number" class="product_quantity" data-row_id="${item.rowId}" value="${item.qty}">
                                                <span class="btn-quantity product-increase">+</span>
                                            </div>
                                        </div>

                                        <div class="total-price text-button" style="flex-direction: column">
                                            <div class="text-button tf-btn-remove remove checkout_remove_cart" data-row_id="${item.rowId}">Remove</div>

                                            <div class="">
                                                <span class="count" data-row_id="${item.rowId}" id="qty${item.rowId}">${item.qty} ${item.units}</span>
                                                <span class="x-mark">X</span>  <span class="price">${currency_symbol}${item.variant_price}</span>
                                            </div>

                                            <div id="${item.rowId}" class="cart_total text-button total_price">${currency_symbol}2450</div>
                                        </div>
                                    </div>
                                </div>`;
                            });
                        }

                        // Update the cart table body
                        $('#list_product').html(cartHtml);
                    }
                },
                error: function(err) {
                    toastr.error('Failed to fetch cart data.');
                    console.log(err);
                }
            });
        }

        //__ Clear all Cart data __//
        $('#clear_cart').on('click', function(e){
            e.preventDefault();

            swal.fire({
                title: "Are you sure?",
                text: "This action will clear your cart!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('clear.cart') }}",
                        method: 'GET',
                        success: function(data) {
                            // console.log(data);
                            if( data.status === 'success' ){ 
                                calculationCouponDiscount();
                                getSidebarCartTotal();
                                $('.tf-cart-item').remove();

                                // Check if the table is empty and display the message
                                const tableBody = $('#cart-table-body'); // Replace with the actual tbody ID or class
                                if (tableBody.children('tr.tf-cart-item').length === 0) {
                                    tableBody.html(`
                                        <tr>
                                            <td colspan="5">
                                                <div class="alert alert-danger text-center"  role="alert" style="margin: 0 24px;">
                                                    <p class="mb-3">No items in the cart. </p>
                                                    <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                                </div>
                                            </td>
                                        </tr>
                                    `);
                                    
                                    $('.tf-mini-cart-threshold').remove();
                                    $('#tf-mini-cart-actions-field').remove();
                                    $('#coupon_codes').val('');
                                    $('.group-discount').remove();
                                }
                                sidebarCartData();
                                getCartCount();
                                toastr.success(data.message);
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        },
                    })
                } 
                else {
                    swal.fire('Your cart data is safe');
                }
            })
        })

        //__ Cart subTotal __//
        function getSidebarCartTotal(){
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    console.log('get total', data);
                    if( data.status === 'success' ){
                       $('.tf-totals-total-value').text(`${currency_symbol}` + data.total);
                       $('.subTotal').text(`${currency_symbol}` + data.total);
                    //    $('.main_cart_total').text('$' + data.total);
                    }
                },
                error: function(data) {
                    console.log('Error adding product to cart:', data);
                },
            });
        }

        //__ Sidebar Cart Element __//
        function sidebarCartActionElement(){
            $('.mini-cart-actions').html(`
                <div id="tf-mini-cart-actions-field">

                    <div class="tf-mini-cart-view-checkout">
                        <a href="{{ route('show-cart') }}" class="tf-btn w-100 btn-white radius-4 has-border"><span class="text">View cart</span></a>
                        <a href="{{ route('checkout') }}" class="tf-btn w-100 btn-fill radius-4"><span class="text">Check Out</span></a>
                    </div>

                    <div class="text-center">
                        <a class="link text-btn-uppercase" href="{{ route('product.page') }}">Or continue shopping</a>
                    </div>    
                </div>
            `);
        }

        //__ Cart Count __//
        function getCartCount(){
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.count') }}",
                success: function(data) {
                    console.log(data);
                    if( data.status === 'success' ){
                       $('.count-box').text(data.cartCount);
                    }
                },
                error: function(data) {
                    // console.log('Error adding product to cart:', data);
                },
            });
        }

        //__ Coupon Apply __//
        $(document).on('submit', '.coupon_form', function(e){
            e.preventDefault();
            let formdata = $(this).serialize(); 
            console.log(formdata);

            $.ajax({
                url: "{{ route('apply.coupon') }}",
                method: 'POST',
                data: formdata,
                success: function(data) {
                    console.log(data);
                    if (data.status === 'success') {
                        calculationCouponDiscount();
                        toastr.success(data.message);

                        // Activate the matching discount box
                        const appliedCouponCode = $('input[name="coupon_code"]').val();
                        $('.box-discount').removeClass('active'); 
                        $(`.box-discount.${appliedCouponCode}`).addClass('active'); 
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(err) {
                    console.log(err);
                },
            })
        })

        //__ Calculate Coupon function __//
        function calculationCouponDiscount(){
            $.ajax({
                url: "{{ route('coupon.calculation') }}",
                method: 'GET',
                success: function(data) {
                    // console.log(data.cart_total, data.discount);
                    if( data.status === 'success' ){ 
                        $('.total_discount').text(`${currency_symbol}`+ data.discount);
                        $('.main_cart_total').text(`${currency_symbol}`+ data.cart_total);

                        if( data.discount_type === "percent" ){
                            $('.percent_show').text('(' + data.discount_percent + '%)');
                        }
                        else{
                            $('.percent_show').text('');
                        }

                        // Update shipping cost
                        $('.shipping_amount').text(`${currency_symbol}` + data.shipping_cost);
                    }
                },
                error: function(err) {
                    console.log(err);
                },
            })
        }

        //__ Coupon select function __//
        $(document).on('click', '.tf_btn_discount', function(e){
            e.preventDefault();
            let code = $(this).data('code');
            $('#coupon_codes').val(code);
        })

       //__ Quick View Cart __//
       $('.quickview').click(function (e) {
           e.preventDefault(); // Prevent default behavior if necessary
           var id = $(this).data('id'); // Use `data-id` attribute

           $.ajax({
               type: "GET",
               url: "{{ route('cart.quick.view') }}",
               data: { id: id }, // Pass `id` as a key-value pair
               success: function (res) {
                   // console.log(res); // Handle response
                   var product = res.product;

                   $('#modal_qty').val(1);
                   $('#product_id').val(`${product.id}`);
                   $('#thumb_image').html(res.main_image);
                   $('.prdt_qty').text(`${product.qty}`);
                   $('.product_units').text(`${product.units}`);
                   $('#category_name').text(`${product.cat_name}`);
                   $('#product_name').text(`${product.name}`);
                   $('#sold_product').text(`${product.product_sold}`);
                   $('.tf-product-info-price').html(res.price_val);
                   $('#short_desc').text(`${product.short_description}`);
                   $('#product_view').text(`${product.product_view}`);
                   // $('.total_price').text(`${currency_symbol}` + res.product_price);
                   $('.main_color_variant').removeClass('d-none');
                   $('.main_size_variant').removeClass('d-none');

                   var imagesHtml = '';

                   // Loop through the images array
                   res.multi_images.forEach(function (image) {
                       imagesHtml += `
                           <div class="quickView-item item-scroll-quickview" data-scroll-quickview="beige">
                               <img class="lazyload" data-src="${image}" src="${image}" alt="">
                           </div>
                       `;
                   });

                   $('.multiple_image').html(imagesHtml);


                    if (res.product_color && res.product_color.length > 0) {
                        var colorsHtml = '';

                       // Loop through the product_color array
                       res.product_color.forEach(function (color, index) {
                           colorsHtml += `
                               <div class="">
                                   <input id="color${color.id}" type="radio" data-price="${color.color_price}" name="color_id" value="${color.id}" ${index === 0 ? 'checked' : ''}>
                                   <label class="hover-tooltip tooltip-bot radius-60 color-btn  color_show ${index === 0 ? 'active' : ''}" 
                                       data-slide="0" 
                                       data-price="${color.color_price || ''}" 
                                       for="color${color.id}" 
                                       data-value="${color.color_name}" 
                                       data-scroll-quickview="${color.color_name.toLowerCase()}"
                                       >
                                       <span class="btn-checkbox" style="background-color:${color.color_code || ''}"></span>
                                       <span class="tooltip">${color.color_name} ( ${currency_name} ${color.color_price} )</span>
                                   </label>
                               </div>
                           `;
                       });

                       $('#color_variant').html(colorsHtml);

                       // Dynamically set the first color name in the text-title span
                       var firstColor = res.product_color[0]; // Get the first color
                       $('.text-title.color_variant').text(firstColor.color_name);
                    } else {
                       $('#color_variant').html('');
                       $('.main_color_variant').addClass('d-none');
                    }

                    if (res.product_sizes && res.product_sizes.length > 0) {
                        var sizesHtml = '';

                        // Loop through the product_sizes array
                        res.product_sizes.forEach(function (size, index) {
                            sizesHtml += `
                                <div class="">
                                    <input type="radio" name="size_id" data-price="${size.size_price}" id="size${size.id}" value="${size.id}" ${index === 0 ? 'checked' : ''}>
                                    <label class="hover-tooltip tooltip-bot style-text size-btn" for="size${size.id}" data-value="${size.size_name.toUpperCase()}" data-size-price="${size.size_price}">
                                        <span class="text-title">${size.size_name.toUpperCase()}</span>
                                        <span class="tooltip">${size.size_name} ( ${currency_name} ${size.size_price} )</span>
                                    </label>
                                </div>
                            `;
                        });

                        // Update the size container
                        $('#size_variant').html(sizesHtml);

                        // Dynamically set the first size name in the text-title span
                        var firstSize = res.product_sizes[0]; // Get the first size
                        $('.text-title.size_variant').text(firstSize.size_name.toUpperCase());
                    } else {
                        // Handle the case where no sizes are available
                        $('#size_variant').html('');
                        $('.main_size_variant').addClass('d-none');
                    }
               },
               error: function (err) {
                   console.log(err);
               }
           });
       });

       //__ Quick Add Cart __//
       $('.quickAdd').click(function (e) {
           e.preventDefault(); // Prevent default behavior if necessary
           var id = $(this).data('id'); // Use `data-id` attribute

           $.ajax({
               type: "GET",
               url: "{{ route('cart.quick.view') }}",
               data: { id: id }, // Pass `id` as a key-value pair
               success: function (res) {
                   // console.log(res); // Handle response
                   var product = res.product;

                   $('#quick_add_qty').val(1);
                   $('#quick_product_id').val(`${product.id}`);
                   $('#quick_thumb_image').html(res.main_image);
                   $('.prdt_qty').text(`${product.qty}`);
                   $('.product_units').text(`${product.units}`);
                   $('#quick_product_name').text(`${product.name}`);
                   $('.tf-product-info-price').html(res.price_val);
                   $('.main_color_variant').removeClass('d-none');
                   $('.main_size_variant').removeClass('d-none');

                   if (res.product_color && res.product_color.length > 0) {
                        var colorsHtml = '';

                       // Loop through the product_color array
                       res.product_color.forEach(function (color, index) {
                           colorsHtml += `
                               <div class="mb-2">
                                   <input id="color${color.id}" type="radio" data-price="${color.color_price}" name="color_id" value="${color.id}" ${index === 0 ? 'checked' : ''}>
                                   <label class="hover-tooltip tooltip-bot radius-60 color-btn  color_show ${index === 0 ? 'active' : ''}" 
                                       data-slide="0" 
                                       data-price="${color.color_price || ''}" 
                                       for="color${color.id}" 
                                       data-value="${color.color_name}" 
                                       data-scroll-quickview="${color.color_name.toLowerCase()}"
                                       >
                                       <span class="btn-checkbox" style="background-color:${color.color_code || ''}"></span>
                                       <span class="tooltip">${color.color_name} ( ${currency_name} ${color.color_price} )</span>
                                   </label>
                               </div>
                           `;
                       });

                       $('#quick_color_variant').html(colorsHtml);

                       // Dynamically set the first color name in the text-title span
                       var firstColor = res.product_color[0]; // Get the first color
                       $('.text-title.color_variant').text(firstColor.color_name);
                   } else {
                       $('#color_variant').html('');
                       $('.main_color_variant').addClass('d-none');
                   }
                   

                    if (res.product_sizes && res.product_sizes.length > 0) {
                       var sizesHtml = '';

                       // Loop through the product_sizes array
                       res.product_sizes.forEach(function (size, index) {
                           sizesHtml += `
                               <div class="mb-2">
                                   <input type="radio" name="size_id" data-price="${size.size_price}" id="size${size.id}" value="${size.id}" ${index === 0 ? 'checked' : ''}>
                                   <label class="hover-tooltip tooltip-bot style-text size-btn for="size${size.id}" data-value="${size.size_name.toUpperCase()}" data-size-price="${size.size_price}" >
                                       <span class="text-title">${size.size_name.toUpperCase()}</span>
                                       <span class="tooltip">${size.size_name} ( ${currency_name} ${size.size_price} )</span>
                                   </label>
                               </div>
                           `;
                       });

                       // Update the size container
                       $('#quick_size_variant').html(sizesHtml);

                       // Dynamically set the first size name in the text-title span
                       var firstSize = res.product_sizes[0]; // Get the first size
                       $('.text-title.size_variant').text(firstSize.size_name.toUpperCase());
                   } else {
                       $('#quick_size_variant').html('');
                       $('.main_size_variant').addClass('d-none');
                   }
                   
               },
               error: function (err) {
                   console.log(err);
               }
           });
       });

       // For color select
       $(document).on('click', '.color_show', function () {
           var radioId = $(this).attr('for');
           var $radioInput = $('#' + radioId);

           if ($radioInput.length) {
               $radioInput.prop('checked', true);

               var colorName = $(this).attr('data-value');
               $('.color_variant').text(colorName);

               $('.color_show').removeClass('active');
               $(this).addClass('active');
           }
       });

       // For size select
       $(document).on('click', '.size-btn', function () {
           var radioInput = $(this).prev('input[type="radio"]');
           radioInput.prop('checked', true);

           var selectedSize = $(this).data('value');
           $('.size_variant').text(selectedSize);

           $('.size-btn').removeClass('active');
           $(this).addClass('active');
       });

       // Product add to cart
       $('.add-to-cart-form').on('submit', function(e) {
           e.preventDefault(); 

           // Get the value of the clicked button
           const clickedButton = $('button[type="submit"]:focus');
           const buttonValue = clickedButton.val(); // 'add_cart' or 'buy_now'

           let formData = $(this).serialize() + '&button_value=' + buttonValue;

           $.ajax({
               method: 'POST',
               data: formData,
               url: "{{ route('add.cart') }}",
               success: function(data) {
                   // Handle success
                   if( data.status === 'success' ){
                       // console.log('Product added to cart:', data);
                       sidebarCartData();
                       sidebarCartActionElement();
                       getSidebarCartTotal();
                       getCartCount();
                       toastr.success(data.message);

                       if( data.button_value === "buy_now" ){
                           $('.show-shopping-cart').removeClass('show-shopping-cart');
                           window.location.href = "{{ url('/checkout') }}";
                       }
                       else{
                           // Add the 'show-shopping-cart' class to the clicked button
                           clickedButton.addClass('show-shopping-cart');
                           // Show the modal
                           $('#shoppingCart').modal('show');
                       }
                   }
                   else if( data.status === 'error' ){
                       toastr.error(data.message);
                   }

               },
               error: function(data) {
                   // Handle error
                   // console.log('Error adding product to cart:', data);
                   toastr.error('Failed to add product to cart.');
               },
           });
       });


       $('.quick_view_cart').on('click', function() {
           $('.show-shopping-cart').removeClass('show-shopping-cart');
       });

        // Subscription Form
        $('#newsletter_form').on('submit', function (e) {
            e.preventDefault();
            let data = $(this).serialize(); // Serialize form data

            $.ajax({
                method: 'POST',
                url: "{{ route('newsletter.request') }}",
                data: data, // Send form data, including the CSRF token
                beforeSend: function(){
                    $('#subscription_btn').html("<i class='bx bx-loader-alt'></i>");
                    $('#subscription_btn').addClass('spinners');
                },
                success: function (data) {
                    if (data.status === 'success') {
                        toastr.success(data.message);
                        $('#subscription_btn').html("<i class='bx bx-up-arrow-alt'></i>");
                        $('#subscription_btn').removeClass('spinners');
                        $('.subscribe_input').val('')
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                        $('#subscription_btn').html("<i class='bx bx-up-arrow-alt'></i>");
                        $('#subscription_btn').removeClass('spinners');
                        $('.subscribe_input').val('');
                    }
                },
                error: function (data) {
                    console.log(data);
                    let errors = data.responseJSON?.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                        $('#subscription_btn').html("<i class='bx bx-up-arrow-alt'></i>");
                        $('#subscription_btn').removeClass('spinners');
                    });
                }
            });
        });

        // Wishlist Add 
        $('.wishlist').on('click', function(e){
            e.preventDefault();
            let button = $(this); // Target the specific button clicked
            let productId = button.data('id');
            let cardProduct = button.closest('.wishlist_product');
            let wishlistContainer = $('.wishlist-product-data'); 
            console.log(productId);

            $.ajax({
                method: 'GET',
                url: "{{ route('wishlist.store') }}",
                data: { id: productId },
                success: function (response) {
                    if (response.status === 'added') {
                        toastr.success(response.message);
                        // button.addClass('active');
                        $('.wishlist[data-id="' + productId + '"]').addClass('active');
                        getWishlistCount();
                    } else if (response.status === 'removed') {
                        toastr.info(response.message);
                        $('.wishlist[data-id="' + productId + '"]').removeClass('active');

                        // Remove the specific wishlist product
                        cardProduct.fadeOut(300, function() {
                            $(this).remove();

                            // If wishlist is empty, show the message
                            if (response.wishlist_count === 0) {
                                wishlistContainer.html(`
                                    <div class="tf-grid-layout md-col-12 xl-col-12">
                                        <div class="alert alert-danger text-center no-wishlist-message" role="alert">
                                            There is no wishlist product available
                                        </div>
                                    </div>
                                `);
                            }
                        });
                        getWishlistCount();
                    } else if (response.status === 'error') {
                        window.location.href = '{{ url("/login") }}'
                    }
                },
                error: function (data) {
                    console.log(data);
                    let errors = data.responseJSON?.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                    });
                }
            });
        });

        //__ Wishlist Count __//
        function getWishlistCount(){
            $.ajax({
                method: 'GET',
                url: "{{ route('wishlist.count') }}",
                success: function(data) {
                    console.log(data);
                    if( data.status === 'success' ){
                        $('.wishlist_box').text(data.wishlistCount);
                    }
                },
                error: function(data) {
                    // console.log('Error adding product to cart:', data);
                },
            });
        }

   });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentForm = document.getElementById('payment-form');
        const paymentOptions = document.querySelectorAll('input[name="payment-method"]');
        const payNowButton = document.getElementById('pay-now-button');

        // Ensure the payment form exists before applying event listeners
        if (paymentForm) {
            paymentOptions.forEach(option => {
                option.addEventListener('change', function () {
                    const selectedRoute = this.closest('label').getAttribute('data-payment-route');
                    if (selectedRoute) {
                        paymentForm.setAttribute('action', selectedRoute);
                    }
                });
            });

            payNowButton.addEventListener('click', function (e) {
                const selectedOption = document.querySelector('input[name="payment-method"]:checked');
                if (!selectedOption) {
                    e.preventDefault();
                    // alert('Please select a payment method.');
                    toastr.error('Please select a payment method.');
                }
            });
        } else {
            toastr.error('Payment form element not found.');
        }
    });
</script>

@endpush