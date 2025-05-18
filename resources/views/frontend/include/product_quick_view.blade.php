<div class="modal fullRight fade modal-quick-view" id="quickView">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="tf-quick-view-image">
                <div class="wrap-quick-view wrapper-scroll-quickview multiple_image">
                    <div class="quickView-item item-scroll-quickview" id="thumb_image" data-scroll-quickview="beige">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-1.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-1.jpg') }}" alt="">
                    </div>

                    {{-- <div class="quickView-item item-scroll-quickview" data-scroll-quickview="beige">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-2.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-2.jpg') }}" alt="">
                    </div>

                    <div class="quickView-item item-scroll-quickview" data-scroll-quickview="gray">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-3.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-3.jpg') }}" alt="">
                    </div>

                    <div class="quickView-item item-scroll-quickview" data-scroll-quickview="gray">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-4.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-4.jpg') }}" alt="">
                    </div>

                    <div class="quickView-item item-scroll-quickview" data-scroll-quickview="grey">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-19.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-19.jpg') }}" alt="">
                    </div>

                    <div class="quickView-item item-scroll-quickview" data-scroll-quickview="grey">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-20.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-20.jpg') }}" alt="">
                    </div> --}}
                </div>
            </div>
            
            <div class="wrap">
                <div class="header">
                    <h5 class="title">Quick View</h5>
                    <i class='bx bx-x icon-close-popup quick_view_cart' style="font-size: 32px;" data-bs-dismiss="modal"></i>
                </div>
                <div class="tf-product-info-list">
                    <div class="tf-product-info-heading">
                        <div class="tf-product-info-name">
                            <div class="text text-btn-uppercase" id="category_name">Clothing</div>
                            <h3 class="name" id="product_name">Stretch Strap Top</h3>
                            {{-- <div class="sub">
                                <div class="tf-product-info-rate">
                                    <ul class="list-star">
                                        <li class="bx bxs-star" style="color: #F0A750;"></li>
                                        <li class="bx bxs-star" style="color: #F0A750;"></li>
                                        <li class="bx bxs-star" style="color: #F0A750;"></li>
                                        <li class="bx bxs-star" style="color: #F0A750;"></li>
                                        <li class="bx bx-star" style="color: #F0A750;"></li>
                                    </ul>
                                    <div class="text text-caption-1">(134 reviews)</div>
                                </div>
                                <div class="tf-product-info-sold">
                                    <ion-icon name="flash-outline" class="text-critical"></ion-icon>
                                    <div class="text text-caption-1"><span id="sold_product"></span> product sold</div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="tf-product-info-desc">
                            <div class="tf-product-info-price">
                                {{-- <h5 class="price-on-sale font-2">$79.99</h5>
                                <div class="compare-at-price font-2">$98.99</div>
                                <div class="badges-on-sale text-btn-uppercase">
                                    -25%
                                </div> --}}
                            </div>
                            <p id="short_desc">The garments labelled as Committed are products that have been produced using sustainable fibres or processes, reducing their environmental impact.</p>
                            <div class="tf-product-info-liveview">
                                <ion-icon name="eye-outline" style="font-size: 24px;"></ion-icon>
                                <p class="text-caption-1"><span class="liveview-count" id="product_view">28</span> people are viewing this product.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-choose-option">

                        <form class="add-to-cart-form">
                            @csrf

                            <input type="hidden" name="product_id" id="product_id">

                            <div class="variant-picker-item main_color_variant mb-3">
                                <div class="variant-picker-label mb_12  mb-2">
                                    Colors:<span class="text-title color_variant variant-picker-label-value">Beige</span>
                                </div>

                                <div class="variant-picker-values" id="color_variant">
                                    <div class="mb-2">
                                        <input id="values-beige1" type="radio" name="color_id" checked>
                                        <label class="hover-tooltip tooltip-bot radius-60 color-btn color_show active" 
                                            data-slide="0" 
                                            data-price="79.99" 
                                            for="values-beige1" 
                                            data-value="Beige" 
                                            data-scroll-quickview="beige"
                                        >
                                            <span class="btn-checkbox bg-color-beige1"></span>
                                            <span class="tooltip">Beige</span>
                                        </label>
                                    </div>
    
                                    {{-- <input id="values-gray1" type="radio" name="color2">
                                    <label class="hover-tooltip tooltip-bot radius-60 color-btn " data-slide="1" data-price="79.99" for="values-gray1" data-value="Gray" data-scroll-quickview="gray">
                                        <span class="btn-checkbox bg-color-gray"></span>
                                        <span class="tooltip">Gray</span>
                                    </label>
    
                                    <input id="values-grey1" type="radio" name="color2">
                                    <label class="hover-tooltip tooltip-bot radius-60 color-btn btn-scroll-quickview" data-slide="2" data-price="89.99" for="values-grey1" data-value="Grey" data-scroll-quickview="grey">
                                        <span class="btn-checkbox bg-color-grey"></span>
                                        <span class="tooltip">Grey</span>
                                    </label> --}}
                                </div>
                            </div>
    
                            <div class="variant-picker-item main_size_variant mb-3">
                                <div class="d-flex justify-content-between mb_12">
                                    <div class="variant-picker-label ">
                                        Size:<span class="text-title size_variant variant-picker-label-value">L</span>
                                    </div>
                                    {{-- <a class="size-guide text-title link show-size-guide">Size Guide</a> --}}
                                </div>
    
                                <div class="variant-picker-values gap12" id="size_variant">
                                    <div class="mb-2">
                                        <input type="radio" name="size_id" id="values-s1">
                                        <label class="style-text size-btn" for="values-s1" data-value="S">
                                            <span class="text-title">S</span>
                                        </label>
                                    </div>
                                    {{-- <input type="radio" name="size2" id="values-m1">
                                    <label class="style-text size-btn" for="values-m1" data-value="M">
                                        <span class="text-title">M</span>
                                    </label>
                                    <input type="radio" name="size2" id="values-l1" checked>
                                    <label class="style-text size-btn" for="values-l1" data-value="L" data-price="89.99">
                                        <span class="text-title">L</span>
                                    </label>
                                    <input type="radio" name="size2" id="values-xl1">
                                    <label class="style-text size-btn" for="values-xl1" data-value="XL" data-price="89.99">
                                        <span class="text-title">XL</span>
                                    </label> --}}
                                </div>
                            </div>
    
                            <div class="tf-product-info-quantity">
                                <div class="title mb_12">Quantity: <span class="prdt_qty me-1">10 </span><span class="product_units">Pcs</span></div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity btn-decrease">-</span>
                                    <input class="quantity-product" id="modal_qty" type="text" name="qty" value="1">
                                    <span class="btn-quantity btn-increase">+</span>
                                </div>
                            </div>
    
                            <div class="mt-3">
                                <div class="tf-product-info-by-btn mb_10">
                                    <button type="submit" name="button" value="add_cart" class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 ">
                                        <span>Add to cart</span>
                                        {{-- <span class="tf-qty-price total_price">$79.99</span> --}}
                                    </button>
                                    {{-- <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare" class="box-icon hover-tooltip compare btn-icon-action show-compare">
                                        <i class='bx bx-git-compare' style="font-size: 24px;"></i>
                                        <span class="tooltip text-caption-2">Compare</span>
                                    </a>
                                    <a href="javascript:void(0);" class="box-icon hover-tooltip text-caption-2 wishlist btn-icon-action">
                                        <i class='bx bx-heart' style="font-size: 24px;"></i>
                                        <span class="tooltip text-caption-2">Wishlist</span>
                                    </a> --}}
                                </div>
                                <button type="submit" name="button" value="buy_now" class="fw-6 buy_now_btn btn-style-3 text-btn-uppercase">Buy it now</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>