@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || Shopping Cart</title>
    <meta name="description" content="{{ getSetting()->meta_description }}">

    <meta property="og:title" content="{{ env('APP_NAME') }} || Shopping Cart">
    <meta property="og:description" content="{{ getSetting()->meta_description ?? 'Default Description' }}">
    <meta property="og:image" content="{{ asset(getSetting()->logo ) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')

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
            <h3 class="heading text-center">Shopping Cart</h3>
            <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                <li><a class="link" href="{{ url('/') }}">Homepage</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="link" href="{{ route('product.page') }}">Shop</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Shopping Cart</li>
            </ul>
        </div>
    </div>
    <!-- /page-title -->

<!-- Section cart -->
<section class="flat-spacing">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                {{-- <div class="tf-cart-sold">
                    <div class="notification-sold bg-surface">
                        <img class="icon" src="{{ asset('public/frontend/images/logo/icon-fire.png') }}" alt="img">
                        <div class="count-text">Your cart will expire in
                            <div class="js-countdown time-count" data-timer="600" data-labels=":,:,:,"></div> minutes! Please checkout now before your items sell out!</div>
                    </div>
                    <div class="notification-progress">
                        <div class="text">Buy <span class="fw-semibold text-primary">$70.00</span> more to get <span class="fw-semibold">Freeship</span></div>
                        <div class="progress-cart">
                            <div class="value" style="width: 0%;" data-progress="50">
                                <span class="round"></span>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <table class="tf-table-page-cart">
                    <thead>
                        <tr class="skeleton">
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th style="white-space: nowrap;">Total Price</th>
                            <th>
                                <button class="tf-btn-clear" id="clear_cart">
                                    <span class="text">Clear All</span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="cart-table-body">
                        @forelse ($cartItems as $row)
                            @php
                                $totalPrice = ($row->price + ($row->options->size_price ?? 0) + ($row->options->color_price ?? 0)) * $row->qty;
                            @endphp

                            <tr class="tf-cart-item file-delete" id="remove-{{ $row->rowId }}">
                                <td class="tf-cart-item_product">
                                    <a href="{{ route('product.details', $row->options->slug) }}" class="img-box skeleton">
                                        <img src="{{ asset($row->options->image) }}" alt="{{ $row->options->slug }}">
                                    </a>
                                    
                                    <div class="cart-info">
                                        <a href="{{ route('product.details', $row->options->slug) }}" class="cart-title link skeleton">{{ $row->name }}</a>
                                        <div class="variant-box">
                                            <div class="tf-select">
                                                <div class="product_variant skeleton">
                                                    Color : {{ strtoupper($row->options->color_name) }} ( {{ getSetting()->currency_symbol}}{{ $row->options->color_price ?? 0 }} )
                                                </div>
                                                {{-- <select>
                                                    <option selected="selected">Blue</option>
                                                    <option>Black</option>
                                                    <option>White</option>
                                                    <option>Red</option>
                                                    <option>Beige</option>
                                                    <option>Pink</option>
                                                </select> --}}
                                            </div>
                                            <div class="tf-select">
                                                <div class="product_variant skeleton">
                                                    Size : {{ strtoupper($row->options->size_name) }} ( {{ getSetting()->currency_symbol}}{{ $row->options->size_price ?? 0 }} )
                                                </div>
                                                {{-- <select>
                                                    <option selected="selected">XL</option>
                                                    <option>XS</option>
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                    <option>XL</option>
                                                    <option>2XL</option>
                                                </select> --}}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td data-cart-title="Price" class="tf-cart-item_price text-center">
                                    <div class="cart_price text-button price_on_sale skeleton">{{ getSetting()->currency_symbol}}{{ $row->price }}</div>
                                </td>

                                <td data-cart-title="Quantity" class="tf-cart-item_quantity">
                                    <div class="wg-quantity mx-md-auto skeleton">
                                        <span class="btn-quantity product-decrease">-</span>
                                        <input type="text" name="number" class="product_quantity" data-row_id="{{ $row->rowId }}" value="{{ $row->qty }}">
                                        <span class="btn-quantity product-increase">+</span>
                                    </div>
                                </td>
                                <td data-cart-title="Total" class="tf-cart-item_total text-center">
                                    <div id="{{ $row->rowId }}" class="skeleton cart_total text-button total_price">{{ getSetting()->currency_symbol}}{{ $totalPrice }}</div>
                                </td>
                                <td class="remove-cart remove_item_alignemnt" id="remove_cart">
                                    <span class="skeleton">
                                        <i class='icon bx skeleton bx-x icon-close-popup remove_product_cart' style="font-size: 20px;" data-id="{{ $row->rowId }}"></i>
                                    </span>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-danger text-center skeleton" role="alert">
                                    <p class="mb-3">There is no cart item</p>
                                    <a href="{{ route('checkout') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="tf-select mb-3">
                            <label for="" class="mb-2 skeleton">Delivery Charge</label>
                            <div class="skeleton">
                                <select class="text-title " id="shippingRules" style="border-radius: 8px;">
                                    <option value="{{ getSetting()->inside_city }}" {{ session('shippingCost') == getSetting()->inside_city ? 'selected' : '' }}>InSide Dhaka ( {{ getSetting()->currency_symbol}}{{ getSetting()->inside_city }} )</option>
                                    <option value="{{ getSetting()->outside_city }}" {{ session('shippingCost') ==  getSetting()->outside_city ? 'selected' : '' }}>OutSide Dhaka ( {{ getSetting()->currency_symbol }}{{ getSetting()->outside_city }} )</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

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

                <div class="whole_discount_container">
                    <div class="group-discount skeleton">

                        @if ( getCartTotal() > 0 )
                            @foreach ($coupons as $item)
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
                            @endforeach
                        @endif

                    {{-- <div class="box-discount active">
                        <div class="discount-top">
                            <div class="discount-off">
                                <div class="text-caption-1">Discount</div>
                                <span class="sale-off text-btn-uppercase">10% OFF</span>
                            </div>
                            <div class="discount-from">
                                <p class="text-caption-1">For all orders <br> from 200$</p>
                            </div>
                        </div>
                        <div class="discount-bot">
                            <span class="text-btn-uppercase">Mo234231</span>
                            <button class="tf-btn"><span class="text">Apply Code</span></button>
                        </div>
                    </div>

                    <div class="box-discount">
                        <div class="discount-top">
                            <div class="discount-off">
                                <div class="text-caption-1">Discount</div>
                                <span class="sale-off text-btn-uppercase">10% OFF</span>
                            </div>
                            <div class="discount-from">
                                <p class="text-caption-1">For all orders <br> from 200$</p>
                            </div>
                        </div>
                        <div class="discount-bot">
                            <span class="text-btn-uppercase">Mo234231</span>
                            <button class="tf-btn"><span class="text">Apply Code</span></button>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>


            <div class="col-xl-4">
                <div class="fl-sidebar-cart">
                    <div class="box-order bg-surface">
                        <h5 class="title skeleton">Order Summary</h5>
                        <div class="skeleton subtotal text-button d-flex justify-content-between align-items-center">
                            <span>Subtotal</span>
                            <span class="subTotal">{{ getSetting()->currency_symbol }}{{ getCartTotal() }}</span>
                        </div>

                        <div class="skeleton discount text-button d-flex justify-content-between align-items-center">
                            <span>(-) Discounts
                                <code class="percent_show">
                                    @if ( Session::has('coupon') && Session::get('coupon')['discount_type'] === "percent")
                                        ({{ Session::get('coupon')['discount'] }}%)
                                    @endif
                                </code>
                            </span>

                            <span class="skeleton total_discount">
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

                        <div class="skeleton subtotal text-button d-flex justify-content-between align-items-center">
                            {{-- <span>(+) Shipping</span> --}}
                            <span>(+) Delivery Charge</span>
                            <span class="shipping_amount">
                                @if ( Session::has('shippingCost') && Session::get('shippingCost'))
                                    {{ getSetting()->currency_symbol }}{{ Session::get('shippingCost') }}
                                @else
                                    {{ getSetting()->currency_symbol }}0
                                @endif
                            </span>
                        </div>

                        {{-- <div class="subtotal text-button d-flex justify-content-between align-items-center">
                            <span>(-)Tax</span>
                            <span class="tax">{{ getSetting()->currency_symbol }}0</span>
                        </div> --}}

                        {{-- <div class="ship">
                            <span class="text-button">(-) Shipping</span>
                            <div class="flex-grow-1">
                                <fieldset class="ship-item">
                                    <input type="radio" name="ship-check" class="tf-check-rounded" id="free" checked>
                                    <label for="free">
                                        <span>Free Shipping</span>
                                        <span class="price">{{ getSetting()->currency_symbol }}0.00</span>
                                    </label>
                                </fieldset>
                                <fieldset class="ship-item">
                                    <input type="radio" name="ship-check" class="tf-check-rounded" id="local">
                                    <label for="local">
                                        <span>Local:</span>
                                        <span class="price">{{ getSetting()->currency_symbol }}35.00</span>
                                    </label>
                                </fieldset>
                                <fieldset class="ship-item">
                                    <input type="radio" name="ship-check" class="tf-check-rounded" id="rate">
                                    <label for="rate">
                                        <span>Flat Rate:</span>
                                        <span class="price">{{ getSetting()->currency_symbol }}35.00</span>
                                    </label>
                                </fieldset>
                            </div>
                        </div> --}}

                        <h5 class="skeleton total-order d-flex justify-content-between align-items-center">
                            <span>Total</span>
                            <span class="main_cart_total">{{ getSetting()->currency_symbol }}{{ getMainCartTotal() }}</span>
                        </h5>

                        <div class="box-progress-checkout mt-5">
                            {{-- <fieldset class="check-agree">
                                <input type="checkbox" id="check-agree" class="tf-check-rounded">
                                <label for="check-agree">
                                    I agree with the <a href="term-of-use.html">terms and conditions</a>
                                </label>
                            </fieldset> --}}
                            <a href="{{ route('checkout') }}" class="skeleton tf-btn btn-reset">Process To Checkout</a>
                            <a href="{{ route('product.page') }}" class="skeleton text-button text-center">Or continue shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Section cart -->

<!-- Recent product -->
<section class="flat-spacing pt-0">
    <div class="container">
        <div class="heading-section text-center wow fadeInUp">
            <h5 class="skeleton heading">You may also like</h5>
        </div>
        <div dir="ltr" class="swiper tf-sw-recent" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
            <div class="swiper-wrapper">

                @foreach ($products as $row)
                    @php
                        $wishlistItems = App\Models\Wishlist::where('user_id', auth()->id())->pluck('product_id')->toArray();
                    @endphp
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card-product-wrapper">
                                <a href="{{ route('product.details', $row->slug) }}" class="product-img skeleton">
                                    <img class="lazyload img-product" data-src="{{ asset($row->thumb_image) }}" src="{{ asset($row->thumb_image) }}" alt="{{ $row->slug }}">

                                    @php
                                        $image = App\Models\ProductImage::where('product_id', $row->id)->first();

                                        $discount = '';
                                        if( checkDiscount($row) ){
                                            if ( !empty($row->discount_type === "amount" ) ){
                                                $discount = '-'. $row->discount_value . "Tk";
                                            }   
                                            else if( $row->discount_type === "percent" ){
                                                $discount = '-'. $row->discount_value . "%";
                                            }
                                        }
                                    @endphp

                                    @if (!empty($image))
                                        <img class="lazyload img-hover" data-src="{{ asset($image->images) }}" src="{{ asset($image->images) }}" alt="{{ $row->slug }}">
                                    @endif
                                </a>
                                <div class="on-sale-wrap">
                                    <span class="on-sale-item">
                                        {{ $discount }}
                                    </span>
                                </div>

                                @if ( checkDiscount($row) )
                                    @if ( !empty($row->discount_type === "amount") || !empty($row->discount_type === "percent") )
                                        <div class="marquee-product bg-main">
                                            <div class="marquee-wrapper">
                                                <div class="initial-child-container">
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="marquee-wrapper">
                                                <div class="initial-child-container">
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <p class="font-2 text-btn-uppercase fw-6 text-white">Hot Sale {{ $discount }} OFF</p>
                                                    </div>
                                                    <div class="marquee-child-item">
                                                        <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <div class="list-product-btn">
                                    <a href="javascript:void(0);" class="box-icon wishlist btn-icon-action {{ in_array($row->id, $wishlistItems) ? 'active' : '' }}" data-id="{{ $row->id }}">
                                        <i class='bx bx-heart' style="font-size: 24px;"></i>
                                        <span class="tooltip">Wishlist</span>
                                    </a>

                                    {{-- <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare" class="box-icon compare btn-icon-action">
                                        <i class='bx bx-git-compare' style="font-size: 24px;"></i>
                                        <span class="tooltip">Compare</span>
                                    </a> --}}
                                    <a href="#quickView" data-id={{ $row->id }} data-bs-toggle="modal" class="box-icon quickview tf-btn-loading">
                                        <ion-icon name="eye-outline" style="font-size: 24px;"></ion-icon>
                                        <span class="tooltip">Quick View</span>
                                    </a>
                                </div>
                                <div class="list-btn-main">
                                    <a href="#quickAdd" data-id={{ $row->id }} data-bs-toggle="modal" class="btn-main-product quickAdd">Quick Order</a>
                                </div>
                            </div>

                            @php
                                $avgRatings = App\Models\ProductReview::where('product_id', $row->id)->where('status', 1)->avg('ratings');
                                $reviews = App\Models\ProductReview::where('product_id', $row->id)->where('status', 1)->count();
                            @endphp

                            <div class="card-product-info">
                                <a href="{{ route('product.details', $row->slug) }}" class="title link skeleton">{{ $row->name }}</a>
                                <div class="box-rating">
                                    <ul class="list-star skeleton">
                                        @for ( $i = 1; $i <= 5; $i++ )
                                            @if ( $i <= round($avgRatings))
                                                <li class="bx bxs-star" style="color: #F0A750;"></li>
                                            @else
                                                <li class="bx bx-star" style="color: #F0A750;"></li>
                                            @endif
                                        @endfor
                                    </ul>
                                    <span class="text-caption-1 text-secondary skeleton">({{ $reviews }} )</span>
                                </div>

                                @if ( checkDiscount($row) )
                                    @if ( !empty($row->discount_type === "amount") )
                                        <span class="price"><span class="old-price skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span> <span class="skeleton">
                                            {{ getSetting()->currency_symbol }}{{ $row->selling_price - $row->discount_value }}</span></span>
                                    @elseif( !empty($row->discount_type === "percent") )
                                    @php
                                        $discount_val = $row->selling_price * $row->discount_value / 100;
                                    @endphp
                                        <span class="price"><span class="old-price skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span> <span class="skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price - $discount_val }}</span></span>
                                    @else
                                        <span class="price "><span class="skeleton"> {{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span></span>
                                    @endif
                                @else
                                    <span class="price "> <span class="skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span></span>
                                @endif

                                {{-- <div class="box-progress-stock">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="stock-status d-flex justify-content-between align-items-center">
                                        <div class="stock-item text-caption-1">
                                            <span class="stock-label text-secondary-2">Stock:</span>
                                            <span class="stock-value">{{ $row->qty }}</span>
                                        </div>
                                        <div class="stock-item text-caption-1">
                                            <span class="stock-label text-secondary-2">Sold:</span>
                                            <span class="stock-value">{{ $row->product_sold }}</span>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
        </div>
    </div>
</section>
<!-- /Recent product -->

@endsection

@push('add-js')

<script>
    $(document).ready(function(){
        var currency_symbol = "{{ getSetting()->currency_symbol }}";
        var currency_name   = "{{ getSetting()->currency_name }}";
        
        //__ Product Quantity Increament __//
        $('.product-increase').on('click', function(){
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
                        $(productId).text(`${currency_symbol}` + data.productTotal);
                        calculationCouponDiscount();
                        sidebarCartData();
                        getSidebarCartTotal();
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
        $('.product-decrease').on('click', function(){
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
                        $(productId).text(`${currency_symbol}` + data.productTotal);
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
        $(document).on('click', '.remove_product_cart', function(e) {
            e.preventDefault();
            let id = $(this).data('id');    
            // console.log(id); 

            $.ajax({
                url: "{{ url('/cart/remove-product') }}/" + id,
                method: 'GET',
                dataType: 'json',
                data: { id: id },
                success: function(data) {
                    // console.log(data);
                    if( data.status === 'success' ){ 
                        calculationCouponDiscount();
                        getSidebarCartTotal();
                        let singleProductRemove = '#remove-' +id;
                        $(singleProductRemove).remove();

                        // Check if the table is empty and display the message
                        const tableBody = $('#cart-table-body');
                        if (tableBody.children('tr.tf-cart-item').length === 0) {
                            tableBody.html(`
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-danger text-center" role="alert" style="margin: 0 24px;">
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
        })

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
                            $('.tf-mini-cart-threshold').remove();
                            $('#tf-mini-cart-actions-field').remove();
                            $('#coupon_codes').val('');
                            $('.group-discount').remove();
                        }
                        calculationCouponDiscount(); 
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


        // Fetch all cart data from Sidebar
        function sidebarCartData(){
            $.ajax({
                method: 'GET',
                url: "{{ route('get.sidebar.cart') }}",
                success: function(response) {
                    if (response.status === true) {
                        let cartHtml = '';

                        // If cart is empty, show error message
                        if (response.isEmpty) {
                            cartHtml = `
                                <div class="alert alert-danger text-center" role="alert" style="margin: 0 24px;">
                                    <p class="mb-3">No items in the cart. </p>
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
                    }
                },
                error: function(err) {
                    toastr.error('Failed to fetch cart data.');
                    console.log(err);
                }
            });
        }

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


        //__ Fetch all cart data for Cart Page __//
        function CartPageData() {
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
                                            <a href="{{ route('product.page') }}" class="tf-btn btn-reset">Continue Shopping</a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        } else {
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
                    // console.log('get total', data);
                    if( data.status === 'success' ){
                        console.log('kaj kore subtotal')
                       $('.tf-totals-total-value').text(`${currency_symbol}` + data.total);
                       $('.subTotal').text(`${currency_symbol}` + data.total);
                    }
                },
                error: function(data) {
                    console.log('Error adding product to cart:', data);
                },
            });
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
                   $('#category_name').text(`${product.cat_name}`);
                   $('#product_name').text(`${product.name}`);
                   $('.prdt_qty').text(`${product.qty}`);
                   $('.product_units').text(`${product.units}`);
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
                                   <label class="hover-tooltip tooltip-bot style-text size-btn for="size${size.id}" data-value="${size.size_name.toUpperCase()}" data-size-price="${size.size_price}" >
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
                   $('.prdt_qty').text(`${product.qty}`);
                   $('.product_units').text(`${product.units}`);
                   $('#quick_thumb_image').html(res.main_image);
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

@endpush