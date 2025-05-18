<div class="modal fade modal-quick-add" id="quickAdd">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="header">
                <i class='bx bx-x icon-close-popup quick_view_cart' style="font-size: 32px;" data-bs-dismiss="modal"></i>
                {{-- <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span> --}}
            </div>
            <div>
                <div class="tf-product-info-list">
                    <div class="tf-product-info-item">
                        <div class="image" id="quick_thumb_image">
                            <img src="{{ asset('public/frontend/images/products/womens/women-1.jpg') }}" alt="">
                        </div>
                        <div class="content">
                            <a href="product-detail.html" id="quick_product_name">Ribbed Tank Top</a>
                            <div class="tf-product-info-price">
                                {{-- <h5 class="price-on-sale font-2">$79.99</h5>
                                <div class="compare-at-price font-2">$98.99</div>
                                <div class="badges-on-sale text-btn-uppercase">
                                    -25%
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-choose-option">

                        <form class="add-to-cart-form">
                            @csrf

                            <input type="hidden" name="product_id" id="quick_product_id">

                            <div class="variant-picker-item">
                                <div class="variant-picker-label main_color_variant mb-2">
                                    Colors:<span class="text-title variant-picker-label-value color_variant">Beige</span>
                                </div>

                                <div class="variant-picker-values" id="quick_color_variant">
                                    <div class="">
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
                                    
                                    {{-- <input id="values-gray2" type="radio" name="color3">
                                    <label class="hover-tooltip tooltip-bot radius-60" for="values-gray2" data-value="Gray">
                                        <span class="btn-checkbox bg-color-gray"></span>
                                        <span class="tooltip">Gray</span>
                                    </label>
                                    <input id="values-grey3" type="radio" name="color3">
                                    <label class="hover-tooltip tooltip-bot radius-60" for="values-grey3" data-value="Grey">
                                        <span class="btn-checkbox bg-color-grey"></span>
                                        <span class="tooltip">Grey</span>
                                    </label> --}}
                                </div>
                            </div>

                            <div class="variant-picker-item">
                                <div class="variant-picker-label main_size_variant mb-2">
                                    Size:<span class="text-title variant-picker-label-value size_variant">L</span>
                                </div>

                                <div class="variant-picker-values gap12" id="quick_size_variant">
                                    <div class="">
                                        <input type="radio" name="size_id" id="values-s1">
                                        <label class="style-text size-btn" for="values-s1" data-value="S">
                                            <span class="text-title">S</span>
                                        </label>
                                    </div>

                                    {{-- <input type="radio" name="size3" id="values-m2">
                                    <label class="style-text size-btn" for="values-m2" data-value="M">
                                        <span class="text-title">M</span>
                                    </label>
                                    <input type="radio" name="size3" id="values-l2" checked>
                                    <label class="style-text size-btn" for="values-l2" data-value="L">
                                        <span class="text-title">L</span>
                                    </label>
                                    <input type="radio" name="size3" id="values-xl2">
                                    <label class="style-text size-btn" for="values-xl2" data-value="XL">
                                        <span class="text-title">XL</span>
                                    </label> --}}
                                </div>
                            </div>

                            <div class="tf-product-info-quantity">
                                <div class="title mb_12">Quantity: <span class="prdt_qty me-1">10 </span><span class="product_units">Pcs</span></div>
                                <div class="wg-quantity mb-3">
                                    <span class="btn-quantity btn-decrease">-</span>
                                    <input class="quantity-product" id="quick_add_qty" type="text" name="qty" value="1">
                                    <span class="btn-quantity btn-increase">+</span>
                                </div>
                            </div>

                            <div class="mt-3">
                                {{-- <div class="tf-product-info-by-btn mb_10">
                                    <button type="submit" name="button" value="add_cart" class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 ">
                                        <span>Add to cart</span>
                                        <span class="tf-qty-price total_price">$79.99</span>
                                    </button> --}}
                                    {{-- <a href="#compare" data-bs-toggle="offcanvas" aria-controls="compare" class="box-icon hover-tooltip compare btn-icon-action show-compare">
                                        <i class='bx bx-git-compare' style="font-size: 24px;"></i>
                                        <span class="tooltip text-caption-2">Compare</span>
                                    </a>
                                    <a href="javascript:void(0);" class="box-icon hover-tooltip text-caption-2 wishlist btn-icon-action">
                                        <i class='bx bx-heart' style="font-size: 24px;"></i>
                                        <span class="tooltip text-caption-2">Wishlist</span>
                                    </a> --}}
                                </div>
                                <button type="submit" name="button" value="buy_now" class="fw-6 buy_now_btn btn-style-3 text-btn-uppercase">Order now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>