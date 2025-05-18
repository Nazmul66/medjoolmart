@if ( $products->count() > 0 )

    <div class="tf_grid_layout" id="gridLayout">

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
                        <div class="on-sale-wrap skeleton">
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
                                <span class="price"><span class="old-price skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span> <span class="skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price - $row->discount_value }}</span></span>
                            @elseif( !empty($row->discount_type === "percent") )
                            @php
                                $discount_val = $row->selling_price * $row->discount_value / 100;
                            @endphp
                                <span class="price"><span class="old-price skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span> <span class="skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price - $discount_val }}</span></span>
                            @else
                                <span class="price"> <span class="skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span></span>
                            @endif
                        @else
                            <span class="price"> <span class="skeleton">{{ getSetting()->currency_symbol }}{{ $row->selling_price }}</span></span>
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

    <div class="pagination_page text-center">
        @if ($products->hasPages())
            {!! $products->withQueryString()->links() !!}
        @endif
    </div>

@else
    <div class="tf_grid_layout" id="gridLayout" style="grid-template-columns: repeat(1, 1fr)!important;">
        <div class="alert alert-danger alert-dismissible fade show px-4 mb-0 text-center" role="alert">
            <i class="bx bx-tired d-block display-4 mt-2 mb-3 text-danger"></i>
            {{-- <h5 class="text-danger">Warning</h5> --}}
            <p>There is no product item.</p>
        </div>
    </div>
@endif


<script>
    // Skeleton loader added
    $(document).ready(function(){
        $('.skeleton').each(function(){
            $(this).on('load', function(){
                $(this).removeClass('skeleton');
            }).trigger('load'); // Manually trigger load in case it's already loaded
        });
        $('.skeleton2').each(function(){
            $(this).on('load', function(){
                $(this).removeClass('skeleton2');
            }).trigger('load'); // Manually trigger load in case it's already loaded
        });
        $('.banner_slider').each(function(){
            $(this).on('load', function(){
                $(this).removeClass('banner_slider');
            }).trigger('load'); // Manually trigger load in case it's already loaded
        });
    })
</script>