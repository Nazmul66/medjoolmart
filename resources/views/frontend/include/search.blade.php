<div class="modal fade modal-search" id="search">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Search</h5>
                {{-- <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span> --}}
                <i class="bx bx-x icon-close icon-close-popup" style="font-size: 32px;" data-bs-dismiss="modal"></i>
            </div>

            <form class="form-search" action="{{ route('product.page') }}">
                <fieldset class="text">
                    <input type="text" placeholder="Searching..." class="" name="search" tabindex="0" value="{{ request()->search }}" aria-required="true">
                </fieldset>

                <button class="" type="submit">
                    <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </form>

            {{-- <div>
                <h5 class="mb_16">Feature keywords Today</h5>
                <ul class="list-tags">
                    <li><a href="#" class="radius-60 link">Dresses</a></li>
                    <li><a href="#" class="radius-60 link">Dresses women</a></li>
                    <li><a href="#" class="radius-60 link">Dresses midi</a></li>
                    <li><a href="#" class="radius-60 link">Dress summer</a></li>
                </ul>
            </div> --}}
            {{-- @foreach (App\Models\Product::where('is_approved', 1)->where('status', 1)->inRandomOrder()->limit(8)->get() as $row) --}}
            <div>
                <h5 class="mb_16">Recently viewed products</h5>
                <div class="tf-grid-layout tf-col-2 lg-col-3 xl-col-4">


                @foreach (App\Models\Product::where('is_approved', 1)->where('status', 1)->inRandomOrder()->limit(8)->get() as $row)
                    @php
                        $wishlistItems = App\Models\Wishlist::where('user_id', auth()->id())->pluck('product_id')->toArray();
                    @endphp
                    <div class="swiper-slide">
                        <div class="card-product wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card-product-wrapper">
                                <a href="{{ route('product.details', $row->slug) }}" class="product-img">
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
                                <a href="{{ route('product.details', $row->slug) }}" class="title link">{{ $row->name }}</a>
                                <div class="box-rating">
                                    <ul class="list-star">
                                        @for ( $i = 1; $i <= 5; $i++ )
                                            @if ( $i <= round($avgRatings))
                                                <li class="bx bxs-star" style="color: #F0A750;"></li>
                                            @else
                                                <li class="bx bx-star" style="color: #F0A750;"></li>
                                            @endif
                                        @endfor
                                    </ul>
                                    <span class="text-caption-1 text-secondary">({{ $reviews }} )</span>
                                </div>

                                @if ( checkDiscount($row) )
                                    @if ( !empty($row->discount_type === "amount") )
                                        <span class="price"><span class="old-price">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span> {{ getSetting()->currency_symbol }}{{ $row->selling_price - $row->discount_value }}</span>
                                    @elseif( !empty($row->discount_type === "percent") )
                                    @php
                                        $discount_val = $row->selling_price * $row->discount_value / 100;
                                    @endphp
                                        <span class="price"><span class="old-price">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span> {{ getSetting()->currency_symbol }}{{ $row->selling_price - $discount_val }}</span>
                                    @else
                                        <span class="price"> {{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span>
                                    @endif
                                @else
                                    <span class="price"> {{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span>
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
            </div>
            <!-- Load Item -->
            {{-- <div class="wd-load view-more-button text-center">
                <button class="tf-loading btn-loadmore tf-btn btn-reset"><span class="text text-btn text-btn-uppercase">Load more</span></button>
            </div> --}}
        </div>
    </div>
</div>