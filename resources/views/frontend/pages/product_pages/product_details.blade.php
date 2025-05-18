@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || {{ $product->slug }}</title>
    <meta name="description" content="{{ $product->short_description }}">

    <meta property="og:title" content="{{ $product->name ?? 'Default Title' }}">
    <meta property="og:description" content="{{ $product->short_description ?? 'Default Description' }}">
    <meta property="og:image" content="{{ asset($product->thumb_image) }}">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/drift-basic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/photoswipe.css') }}">
@endpush


@section('body-content')

 <!-- breadcrumb -->
 <div class="tf-breadcrumb">
    <div class="container">
        <div class="tf-breadcrumb-wrap">
            <div class="tf-breadcrumb-list skeleton">
                <a href="{{ route('home') }}" class="text text-caption-1">Homepage</a>
                <i class='bx bx-chevron-right'></i>
                <a href="{{ route('product.page', ['categories' => $product->cat_slug]) }}" class="text text-caption-1">{{ $product->cat_name }}</a>
                <i class='bx bx-chevron-right'></i>
                <span class="text text-caption-1">{{ $product->slug }}</span>
            </div>
        </div>
    </div>
</div>
<!-- /breadcrumb -->


{{-- <!-- tf-add-cart-success -->
<div class="tf-add-cart-success">
    <div class="tf-add-cart-heading">
        <h5>Shopping Cart</h5>
        <i class="icon icon-close tf-add-cart-close"></i>
    </div>
    <div class="tf-add-cart-product">
        <div class="image">
            <img class=" ls-is-cached lazyloaded" data-src="{{ asset('public/frontend/images/products/womens/women-3.jpg') }}" alt="" src="{{ asset('public/frontend/images/products/womens/women-3.jpg') }}">
        </div>
        <div class="content">
            <div class="text-title">
                <a class="link" href="product-detail.html">Biker-style leggings</a>
            </div>
            <div class="text-caption-1 text-secondary-2">Green, XS, Cotton</div>
            <div class="text-title">$68.00</div>
        </div>
    </div>
    <a href="shopping-cart.html" class="tf-btn w-100 btn-fill radius-4"><span class="text text-btn-uppercase">View cart</span></a>
</div>
<!-- /tf-add-cart-success --> --}}


