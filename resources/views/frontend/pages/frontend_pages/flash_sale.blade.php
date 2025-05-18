@extends('frontend.layout.master')

@push('add-meta')
    <title>Sazao || e-Commerce HTML Template</title>
@endpush


@push('add-css')

@endpush


@section('body-content')

<!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb" style=" background: url({{ asset('public/frontend/images/breadcrumb_bg.jpg') }});">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>offer detaila</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#">Flash Sale </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        Flash sale product START
    ==============================-->
    <section id="wsus__daily_deals">
        <div class="container">
            <div class="wsus__offer_details_area">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('public/frontend/images/offer_banner_2.png') }}" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>apple watch</p>
                                <span>up 50% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="wsus__offer_details_banner">
                            <img src="{{ asset('public/frontend/images/offer_banner_3.png') }}" alt="offrt img" class="img-fluid w-100">
                            <div class="wsus__offer_details_banner_text">
                                <p>xiaomi power bank</p>
                                <span>up 37% 0ff</span>
                                <p>for all poduct</p>
                                <p><b>today only</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__section_header rounded-0">
                            <h3>flash sell</h3>
                            <div class="wsus__offer_countdown">
                                <span class="end_text">ends time :</span>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($flashSaleItems as $item)
                        @php
                            $product = App\Models\Product::where('id', $item->product_id)->first();
                            $category = App\Models\Category::where('id', $product->category_id)->first();
                            $productImage = App\Models\ProductImage::where('product_id', $product->id)->get();
                        @endphp

                        <div class="col-xl-3">
                            <div class="wsus__offer_det_single">
                                <div class="wsus__product_item">
                                    <a class="wsus__pro_link" href="product_details.html">
                                        <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_1" />
                                        <img src="{{ asset($productImage[0]->images) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_2" />
                                    </a>
                                    <div class="wsus__product_details">
                                        <a class="wsus__category" href="#">{{ $category->category_name }} </a>
                                        <p class="wsus__pro_rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <span>(120 review)</span>
                                        </p>
                                        <a class="wsus__pro_name" href="#">{{ $product->name }}</a>
                                        <p class="wsus__price">
                                            @if ( !empty(checkDiscount($product)) )
                                                ${{ $product->offer_price }} <del>${{ $product->price }}</del>
                                            @else
                                                ${{ $product->price }}
                                            @endif
                                        </p>
                                        <a class="add_cart" href="#">add to cart</a>
                                    </div>
                                </div>
                                <div class="wsus__offer_progress">
                                    <p><span>Sold 91</span> <span>Total 120</span></p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65"
                                            aria-valuemin="0" aria-valuemax="100">65%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--============================
        Flash sale product END
    ==============================-->

@endsection

@push('add-js')
    <script>
        $(document).ready(function(){
            //=======COUNTDOWN======   
            var d = new Date(), 
                countUpDate = new Date();
                d.setDate(d.getDate() + 90);

            // default example
            simplyCountdown('.simply-countdown-one', {
                year: {{ date('Y', strtotime($flashSaleDate->end_date)) }},
                month: {{ date('m', strtotime($flashSaleDate->end_date)) }},
                day: {{ date('d', strtotime($flashSaleDate->end_date)) }} ,
                enableUtc: true
            });
        })
    </script>
@endpush