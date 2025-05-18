@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || {{ $title }}</title>
    <meta name="description" content="{{ $description }}">

    <meta property="og:title" content="{{ $title ?? 'Default Title' }}">
    <meta property="og:description" content="{{ $description ?? 'Default Description' }}">
    <meta property="og:image" content="{{ asset(getSetting()->logo ) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
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

        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <h3 class="heading text-center">About Us</h3>
                    <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                        <li>
                            <a class="link" href="{{ route('home') }}">Homepage</a>
                        </li>
                        <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>
                            <a class="link" href="#">Pages</a>
                        </li>
                        <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>
                            About Us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /page-title -->

        <!-- about-us -->
        <section class="flat-spacing about-us-main pb_0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-us-features wow fadeInLeft">
                            <img class="lazyload" data-src="{{ asset('public/frontend/images/banner/about-us.jpg') }}" src="{{ asset('public/frontend/images/banner/about-us.jpg') }}" alt="image-team">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-us-content">
                            <h3 class="title wow fadeInUp">Modave – Offering rare and beautiful items worldwide</h3>
                            <div class="widget-tabs style-3">
                                <ul class="widget-menu-tab wow fadeInUp">
                                    <li class="item-title active">
                                        <span class="inner text-button">Introduction</span>
                                    </li>
                                    <li class="item-title">
                                        <span class="inner text-button">Our Vision</span>
                                    </li>
                                    <li class="item-title">
                                        <span class="inner text-button">What Sets Us Apart</span>
                                    </li>
                                    <li class="item-title">
                                        <span class="inner text-button">Our Commitment</span>
                                    </li>
                                </ul>
                                <div class="widget-content-tab wow fadeInUp">
                                    <div class="widget-content-inner active">
                                        <p>Welcome to Modave Store, your premier destination for fashion-forward clothing and accessories. We pride ourselves on offering a curated selection of rare and beautiful items sourced both locally and globally. Our
                                            mission is to bring you the latest trends and timeless styles, ensuring every piece reflects quality and elegance. Discover the perfect addition to your wardrobe at Modave Store.</p>
                                    </div>
                                    <div class="widget-content-inner">
                                        <p>Welcome to Modave Store, your premier destination for fashion-forward clothing and accessories. We pride ourselves on offering a curated selection of rare and beautiful items sourced both locally and globally. Our
                                            mission is to bring you the latest trends and timeless styles, ensuring every piece reflects quality and elegance. Discover the perfect addition to your wardrobe at Modave Store.</p>
                                    </div>
                                    <div class="widget-content-inner">
                                        <p>Welcome to Modave Store, your premier destination for fashion-forward clothing and accessories. We pride ourselves on offering a curated selection of rare and beautiful items sourced both locally and globally. Our
                                            mission is to bring you the latest trends and timeless styles, ensuring every piece reflects quality and elegance. Discover the perfect addition to your wardrobe at Modave Store.</p>
                                    </div>
                                    <div class="widget-content-inner">
                                        <p>Welcome to Modave Store, your premier destination for fashion-forward clothing and accessories. We pride ourselves on offering a curated selection of rare and beautiful items sourced both locally and globally. Our
                                            mission is to bring you the latest trends and timeless styles, ensuring every piece reflects quality and elegance. Discover the perfect addition to your wardrobe at Modave Store.</p>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="tf-btn btn-fill wow fadeInUp"><span class="text text-button">Read More</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /about-us -->

        <!-- Iconbox -->
        <section class="flat-spacing line-bottom-container">
            <div class="container">
                <div dir="ltr" class="swiper tf-sw-iconbox" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-return"></span></div>
                                <div class="content">
                                    <h6>14-Day Returns</h6>
                                    <p class="text-secondary">Risk-free shopping with easy returns.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-shipping"></span></div>
                                <div class="content">
                                    <h6>Free Shipping</h6>
                                    <p class="text-secondary">No extra costs, just the price you see.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-headset"></span></div>
                                <div class="content">
                                    <h6>24/7 Support</h6>
                                    <p class="text-secondary">24/7 support, always here just for you</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="tf-icon-box style-2">
                                <div class="icon-box"><span class="icon icon-sealCheck"></span></div>
                                <div class="content">
                                    <h6>Member Discounts</h6>
                                    <p class="text-secondary">Special prices for our loyal customers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sw-pagination-iconbox sw-dots type-circle justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Iconbox -->

        <!-- Our Teams -->
        <section class="flat-spacing">
            <div class="container">
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">Meet Our Teams</h3>
                    <p class="subheading text-secondary-2">Discover exceptional experiences through testimonials from our satisfied customers.</p>
                </div>
                <div dir="ltr" class="swiper tf-sw-latest" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="team-item hover-image wow fadeInUp" data-wow-delay="0s">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/team/team-1.jpg') }}" src="{{ asset('public/frontend/images/team/team-1.jpg') }}" alt="image-team">
                                </div>
                                <div class="content">
                                    <div>
                                        <h6 class="name"><a class="link text-line-clamp-1" href="#">Annette Black</a></h6>
                                        <div class="infor text-caption-1 text-secondary-2">Founder/CEO</div>
                                    </div>
                                    <ul class="tf-social-icon">
                                        <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="team-item hover-image wow fadeInUp" data-wow-delay="0.1s">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/team/team-2.jpg') }}" src="{{ asset('public/frontend/images/team/team-2.jpg') }}" alt="image-team">
                                </div>
                                <div class="content">
                                    <div>
                                        <h6 class="name"><a class="link text-line-clamp-1" href="#">Jane Cooper</a></h6>
                                        <div class="infor text-caption-1 text-secondary-2">Sales Director</div>
                                    </div>
                                    <ul class="tf-social-icon">
                                        <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="team-item hover-image wow fadeInUp" data-wow-delay="0.2s">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/team/team-3.jpg') }}" src="{{ asset('public/frontend/images/team/team-3.jpg') }}" alt="image-team">
                                </div>
                                <div class="content">
                                    <div>
                                        <h6 class="name"><a class="link text-line-clamp-1" href="#">Brooklyn Simmons</a></h6>
                                        <div class="infor text-caption-1 text-secondary-2">Manager</div>
                                    </div>
                                    <ul class="tf-social-icon">
                                        <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="team-item hover-image wow fadeInUp" data-wow-delay="0.3s">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/team/team-4.jpg') }}" src="{{ asset('public/frontend/images/team/team-4.jpg') }}" alt="image-team">
                                </div>
                                <div class="content">
                                    <div>
                                        <h6 class="name"><a class="link text-line-clamp-1" href="#">Theresa Webb</a></h6>
                                        <div class="infor text-caption-1 text-secondary-2">Product Manager</div>
                                    </div>
                                    <ul class="tf-social-icon">
                                        <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sw-pagination-latest sw-dots type-circle justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Our Teams -->

        <!-- Partner -->
        <section class="flat-spacing-5 bg-surface">
            <div dir="ltr" class="swiper tf-sw-partner sw-auto" data-preview="auto" data-tablet="auto" data-mobile-sm="auto" data-mobile="auto" data-space-lg="74" data-space-md="50" data-space="50" data-loop="true" data-auto-play="true" data-delay="0">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/vanfaba.png') }}" alt="brand">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/anvouge.png') }}" alt="brand">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/carolin.png') }}" alt="brand">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/shangxi.png') }}" alt="brand">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/ecomife.png') }}" alt="brand">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/cheryl.png') }}" alt="brand">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/sopify.png') }}" alt="brand">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/pennyw.png') }}" alt="brand">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#" class="brand-item">
                            <img src="{{ asset('public/frontend/images/brand/panadoxn.png') }}" alt="brand">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Partner -->

        <!-- Testimonial -->
        <section class="flat-spacing">
            <div class="container">
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">Customer Review</h3>
                </div>
                <div class="swiper tf-sw-testimonial wow fadeInUp" data-wow-delay="0.1s" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-item style-4">
                                <div class="content-top">
                                    <div class="box-icon">
                                        <i class="icon icon-quote"></i>
                                    </div>
                                    <div class="text-title">Variety of Styles!</div>
                                    <p class="text-secondary">"Fantastic shop! Great selection, fair prices, and friendly staff. Highly recommended. The quality of the products is exceptional, and the prices are very reasonable!"</p>
                                    <div class="box-rate-author">
                                        <div class="box-author">
                                            <div class="text-title author">Sybil Sharp</div>
                                        </div>
                                        <div class="list-star-default color-primary">
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item style-4">
                                <div class="content-top">
                                    <div class="box-icon">
                                        <i class="icon icon-quote"></i>
                                    </div>
                                    <div class="text-title">Quality of Clothing!</div>
                                    <p class="text-secondary">"I absolutely love this shop! The products are high-quality and the customer service is excellent. I always leave with exactly what I need and a smile on my face."</p>
                                    <div class="box-rate-author">
                                        <div class="box-author">
                                            <div class="text-title author">Mark G.</div>
                                        </div>
                                        <div class="list-star-default color-primary">
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item style-4">
                                <div class="content-top">
                                    <div class="box-icon">
                                        <i class="icon icon-quote"></i>
                                    </div>
                                    <div class="text-title">Customer Service!</div>
                                    <p class="text-secondary">"I love this shop! The products are always top-quality, and the staff is incredibly friendly and helpful. They go out of their way to make sure that I'm satisfied with my purchase.”</p>
                                    <div class="box-rate-author">
                                        <div class="box-author">
                                            <div class="text-title author">Emily S.</div>
                                        </div>
                                        <div class="list-star-default color-primary">
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-item style-4">
                                <div class="content-top">
                                    <div class="box-icon">
                                        <i class="icon icon-quote"></i>
                                    </div>
                                    <div class="text-title">Variety of Styles!</div>
                                    <p class="text-secondary">"Fantastic shop! Great selection, fair prices, and friendly staff. Highly recommended. The quality of the products is exceptional, and the prices are very reasonable!"</p>
                                    <div class="box-rate-author">
                                        <div class="box-author">
                                            <div class="text-title author">Sybil Sharp</div>
                                        </div>
                                        <div class="list-star-default color-primary">
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                            <i class="icon icon-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Testimonial -->

@endsection

@push('add-js')

    <!-- simplyCountdown js-->
    <script src="{{ asset('public/frontend/js/simplyCountdown.js') }}"></script>

    @include('frontend.include.full_ajax_cart')
@endpush