<!-- Product_Main -->
<section class="flat-spacing">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <!-- Product default -->
                <div class="col-md-6">
                    <div class="tf-product-media-wrap sticky-top">
                        <div class="thumbs-slider">
                            <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                                <div class="swiper-wrapper stagger-wrap">
                                    <div class="swiper-slide stagger-item">
                                        <div class="item">
                                            <img class="lazyload" data-src="{{ asset($product->thumb_image) }}" src="{{ asset($product->thumb_image) }}" alt="{{ $product->slug }}">
                                        </div>
                                    </div>

                                    @foreach ($product_images as $row)
                                        <div class="swiper-slide stagger-item">
                                            <div class="item">
                                                <img class="lazyload" data-src="{{ asset($row->images) }}" src="{{ asset($row->images) }}" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                <div class="swiper-wrapper">

                                    <div class="swiper-slide" >
                                        <a href="{{ asset($product->thumb_image) }}" target="_blank" class="item skeleton" data-pswp-width="600px" data-pswp-height="800px">
                                            <img class="tf-image-zoom lazyload" data-zoom="{{ asset($product->thumb_image) }}" data-src="{{ asset($product->thumb_image) }}" src="{{ asset($product->thumb_image) }}" alt="{{ $product->slug }}">
                                        </a>
                                    </div>

                                    @foreach ($product_images as $row)
                                        <div class="swiper-slide" >
                                            <a href="{{ asset($row->images) }}" target="_blank" class="item skeleton" data-pswp-width="600px" data-pswp-height="800px">
                                                <img class="tf-image-zoom lazyload" data-zoom="{{ asset($row->images) }}" data-src="{{ asset($row->images) }}" src="{{ asset($row->images) }}" alt="">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /Product default -->

                <!-- tf-product-info-list -->
                <div class="col-md-6">
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-zoom-main"></div>
                        <div class="tf-product-info-list other-image-zoom">
                            <div class="tf-product-info-heading">
                                <div class="tf-product-info-name">
                                    <a href="{{ route('product.page', ['categories' => $product->cat_slug]) }}" class="text skeleton text-btn-uppercase mb-2" style="text-transform: uppercase;font-size: 16px;">{{ $product->cat_name }}</a>
                                    <h3 class="name skeleton">{{ $product->name }}</h3>
                                    <div class="sub">
                                        <div class="tf-product-info-rate skeleton">
                                            <div class="list-star">
                                                @php
                                                    $avgRatings = App\Models\ProductReview::where('product_id', $product->id)->where('status', 1)->avg('ratings');
                                                    $reviews = App\Models\ProductReview::where('product_id', $product->id)->where('status', 1)->count();
                                                @endphp

                                                @for ( $i = 1; $i <= 5; $i++ )
                                                    @if ( $i <= round($avgRatings))
                                                        <li class="bx bxs-star" style="color: #F0A750;"></li>
                                                    @else
                                                        <li class="bx bx-star" style="color: #F0A750;"></li>
                                                    @endif
                                                @endfor
                                            </div>
                                            <div class="text text-caption-1">({{ $reviews }} reviews)</div>
                                        </div>

                                        {{-- <div class="tf-product-info-sold">
                                            <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                            <div class="text text-caption-1">{{ $product->product_sold }} product sold</div>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="tf-product-info-desc">
                                    <div class="tf_product_info_price">
                                        @if ( checkDiscount($row) )
                                            @if ( $product->discount_type === "amount" )
                                                <h5 class="price_on_sale font-2 me-2">{{ getSetting()->currency_symbol }}{{ $product->selling_price - $product->discount_value }}</h5>
                                                <div class="compare-at-price font-2">{{ getSetting()->currency_symbol }}{{ $product->selling_price }}</div>
                                                <div class="badges-on-sale text-btn-uppercase">
                                                    -{{ getSetting()->currency_symbol }}{{ $product->discount_value }}
                                                </div>

                                            @elseif( $product->discount_type === "percent" )
                                                @php
                                                    $discount_val = $product->selling_price * $product->discount_value / 100;
                                                @endphp

                                                <h5 class="price_on_sale font-2 me-2 skeleton">{{ getSetting()->currency_symbol }}{{ $product->selling_price - $discount_val }}</h5>
                                                <div class="compare-at-price font-2 skeleton">{{ getSetting()->currency_symbol }}{{ $product->selling_price }}</div>
                                                <div class="badges-on-sale text-btn-uppercase skeleton">
                                                    -{{ $product->discount_value }}%
                                                </div>
                                            @else
                                                <h5 class="price_on_sale font-2 skeleton">{{ getSetting()->currency_symbol }}{{ $product->selling_price }}</h5>
                                            @endif
                                        @else
                                            <h5 class="price_on_sale font-2 skeleton"> {{ getSetting()->currency_symbol }}{{ $product->selling_price }}</h5>
                                        @endif
                                    </div>

                                    {{-- <p>{{ $product->short_description }}</p> --}}
                                    <div class="tf-product-info-liveview skeleton">
                                        <ion-icon name="eye-outline" style="font-size: 24px;"></ion-icon>
                                        <p class="text-caption-1"><span class="liveview-count">{{ $product->product_view }}</span> people are viewing this right now</p>
                                    </div>
                                </div>
                            </div>

                            <div class="tf-product-info-choose-option">
                                <form class="add-to-cart-form">
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    @if ( $product_colors->count() > 0 )
                                        <div class="variant-picker-item skeleton">
                                            <div class="variant-picker-label mb_12 skeleton">
                                                Colors:<span class="text-title color_variant variant-picker-label-value value-currentColor">{{ $product_colors[0]->color_name }}</span>
                                            </div>

                                            <div class="variant-picker-values mb-3">
                                                @foreach ($product_colors as $index => $row)
                                                    <input id="color{{ $row->id }}" type="radio" name="color_id" value="{{ $row->id }}" data-price="{{ $row->color_price }}" {{ $index === 0 ? 'checked' : '' }}>
                                                    <label for="color{{ $row->id }}" class="hover-tooltip tooltip-bot radius-60 color-btns main_color_show {{ $index == 0 ? 'active' : '' }}" 
                                                        data-value="{{ $row->color_name }}">
                                                        <span class="btn-checkbox" style="background-color:{{ $row->color_code }}"></span>
                                                        <span class="tooltip">{{ $row->color_name }} ( {{ getSetting()->currency_name }} {{ $row->color_price }} )</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ( $product_sizes->count() > 0 )
                                        <div class="variant-picker-item skeleton">
                                            <div class="d-flex justify-content-between mb_12">
                                                <div class="variant-picker-label">
                                                    Size:<span class="text-title size_variant variant-picker-label-value">{{ $product_sizes[0]->size_name }}</span>
                                                </div>
                                                {{-- <a href="#size-guide" data-bs-toggle="modal" class="size-guide text-title link">Size Guide</a> --}}
                                            </div>

                                            <div class="variant-picker-values gap12">
                                                @foreach ($product_sizes as $index => $row)
                                                    <input type="radio" name="size_id" data-price="{{ $row->size_price }}" id="size{{ $row->id }}" value="{{ $row->id }}" {{ $index === 0 ? 'checked' : '' }}>

                                                    <label class="hover-tooltip tooltip-bot style-text main_size_btn" 
                                                        for="size{{ $row->id }}" 
                                                        data-value="{{ $row->size_name }}" 
                                                        data-size-price="{{ $row->size_price }}" >
                                                        <span class="text-title">{{ strtoupper($row->size_name) }}</span>
                                                        <span class="tooltip">{{ strtoupper($row->size_name) }} ( {{ getSetting()->currency_name }}{{ $row->size_price }} )</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    <div class="tf-product-info-quantity">
                                        <div class="title mb_12 mt-4 skeleton">Quantity: 
                                            @if ( $product->qty > 0 )
                                                <span class="badge bg-success">Available Stock</span>
                                            @else
                                                <span class="badge bg-danger">Stock Out</span>
                                            @endif
                                        </div>
                                        <div class="wg-quantity skeleton">
                                            <span class="btn-quantity btn-decrease">-</span>
                                            <input class="quantity-product" type="text" name="qty" value="1">
                                            <span class="btn-quantity btn-increase">+</span>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="tf-product-info-by-btn mb_10">
                                            <button type="submit" name="button" value="add_cart" class="btn-style-2 skeleton flex-grow-1 text-btn-uppercase fw-6 ">
                                                <span>Add to cart</span> -
                                                <span class="tf-qty-price total_price">{{ getSetting()->currency_symbol }} 79.99</span>
                                            </button>

                                            {{-- <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare" class="box-icon hover-tooltip compare btn-icon-action show-compare">
                                                <i class='bx bx-git-compare' style="font-size: 24px;"></i>
                                                <span class="tooltip text-caption-2">Compare</span>
                                            </a> --}}

                                            @php
                                                $wishlistItems = App\Models\Wishlist::where('user_id', auth()->id())->pluck('product_id')->toArray();
                                            @endphp

                                            <a href="javascript:void(0);" class="box-icon hover-tooltip skeleton text-caption-2 wishlist btn-icon-action {{ in_array($row->id, $wishlistItems) ? 'active' : '' }}" data-id="{{ $row->id }}">
                                                <i class='bx bx-heart' style="font-size: 24px;"></i>
                                                <span class="tooltip text-caption-2">Wishlist</span>
                                            </a>
                                        </div>
                                        <button type="submit" name="button" value="buy_now" class="fw-6 buy_now_btn btn-style-3 skeleton text-btn-uppercase">Buy it now</button>

                                        <div class="btn_direct_contact">
                                            <a href="{{ getSetting()->phone }}" name="button" class="fw-6 mt-2 preOrder_btn skeleton"><i class='bx bx-phone-call' ></i> Preorder- {{ getSetting()->whatsapp }}</a>

                                            <a href="{{ getSetting()->whatsapp }}" name="button" value="buy_now" class="fw-6 skeleton mt-2 whatsapp_btn"><i class='bx bxl-whatsapp'></i> Whatsapp - {{ getSetting()->whatsapp }}</a>
                                        </div>
                                    </div>
                                </form>

                                <div class="tf-product-info-help">
                                    {{-- <div class="tf-product-info-extra-link">
                                        <a href="#delivery_return" data-bs-toggle="modal" class="tf-product-extra-icon">
                                            <div class="icon">
                                                <i class='bx bxs-truck'></i>
                                            </div>
                                            <p class="text-caption-1">Delivery & Return</p>
                                        </a>

                                        <!-- modal delivery_return -->
                                        <div class="modal modalCentered fade tf-product-modal modal-part-content" id="delivery_return" style="z-index: 1060; display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="header">
                                                        <div class="demo-title">Shipping &amp; Delivery</div>
                                                        <i class='bx bx-x icon-close-popup quick_view_cart' style="font-size: 32px;" data-bs-dismiss="modal"></i>
                                                    </div>
                                                    <div class="overflow-y-auto">
                                                        <div class="tf-product-popup-delivery">
                                                            <div class="title">Delivery</div>
                                                            <p class="text-paragraph">All orders shipped with UPS Express.</p>
                                                            <p class="text-paragraph">Always free shipping for orders over US $250.</p>
                                                            <p class="text-paragraph">All orders are shipped with a UPS tracking number.</p>
                                                        </div>
                                                        <div class="tf-product-popup-delivery">
                                                            <div class="title">Returns</div>
                                                            <p class="text-paragraph">Items returned within 14 days of their original shipment date in same
                                                                as new condition will be eligible for a full refund or store credit.</p>
                                                            <p class="text-paragraph">Refunds will be charged back to the original form of payment used for
                                                                purchase.</p>
                                                            <p class="text-paragraph">Customer is responsible for shipping charges when making returns and
                                                                shipping/handling fees of original purchase is non-refundable.</p>
                                                            <p class="text-paragraph">All sale items are final purchases.</p>
                                                        </div>
                                                        <div class="tf-product-popup-delivery">
                                                            <div class="title">Help</div>
                                                            <p class="text-paragraph">Give us a shout if you have any other questions and/or concerns.</p>
                                                            <p class="text-paragraph">Email: <a href="mailto:contact@domain.com"><span class="__cf_email__">contact@domain.com</span></a></p>
                                                            <p class="text-paragraph mb-0">Phone: +1 (23) 456 789</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /modal delivery_return -->


                                        <a href="#ask_question" data-bs-toggle="modal" class="tf-product-extra-icon">
                                            <div class="icon">
                                                <i class='bx bx-question-mark'></i>
                                            </div>
                                            <p class="text-caption-1">Ask A Question</p>
                                        </a>



                                    </div> --}}

                                    {{-- <div class="tf-product-info-time">
                                        <div class="icon">
                                            <i class='bx bx-time-five'></i>
                                        </div>
                                        <p class="text-caption-1">Estimated Delivery:&nbsp;&nbsp;<span>12-26 days</span> (International), <span>3-6 days</span> (United States)</p>
                                    </div>
                                    
                                    <div class="tf-product-info-return">
                                        <div class="icon">
                                            <i class='bx bx-refresh'></i>
                                        </div>
                                        <p class="text-caption-1">Return within <span>45 days</span> of purchase. Duties & taxes are non-refundable.</p>
                                    </div> --}}

                                    {{-- Store Location --}}
                                    <div class="dropdown dropdown-store-location d-flex align-items-center gap-3">
                                        {{-- <div class="dropdown-title dropdown-backdrop" data-bs-toggle="dropdown" aria-haspopup="true">
                                            <div class="tf-product-info-view link">
                                                <div class="icon">
                                                    <i class='bx bx-map'></i>
                                                </div>
                                                <span>View Store Information</span>
                                            </div>
                                        </div>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <div class="dropdown-content">
                                                <div class="dropdown-content-heading">
                                                    <h5>Store Location</h5>
                                                    <i class='bx bx-x icon-close-popup quick_view_cart' style="font-size: 32px;" data-bs-dismiss="modal"></i>
                                                </div>
                                                <div class="line-bt"></div>
                                                <div>
                                                    <h6>Fashion Modave</h6>
                                                    <p>Pickup available. Usually ready in 24 hours</p>
                                                </div>
                                                <div>
                                                    <p>766 Rosalinda Forges Suite 044,</p>
                                                    <p>Gracielahaven, Oregon</p>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <a href="#share_social" data-bs-toggle="modal" class="tf-product-extra-icon d-flex align-items-center gap-1 skeleton">
                                            <div class="icon">
                                                <i class='bx bx-share-alt' ></i>
                                            </div>
                                            <p class="text-caption-1">Share</p>
                                        </a>

                                        <!-- modal share social -->
                                        <div class="modal modalCentered fade tf-product-modal modal-part-content" id="share_social" style="z-index: 1060; display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="header">
                                                        <div class="demo-title">Share</div>
                                                        <i class='bx bx-x icon-close-popup quick_view_cart' style="font-size: 32px;" data-bs-dismiss="modal"></i>
                                                    </div>

                                                    <div class="overflow-y-auto">
                                                        <ul class="tf-social-icon d-flex gap-10">
                                                            {!! $socialLinks !!}
                                                        </ul>

                                                        <form class="form-share" method="post" accept-charset="utf-8">
                                                            <fieldset>
                                                                <input type="text" value="{{ url()->current() }}" tabindex="0" id="copytext" aria-required="true" readonly>
                                                            </fieldset>
                                                            <div class="button-submit">
                                                                <button class="tf-btn radius-4 btn-fill" onclick="copyUrl()" type="button"><span class="text">Copy</span></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /modal share social -->
                                    </div>

                                </div>
                                <ul class="tf-product-info-sku">
                                    <li class="skeleton">
                                        <p class="text-caption-1">SKU:</p>
                                        <p class="text-caption-1 text-1">{{ $product->sku }}</p>
                                    </li>
                                    {{-- <li>
                                        <p class="text-caption-1">Vendor:</p>
                                        <p class="text-caption-1 text-1">Modave</p>
                                    </li> --}}
                                    {{-- <li>
                                        <p class="text-caption-1">Available:</p>
                                        <p class="text-caption-1 text-1">
                                            @if ( $product->qty > 0 )
                                                <span class="text-success">Stock in</span>
                                            @else
                                                <span class="text-danger">Stock Out</span>
                                            @endif
                                        </p>
                                    </li> --}}
                                    <li class="skeleton">
                                        <p class="text-caption-1">Categories:</p>
                                        <p class="text-caption-1">
                                            @foreach (App\Models\Category::get() as $row)
                                                <a href="#" class="text-1 link">{{ $row->category_name }}</a>, 
                                            @endforeach
                                            {{-- <a href="#" class="text-1 link">women</a>, 
                                            <a href="#" class="text-1 link">T-shirt</a></p> --}}
                                    </li>
                                </ul>

                                {{-- <div class="tf-product-info-guranteed">
                                    <div class="text-title">
                                        Guranteed safe checkout:
                                    </div>
                                    <div class="tf-payment">
                                        <a href="#">
                                            <img src="{{ asset('public/frontend/images/payment/img-1.png') }}" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('public/frontend/images/payment/img-2.png') }}" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('public/frontend/images/payment/img-3.png') }}" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('public/frontend/images/payment/img-4.png') }}" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('public/frontend/images/payment/img-5.png') }}" alt="">
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('public/frontend/images/payment/img-6.png') }}" alt="">
                                        </a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /tf-product-info-list -->
            </div>
        </div>
    </div>


    {{-- <div class="tf-sticky-btn-atc">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form class="form-sticky-atc">
                        <div class="tf-sticky-atc-product">
                            <div class="image">
                                <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-3.jpg') }}" alt="" src="{{ asset('public/frontend/images/products/womens/women-3.jpg') }}">
                            </div>
                            <div class="content">
                                <div class="text-title">
                                    Biker-style leggings
                                </div>
                                <div class="text-caption-1 text-secondary-2">Green, XS, Cotton</div>
                                <div class="text-title">$68.00</div>
                            </div>
                        </div>
                        <div class="tf-sticky-atc-infos">
                            <div class="tf-sticky-atc-size d-flex gap-12 align-items-center">
                                <div class="tf-sticky-atc-infos-title text-title">Size:</div>
                                <div class="tf-dropdown-sort style-2" data-bs-toggle="dropdown">
                                    <div class="btn-select">
                                        <span class="text-sort-value font-2">M</span>
                                        <span class="icon icon-arrow-down"></span>
                                    </div>
                                    <div class="dropdown-menu">
                                        <div class="select-item">
                                            <span class="text-value-item">S</span>
                                        </div>
                                        <div class="select-item active">
                                            <span class="text-value-item">M</span>
                                        </div>
                                        <div class="select-item">
                                            <span class="text-value-item">L</span>
                                        </div>
                                        <div class="select-item">
                                            <span class="text-value-item">XL</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-sticky-atc-quantity d-flex gap-12 align-items-center">
                                <div class="tf-sticky-atc-infos-title text-title">Quantity:</div>
                                <div class="wg-quantity style-1">
                                    <span class="btn-quantity minus-btn">-</span>
                                    <input type="text" name="number" value="1">
                                    <span class="btn-quantity plus-btn">+</span>
                                </div>
                            </div>
                            <div class="tf-sticky-atc-btns">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="tf-btn w-100 btn-reset radius-4 btn-add-to-cart"><span class="text text-btn-uppercase">Add To Cart</span></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</section>
<!-- /Product_Main -->

<!-- Product_Description_Tabs -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget-tabs style-1">
                    <ul class="widget-menu-tab">
                        <li class="item-title active skeleton">
                            <span class="inner">Description</span>
                        </li>

                        <li class="item-title skeleton">
                            <span class="inner">Customer Reviews</span>
                        </li>

                        @if ( !empty($product->shipping_return) )
                            <li class="item-title skeleton">
                                <span class="inner">Shipping & Returns</span>
                            </li>
                        @endif

                        @if (!empty($product->return_policy))
                            <li class="item-title skeleton">
                                <span class="inner">Return Policies</span>
                            </li>
                        @endif
                    </ul>

                    <div class="widget-content-tab">
                        {{-- Long Description --}}
                        <div class="widget-content-inner active">
                            <div class="tab_description skeleton">
                                 {!! $product->long_description !!}
                            </div>
                        </div>

                        {{-- Customer Review --}}
                        <div class="widget-content-inner">
                            <div class="tab-reviews write-cancel-review-wrap">
                                {{-- Review Ratings --}}
                                <div class="tab-reviews-heading">

                                    {{-- Ratings Ratio --}}
                                     @php
                                        $productReviews = App\Models\ProductReview::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->selectRaw('ratings, COUNT(*) as count')
                                            ->groupBy('ratings')
                                            ->pluck('count', 'ratings')
                                            ->toArray();

                                        $totalRatings = array_sum($productReviews);
                                        $avgRating = App\Models\ProductReview::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->avg('ratings');

                                        $starCounts = [
                                            5 => $productReviews[5] ?? 0,
                                            4 => $productReviews[4] ?? 0,
                                            3 => $productReviews[3] ?? 0,
                                            2 => $productReviews[2] ?? 0,
                                            1 => $productReviews[1] ?? 0,
                                        ];
                                    @endphp

                                    <div class="top">
                                        <div class="text-center">
                                            <div class="number title-display">{{ number_format($avgRating, 1) }}</div>
                                            <div class="list-star">
                                                @for ( $i = 1; $i <= 5; $i++ )
                                                    @if ( $i <= round($avgRatings))
                                                        <li class="bx bxs-star" style="color: #F0A750;"></li>
                                                    @else
                                                        <li class="bx bx-star" style="color: #F0A750;"></li>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p>({{ $reviews }} Ratings)</p>
                                        </div>

                                        <div class="rating-score">
                                            @foreach([5, 4, 3, 2, 1] as $star)
                                                @php
                                                    $percentage = $totalRatings ? ($starCounts[$star] / $totalRatings) * 100 : 0;
                                                @endphp
                                                <div class="item">
                                                    <div class="number-1 text-caption-1">{{ $star }}</div>
                                                    <li class="icon bx bxs-star" style="color: #000;"></li>
                                                    <div class="line-bg">
                                                        <div style="width: {{ $percentage }}%;"></div>
                                                    </div>
                                                    <div class="number-2 text-caption-1">{{ $starCounts[$star] }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @php
                                        if( Auth::check() ){
                                            $isBought = false;
                                            $orders = App\Models\Order::where([
                                                ['user_id', Auth::user()->id],
                                                ['order_status', 'delivered']
                                            ])->get();
                                    
                                            foreach ($orders as $order) {
                                                $existItem = App\Models\OrderProduct::where('order_id', $order->order_id)
                                                    ->where('product_id', $product->id)
                                                    ->get();

                                                if ($existItem) {
                                                    $isBought = true;
                                                }
                                            }
                                        }
                                        else{
                                            $isBought = false;
                                        }
                                    @endphp
                                    
                                    @if ( $isBought === true )
                                        <div>
                                            <div class="btn-style-4 text-btn-uppercase letter-1 btn-comment-review btn-cancel-review">Cancel Review</div>
                                            <div class="btn-style-4 text-btn-uppercase letter-1 btn-comment-review btn-write-review">Write a review</div>
                                        </div>
                                    @endif
                                </div>

                                {{-- All Review Comments --}}
                                <div class="reply-comment style-1 cancel-review-wrap">
                                    {{-- <div class="d-flex mb_24 gap-20 align-items-center justify-content-between flex-wrap">
                                        <h4 class="">03 Comments</h4>
                                        <div class="d-flex align-items-center gap-12">
                                            <div class="text-caption-1">Sort by:</div>
                                            <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                                                <div class="btn-select">
                                                    <span class="text-sort-value">Most Recent</span>
                                                    <i class='bx bx-chevron-down' style="font-size: 20px;"></i>
                                                </div>
                                                <div class="dropdown-menu">
                                                    <div class="select-item active">
                                                        <span class="text-value-item">Most Recent</span>
                                                    </div>
                                                    <div class="select-item">
                                                        <span class="text-value-item">Oldest</span>
                                                    </div>
                                                    <div class="select-item">
                                                        <span class="text-value-item">Most Popular</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="reply-comment-wrap">

                                        @if ( $product_reviews->count() < 1 )
                                            <div class="alert alert-danger text-center" role="alert">
                                                There is no review here
                                            </div>
                                        @else
                                            @foreach ($product_reviews as $row)
                                                <div class="reply-comment-item">
                                                    <div class="user">
                                                        <div class="image">
                                                            @if ( !empty($row->image) )
                                                                <img src="{{ asset($row->image) }}" alt=""> 
                                                            @else
                                                                <img src="{{ asset('public/frontend/images/avatar/user-default.jpg') }}" alt="">
                                                            @endif
                                                        </div>

                                                        <div>
                                                            <h6>
                                                                <a href="#" class="link">{{ $row->name }}</a>
                                                            </h6>
                                                            <div class="day text-secondary-2 text-caption-1">{{ $row->created_at->diffForHumans() }} &nbsp;&nbsp;&nbsp;-</div>
                                                        </div>
                                                    </div>
                                                    <p class="text-secondary">{{ $row->review }}</p>
                                                </div>
                                            @endforeach
                                        @endif

                                        {{-- <div class="reply-comment-item type-reply">
                                            <div class="user">
                                                <div class="image">
                                                    <img src="{{ asset('public/frontend/images/avatar/user-modave.jpg') }}" alt="">
                                                </div>
                                                <div>
                                                    <h6>
                                                        <a href="#" class="link">Reply from Modave</a>
                                                    </h6>
                                                    <div class="day text-secondary-2 text-caption-1">1 days ago &nbsp;&nbsp;&nbsp;-</div>
                                                </div>
                                            </div>
                                            <p class="text-secondary">We love to hear it! Part of what we love most about Modave is how much it empowers store owners like yourself to build a beautiful website without having to hire a developer :) Thank you for this fantastic
                                                review!</p>
                                        </div> --}}

                                        {{-- <div class="reply-comment-item">
                                            <div class="user">
                                                <div class="image">
                                                    <img src="{{ asset('public/frontend/images/avatar/user-default.jpg') }}" alt="">
                                                </div>
                                                <div>
                                                    <h6>
                                                        <a href="#" class="link">Superb quality apparel that exceeds expectations</a>
                                                    </h6>
                                                    <div class="day text-secondary-2 text-caption-1">1 days ago &nbsp;&nbsp;&nbsp;-</div>
                                                </div>
                                            </div>
                                            <p class="text-secondary">Great theme - we were looking for a theme with lots of built in features and flexibility and this was perfect. We expected to need to employ a developer to add a few finishing touches. But we actually
                                                managed to do everything ourselves. We did have one small query and the support given was swift and helpful.</p>
                                        </div> --}}
                                    </div>
                                </div>

                                {{-- Review Form --}}
                                <form class="form-write-review write-review-wrap" method="POST" action="{{ route('review.store') }}">
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $product->id }}" >

                                    <div class="heading">
                                        <h4>Write a review:</h4>
                                        <div class="list-rating-check">
                                            <input type="radio" id="star5" name="ratings" value="5">
                                            <label for="star5" title="text"></label>
                                            <input type="radio" id="star4" name="ratings" value="4">
                                            <label for="star4" title="text"></label>
                                            <input type="radio" id="star3" name="ratings" value="3">
                                            <label for="star3" title="text"></label>
                                            <input type="radio" id="star2" name="ratings" value="2">
                                            <label for="star2" title="text"></label>
                                            <input type="radio" id="star1" name="ratings" value="1">
                                            <label for="star1" title="text"></label>
                                        </div>
                                    </div>

                                    <div class="mb_32">
                                        {{-- <div class="mb_8">Review Title</div>
                                        <fieldset class="mb_20">
                                            <input class="" type="text" placeholder="Give your review a title" name="text" tabindex="2" value="" aria-required="true" required="">
                                        </fieldset> --}}

                                        <div class="mb_8">Review</div>
                                        <fieldset class="d-flex mb_20">
                                            <textarea class="" rows="4" placeholder="Write your comment here" tabindex="2" aria-required="true" name="review"></textarea>
                                        </fieldset>

                                        {{-- <div class="cols mb_20">
                                            <fieldset class="">
                                                <input class="" type="text" placeholder="You Name (Public)" name="text" tabindex="2" value="" aria-required="true" required="">
                                            </fieldset>
                                            <fieldset class="">
                                                <input class="" type="email" placeholder="Your email (private)" name="email" tabindex="2" value="" aria-required="true" required="">
                                            </fieldset>
                                        </div>
                                        <div class="d-flex align-items-center check-save">
                                            <input type="checkbox" name="availability" class="tf-check" id="check1">
                                            <label class="text-secondary text-caption-1" for="check1">Save my name, email, and website in this browser for the next time I comment.</label>
                                        </div> --}}
                                    </div>
                                    <div class="button-submit">
                                        <button class="text-btn-uppercase" type="submit">Submit Reviews</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Shipping Return Description --}}
                        @if ( !empty($product->shipping_return) )
                            <div class="widget-content-inner">
                                <div class="tab_description ">
                                    {!! $product->shipping_return !!}
                                </div>
                            </div>
                        @endif

                        {{-- Return Policy Description --}}
                        @if (!empty($product->return_policy))
                            <div class="widget-content-inner">
                                <div class="tab_description">
                                    {!! $product->return_policy !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Product_Description_Tabs -->



<!-- Related Products -->
<section class="flat-spacing">
    <div class="container flat-animate-tab">
        <ul class="tab-product justify-content-sm-center wow fadeInUp" data-wow-delay="0s" role="tablist">
            <li class="nav-tab-item" role="presentation">
                <a href="#ralatedProducts" class="active" data-bs-toggle="tab">Ralated Products</a>
            </li>
            <li class="nav-tab-item" role="presentation">
                <a href="#recentlyViewed" data-bs-toggle="tab">Recently Viewed</a>
            </li>
        </ul>

        <div class="tab-content">
            {{-- Related Products show --}}
            <div class="tab-pane active show" id="ralatedProducts" role="tabpanel">
                <div dir="ltr" class="swiper tf-sw-latest" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">

                        @foreach ($related_products as $row)
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
                    <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>
                </div>
            </div>

            {{-- View Products Show --}}
            <div class="tab-pane" id="recentlyViewed" role="tabpanel">
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
        </div>

    </div>
</section>
<!-- /Related Products -->

@endsection


@push('add-js')
    <script type="module" src="{{ asset('public/frontend/js/drift.min.js') }}"></script>
    <script type="module" src="{{ asset('public/frontend/js/model-viewer.min.js') }}"></script>
    <script type="module" src="{{ asset('public/frontend/js/zoom.js') }}"></script>

<script>
    var currency_symbol = "{{ getSetting()->currency_symbol }}";
        // For color select
        $(document).on('change', 'input[name="color_id"]', function () {
            var colorId = $(this).attr('id'); // Get the ID of the selected input
            var colorName = $('label[for="' + colorId + '"]').attr('data-value'); // Find the corresponding label

            $('.color_variant').text(colorName);

            $('.main_color_show').removeClass('active'); // Remove active class from all
            $('label[for="' + colorId + '"]').addClass('active'); // Add active class to the selected label

            calculateTotalPrice();
        });

        // For size select
        $(document).on('change', '.main_size_btn', function () {
            var radioInput = $(this).prev('input[type="radio"]');
            radioInput.prop('checked', true);

            var selectedSize = $(this).data('value');
            $('.size_variant').text(selectedSize);

            $('.main_size_btn').removeClass('active');
            $(this).addClass('active');
            calculateTotalPrice();
        });

        function copyUrl() {
           // Get the text field
            var copyText = document.getElementById("copytext");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
        }

        function calculateTotalPrice() {
            var priceText = $('.price_on_sale').text(); 
            var priceValue = parseInt(priceText.replace(`${currency_symbol}`, '').trim()); 
            var qty = $('.quantity-product').val();
            var color_price = $('input[name="color_id"]:checked').data('price') || 0; // Default to 0 if undefined
            var size_price = $('input[name="size_id"]:checked').data('price') || 0;  // Default to 0 if undefined
            var total = ( priceValue * qty ) + ( qty * (parseFloat(color_price) + parseFloat(size_price)) ) ;
            $('.total_price').text(`${currency_symbol}` + total); // Update total price
            // console.log('Initial:', qty, color_price, size_price);
        }

        $(document).ready(function () {
            // Initial calculation on page load
            calculateTotalPrice();

            // Recalculate on increase button click
            $('.btn-increase').on('click', function () {
                calculateTotalPrice();
            });

            // Recalculate on decrease button click
            $('.btn-decrease').on('click', function () {
                calculateTotalPrice();
            });

            // For Color Change
            $('input[name="color_id"]').on('change', function () {
                calculateTotalPrice();
            });

            // For Color Change
            $('input[name="size_id"]').on('change', function () {
                calculateTotalPrice();
            });

        });
</script>

@include('frontend.include.full_ajax_cart')
{{-- <script>

    $(document).ready(function () {
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
                   $('#sold_product').text(`${product.product_sold}`);
                   $('.tf-product-info-price').html(res.price_val);
                   $('#short_desc').text(`${product.short_description}`);
                   $('#product_view').text(`${product.product_view}`);
                   // $('.total_price').text('$' + res.product_price);

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
                                       <span class="tooltip">${color.color_name} ( TK ${color.color_price} )</span>
                                   </label>
                               </div>
                           `;
                       });

                       $('#color_variant').html(colorsHtml);

                       // Dynamically set the first color name in the text-title span
                       var firstColor = res.product_color[0]; // Get the first color
                       $('.text-title.color_variant').text(firstColor.color_name);
                   } else {
                       $('#color_variant').html('<p>No colors available for this product.</p>');
                       $('.text-title.color_variant').text('No Color');
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
                                       <span class="tooltip">${size.size_name} ( TK ${size.size_price} )</span>
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
                       $('#size_variant').html('<p>No sizes available for this product.</p>');
                       $('.text-title.size_variant').text('No Size');
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
                   $('#quick_product_name').text(`${product.name}`);
                   $('.tf-product-info-price').html(res.price_val);

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
                                       <span class="tooltip">${color.color_name} ( TK ${color.color_price} )</span>
                                   </label>
                               </div>
                           `;
                       });

                       $('#quick_color_variant').html(colorsHtml);

                       // Dynamically set the first color name in the text-title span
                       var firstColor = res.product_color[0]; // Get the first color
                       $('.text-title.color_variant').text(firstColor.color_name);
                   } else {
                       $('#color_variant').html('<p>No colors available for this product.</p>');
                       $('.text-title.color_variant').text('No Color');
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
                                       <span class="tooltip">${size.size_name} ( TK ${size.size_price} )</span>
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
                       $('.text-title.size_variant').text('No Size');
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

       // Fetch all sidebar cart data
       function sidebarCartData(){
           $.ajax({
               method: 'GET',
               url: "{{ route('get.sidebar.cart') }}",
               success: function(response) {
                   if (response.status === true) {
                       let cartHtml = '';
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
                                               ${item.size_name ? item.size_name.toUpperCase() + ` ($${item.size_price})` : ''} 
                                               ${item.color_name ? ` / ${item.color_name} ($${item.color_price})` : ''}
                                           </div>
                                           <div class="text-button">${item.qty} X $${item.price}</div>
                                       </div>
                                       <div class="d-flex align-items-center justify-content-between de-flex gap-12">
                                           <div class="text-secondary-2">Amount</div>
                                           <div class="text-button">$${item.total}</div>
                                       </div>
                                   </div>
                               </div>
                           `;
                       });

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
                                   <a href="{{ route('checkout') }}" class="tf-btn btn-reset">Continue Shopping</a>
                               </div>
                           `);
                           $('.tf-mini-cart-threshold').remove();
                           $('#tf-mini-cart-actions-field').remove();
                       }

                       getCartCount(); 
                       toastr.success(data.message);
                   }
               },
               error: function(err) {
                   console.log(err);
               },
           })
       })

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

       //__ Cart subTotal __//
       function getSidebarCartTotal(){
           $.ajax({
               method: 'GET',
               url: "{{ route('cart.sidebar-product-total') }}",
               success: function(data) {
                   console.log('get total', data);
                   if( data.status === 'success' ){
                      $('.tf-totals-total-value').text('$' + data.total);
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
                       <a class="link text-btn-uppercase" href="shop-default-grid.html">Or continue shopping</a>
                   </div>    
               </div>
           `);
       }

       $('.quick_view_cart').on('click', function() {
           $('.show-shopping-cart').removeClass('show-shopping-cart');
       });
   });

</script> --}}

@endpush