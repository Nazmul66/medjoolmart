@extends('frontend.layout.master')

@push('add-meta')
    <title>Sazao || About-us Template</title>
@endpush

@push('add-css')

@endpush


@section('body-content')

<!-- page-title -->
<div class="page-title" style="background-image: url(
    @if( !empty(getSetting()->banner_breadcrumb_img) )
        {{ asset(getSetting()->banner_breadcrumb_img) }}
    @else
        {{ asset('public/frontend/images/section/page-title.jpg') }}
    @endif
    );">
    
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">Blog Default</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="index.html">Homepage</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        <a class="link" href="#">Blog</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        Blog Default
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- blog-list -->
<div class="main-content-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-lg-30">
                <div class="wg-blog style-row hover-image mb_40">
                    <div class="image">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-list-1.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-list-1.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-10">
                            <div class="meta">
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-calendar"></i>
                                    </div>
                                    <p class="text-caption-1">February 28, 2024</p>
                                </div>
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                </div>
                            </div>
                        </div>
                        <h5 class="title">
                            <a class="link" href="blog-detail.html">How Technology is Transforming the Industry</a>
                        </h5>
                        <p>Advancements are revolutionizing the fashion industry, from production to retail.</p>
                        <a href="blog-detail.html" class="link text-button bot-button">Read More</a>
                    </div>
                </div>
                <div class="wg-blog style-row hover-image mb_40">
                    <div class="image">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-list-2.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-list-2.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-10">
                            <div class="meta">
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-calendar"></i>
                                    </div>
                                    <p class="text-caption-1">February 28, 2024</p>
                                </div>
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                </div>
                            </div>
                        </div>
                        <h5 class="title">
                            <a class="link" href="blog-detail.html">The Future of Fashion How Technology Transforms the Industry</a>
                        </h5>
                        <p>Discover the ways in which technological fashion industry, from production to retail.</p>
                        <a href="blog-detail.html" class="link text-button bot-button">Read More</a>
                    </div>
                </div>
                <div class="wg-blog style-row hover-image mb_40">
                    <div class="image">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-list-3.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-list-3.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-10">
                            <div class="meta">
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-calendar"></i>
                                    </div>
                                    <p class="text-caption-1">February 28, 2024</p>
                                </div>
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                </div>
                            </div>
                        </div>
                        <h5 class="title">
                            <a class="link" href="blog-detail.html">From Concept to Closet The Journey of Sustainable Fashion</a>
                        </h5>
                        <p>From initial design concepts to the final products in your wardrobe, and learn about eco-friendly practices.</p>
                        <a href="blog-detail.html" class="link text-button bot-button">Read More</a>
                    </div>
                </div>
                <div class="wg-blog style-row hover-image mb_40">
                    <div class="image">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-list-4.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-list-4.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-10">
                            <div class="meta">
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-calendar"></i>
                                    </div>
                                    <p class="text-caption-1">February 28, 2024</p>
                                </div>
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                </div>
                            </div>
                        </div>
                        <h5 class="title">
                            <a class="link" href="blog-detail.html">Unlocking Style Potential Personalization in Fashion Retail</a>
                        </h5>
                        <p>Learn how personalized shopping experiences are changing the landscape of online fashion...</p>
                        <a href="blog-detail.html" class="link text-button bot-button">Read More</a>
                    </div>
                </div>
                <div class="wg-blog style-row hover-image mb_40">
                    <div class="image">
                        <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-list-5.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-list-5.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-10">
                            <div class="meta">
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-calendar"></i>
                                    </div>
                                    <p class="text-caption-1">February 28, 2024</p>
                                </div>
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                </div>
                            </div>
                        </div>
                        <h5 class="title">
                            <a class="link" href="blog-detail.html">Fashion Forward Embracing Diversity and Inclusion in Design</a>
                        </h5>
                        <p>Understand the importance of diversity and inclusion in fashion design and how it is shaping the...</p>
                        <a href="blog-detail.html" class="link text-button bot-button">Read More</a>
                    </div>
                </div>
                <ul class="wg-pagination">
                    <li>
                        <a href="#" class="pagination-item text-button">1</a>
                    </li>
                    <li class="active">
                        <div class="pagination-item text-button">2</div>
                    </li>
                    <li>
                        <a href="#" class="pagination-item text-button">3</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div class="sidebar maxw-360">
                    <div class="sidebar-item sidebar-search">
                        <form class="form-search">
                            <fieldset class="text">
                                <input type="email" placeholder="Your email address" class="" name="email" tabindex="0" value="" aria-required="true" required="">
                            </fieldset>
                            <button class="" type="submit">
                                <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="sidebar-item sidebar-relatest-post">
                        <h5 class="sidebar-heading">Relatest Post</h5>
                        <div>
                            <div class="relatest-post-item hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/sidebar-1.jpg') }}" src="{{ asset('public/frontend/images/blog/sidebar-1.jpg') }}" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <div class="icon">
                                                <i class="icon-user"></i>
                                            </div>
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <h6 class="title fw-5">
                                        <a class="link" href="blog-detail.html">The Ultimate Guide: Dressing Stylishly with Minimal Effort</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="relatest-post-item style-row hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/sidebar-2.jpg') }}" src="{{ asset('public/frontend/images/blog/sidebar-2.jpg') }}" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div class="title text-title">
                                        <a class="link" href="blog-detail.html">10 Must-Have Wardrobe Staples for Every Season</a>
                                    </div>
                                </div>
                            </div>
                            <div class="relatest-post-item style-row hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/sidebar-3.jpg') }}" src="{{ asset('public/frontend/images/blog/sidebar-3.jpg') }}" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div class="title text-title">
                                        <a class="link" href="blog-detail.html">How to Transition Your Wardrobe from Day to Night</a>
                                    </div>
                                </div>
                            </div>
                            <div class="relatest-post-item style-row hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/sidebar-4.jpg') }}" src="{{ asset('public/frontend/images/blog/sidebar-4.jpg') }}" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div class="title text-title">
                                        <a class="link" href="blog-detail.html">How to Incorporate Classic Pieces into Modern Outfits</a>
                                    </div>
                                </div>
                            </div>
                            <div class="relatest-post-item style-row hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/sidebar-5.jpg') }}" src="{{ asset('public/frontend/images/blog/sidebar-5.jpg') }}" alt="">
                                </div>
                                <div class="content">
                                    <div class="meta">
                                        <div class="meta-item gap-8">
                                            <p class="text-caption-1">February 28, 2024</p>
                                        </div>
                                        <div class="meta-item gap-8">
                                            <p class="text-caption-1">by <a class="link" href="#">Themesflat</a></p>
                                        </div>
                                    </div>
                                    <div class="title text-title">
                                        <a class="link" href="blog-detail.html">How to Wear the Latest Fashion Trends Every Day</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-item sidebar-categories">
                        <h5 class="sidebar-heading">Categories</h5>
                        <ul>
                            <li>
                                <a class="text-button link" href="#">Trending</a>
                            </li>
                            <li>
                                <a class="text-button link" href="#">Fashion</a>
                            </li>
                            <li>
                                <a class="text-button link" href="#">Outfit</a>
                            </li>
                            <li>
                                <a class="text-button link" href="#">Accessories</a>
                            </li>
                            <li>
                                <a class="text-button link" href="#">Beauty</a>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-item sidebar-tag">
                        <h5 class="sidebar-heading">Popular Tag</h5>
                        <ul class="list-tags">
                            <li>
                                <a href="#" class="text-caption-1 link">Fashion Trends</a>
                            </li>
                            <li>
                                <a href="#" class="text-caption-1 link">Sustainable Fashion</a>
                            </li>
                            <li>
                                <a href="#" class="text-caption-1 link">Street Style</a>
                            </li>
                            <li>
                                <a href="#" class="text-caption-1 link">Beauty Tips</a>
                            </li>
                            <li>
                                <a href="#" class="text-caption-1 link">Street Style</a>
                            </li>
                            <li>
                                <a href="#" class="text-caption-1 link">Vintage Fashion</a>
                            </li>
                            <li>
                                <a href="#" class="text-caption-1 link">Eco Friendly</a>
                            </li>
                            <li>
                                <a href="#" class="text-caption-1 link">Tips</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /blog-list -->

@endsection

@push('add-js')
    
@endpush