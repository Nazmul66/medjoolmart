@extends('frontend.layout.master')

@push('add-meta')
    <title>Sazao || About-us Template</title>
@endpush

@push('add-css')

@endpush


@section('body-content')

<!-- blog-detail -->
<section class="flat-spacing">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-lg-30">
                <div class="blog-detail-wrap page-single-2">
                    <div class="inner">
                        <div class="heading">
                            <ul class="list-tags has-bg">
                                <li>
                                    <a href="#" class="link">Fashion Trends</a>
                                </li>
                            </ul>
                            <h3 class="fw-5">The Future of Fashion How Technology Transforms the Industry</h3>
                            <div class="meta">
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-calendar"></i>
                                    </div>
                                    <p class="body-text-1">February 28, 2024</p>
                                </div>
                                <div class="meta-item gap-8">
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                    <p class="body-text-1">by <a class="link" href="#">Themesflat</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="image">
                            <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-details-2.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-details-2.jpg') }}" alt="">
                        </div>
                        <div class="content">
                            <p class="body-text-1 mb_12">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi interdum sed mauris eu imperdiet. Donec congue orci nec mi luctus, ut faucibus mauris scelerisque. Donec orci lorem, volutpat a mauris nec, sodales imperdiet
                                urna. Sed dictum enim libero. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas ligula libero, pharetra non dolor et, tempor bibendum magna. Mauris a efficitur nisi.</p>
                            <p class="body-text-1">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae mattis gravida, purus sapien interdum magna, convallis volutpat est turpis pulvinar dui. Aenean eu turpis est. In hac habitasse platea dictumst.
                                Integer at lobortis metus. Proin molestie eget massa vel gravida. Suspendisse nec ante vel </p>
                        </div>
                        <div class="group-image d-flex gap-20">
                            <div>
                                <img src="{{ asset('public/frontend/images/blog/blog-details-3.jpg') }}" alt="">
                            </div>
                            <div>
                                <img src="{{ asset('public/frontend/images/blog/blog-details-4.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="content">
                            <h3 class="fw-5 mb_16">How to deal with employee quitting</h3>
                            <p class="body-text-1 mb_16">Donec eu dui condimentum, laoreet nulla vitae, venenatis ipsum. Donec luctus sem sit amet varius laoreet. Aliquam fermentum sit amet urna fringilla tincidunt. Vestibulum ullamcorper nec lacus ac molestie. Curabitur
                                congue neque sed nisi auctor consequat. Pellentesque rhoncus tortor vitae ipsum sagittis tempor.</p>
                            <p class="body-text-1 mb_16">Vestibulum et pharetra arcu. In porta lobortis turpis. Ut faucibus fermentum posuere. Suspendisse potenti. Mauris a metus sed est semper vestibulum. Mauris tortor sem, consectetur vehicula vulputate id, suscipit vel
                                leo.</p>
                            <ul class="list-text type-disc mb_16">
                                <li class="body-text-1">
                                    15+ years of industry experience designing, building, and supporting large-scale distributed systems in production, with recent experience in building large scale cloud services.
                                </li>
                                <li class="body-text-1">
                                    Deep knowledge and experience with different security areas like identity and access management, cryptography, network security, etc.
                                </li>
                                <li class="body-text-1">
                                    Experience with database systems and database internals, such as query engines and optimizers are a big plus.
                                </li>
                                <li class="body-text-1">
                                    Strong fundamentals in computer science skills.
                                </li>
                                <li class="body-text-1">
                                    Expert-level development skills in Java or C++.
                                </li>
                                <li class="body-text-1">
                                    Knowledge of industry standard security concepts and protocols like SAML, SCIM, OAuth, RBAC, cryptography is a plus.
                                </li>
                                <li class="body-text-1">
                                    Advanced degree in Computer Science or related degree.
                                </li>
                                <li class="body-text-1">
                                    Ph.D. in the related field is a plus
                                </li>
                            </ul>
                            <p class="body-text-1 mb_16">Curabitur aliquam ac arcu in mattis. Phasellus pulvinar erat at aliquam hendrerit. Nam ut velit dolor. Sed fermentum tempus odio, ac faucibus elit scelerisque consequat. Fusce ac malesuada elit. Nam at aliquam libero,
                                quis lacinia erat. In hac habitasse platea dictumst. Suspendisse id dolor orci. Vivamus at aliquam tellus. Vestibulum a augue ac purus suscipit varius non eget lectus. Nam lobortis mauris luctus tristique feugiat.
                                Nulla eleifend risus sit amet nisi feugiat, id eleifend sapien malesuada. Phasellus venenatis convallis mattis. Duis vel tempor eros. Mauris semper sollicitudin neque, imperdiet ultrices urna maximus id.
                            </p>
                        </div>
                        <div class="bot d-flex justify-content-between gap-10 flex-wrap">
                            <ul class="list-tags has-bg">
                                <li>Tag:</li>
                                <li>
                                    <a href="#" class="link">Fashion</a>
                                </li>
                                <li>
                                    <a href="#" class="link">Trending</a>
                                </li>
                            </ul>
                            <div class="d-flex align-items-center justify-content-between gap-16">
                                <p>Share this post:</p>
                                <ul class="tf-social-icon style-1">
                                    <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                    <li><a href="#" class="social-twiter"><i class="icon icon-x"></i></a></li>
                                    <li><a href="#" class="social-pinterest"><i class="icon icon-pinterest"></i></a></li>
                                    <li><a href="#" class="social-instagram"><i class="icon icon-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="related-post">
                            <div class="pre w-50">
                                <div class="text-btn-uppercase">
                                    <a href="#">Previous</a>
                                </div>
                                <h6 class="fw-5">
                                    <a class="link" href="#">How to choose the right customer</a>
                                </h6>
                            </div>
                            <div class="next w-50">
                                <div class="text-btn-uppercase text-end">
                                    <a href="#">Next</a>
                                </div>
                                <h6 class="fw-5 text-end">
                                    <a class="link" href="#">Starting your traveling blog with Vasco</a>
                                </h6>
                            </div>
                        </div>
                        <div class="reply-comment">
                            <h4 class="reply-comment-heading">03 Comments</h4>
                            <div class="reply-comment-wrap">
                                <div class="reply-comment-item">
                                    <div class="image">
                                        <img src="{{ asset('public/frontend/images/avatar/user-1.jpg') }}" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="d-flex justify-content-between gap-10 flex-wrap">
                                            <div>
                                                <div class="d-flex gap-12 align-items-center">
                                                    <h6>
                                                        <a href="#" class="link">Guy Hawkins</a>
                                                    </h6>
                                                    <div class="box-check">
                                                        <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.39644 7.84288L0.146441 4.35628C-0.0488135 4.14681 -0.0488135 3.80718 0.146441 3.59769L0.853531 2.8391C1.04879 2.62961 1.36539 2.62961 1.56064 2.8391L3.75 5.18782L8.43936 0.157101C8.63461 -0.0523671 8.95121 -0.0523671 9.14647 0.157101L9.85356 0.915689C10.0488 1.12516 10.0488 1.46479 9.85356 1.67428L4.10355 7.8429C3.90828 8.05237 3.5917 8.05237 3.39644 7.84288Z" fill="white"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="day text-caption-1">August 13, 2024</div>
                                            </div>
                                            <a class="link btn-style-1 font-3" href="#">Was this helpful? </a>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur. Cursus nunc pharetra arcu quam turpis risus amet turpis. Facilisis elementum tincidunt pellentesque sed rutrum enim.</p>
                                        <div>
                                            <a class="text-button" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="reply-comment-item type-reply">
                                    <div class="image">
                                        <img src="{{ asset('public/frontend/images/avatar/user-2.jpg') }}" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="d-flex justify-content-between gap-10 flex-wrap">
                                            <div>
                                                <div class="d-flex gap-12 align-items-center">
                                                    <h6>
                                                        <a href="#" class="link">Eleanor Pena</a>
                                                    </h6>
                                                    <div class="box-check">
                                                        <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.39644 7.84288L0.146441 4.35628C-0.0488135 4.14681 -0.0488135 3.80718 0.146441 3.59769L0.853531 2.8391C1.04879 2.62961 1.36539 2.62961 1.56064 2.8391L3.75 5.18782L8.43936 0.157101C8.63461 -0.0523671 8.95121 -0.0523671 9.14647 0.157101L9.85356 0.915689C10.0488 1.12516 10.0488 1.46479 9.85356 1.67428L4.10355 7.8429C3.90828 8.05237 3.5917 8.05237 3.39644 7.84288Z" fill="white"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="day text-caption-1">August 13, 2024</div>
                                            </div>
                                            <a class="link btn-style-1 font-3" href="#">Was this helpful? </a>
                                        </div>
                                        <p>Great choice of Acronym AF1’s</p>
                                    </div>
                                </div>
                                <div class="reply-comment-item">
                                    <div class="image">
                                        <img src="{{ asset('public/frontend/images/avatar/user-3.jpg') }}" alt="">
                                    </div>
                                    <div class="content">
                                        <div class="d-flex justify-content-between gap-10 flex-wrap">
                                            <div>
                                                <div class="d-flex gap-12 align-items-center">
                                                    <h6>
                                                        <a href="#" class="link">Jerome Bell</a>
                                                    </h6>
                                                    <div class="box-check">
                                                        <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.39644 7.84288L0.146441 4.35628C-0.0488135 4.14681 -0.0488135 3.80718 0.146441 3.59769L0.853531 2.8391C1.04879 2.62961 1.36539 2.62961 1.56064 2.8391L3.75 5.18782L8.43936 0.157101C8.63461 -0.0523671 8.95121 -0.0523671 9.14647 0.157101L9.85356 0.915689C10.0488 1.12516 10.0488 1.46479 9.85356 1.67428L4.10355 7.8429C3.90828 8.05237 3.5917 8.05237 3.39644 7.84288Z" fill="white"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="day text-caption-1">August 13, 2024</div>
                                            </div>
                                            <a class="link btn-style-1 font-3" href="#">Was this helpful? </a>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet consectetur. Cursus nunc pharetra arcu quam turpis risus amet turpis. Facilisis elementum tincidunt pellentesque sed rutrum enim.</p>
                                        <div>
                                            <a class="text-button" href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="leave-comment">
                            <h4 class="leave-comment-heading">Leave A Comment</h4>
                            <form class="form-leave-comment">
                                <div class="wrap">
                                    <div class="cols">
                                        <fieldset class="">
                                            <input class="" type="text" placeholder="Your Name*" name="text" tabindex="2" value="" aria-required="true" required="">
                                        </fieldset>
                                        <fieldset class="">
                                            <input class="" type="email" placeholder="Your Email*" name="email" tabindex="2" value="" aria-required="true" required="">
                                        </fieldset>
                                    </div>
                                    <fieldset class="">
                                        <textarea class="" rows="4" placeholder="Your Message*" tabindex="2" aria-required="true" required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="button-submit">
                                    <button class="" type="submit">Submit Review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar maxw-360">
                    <div class="sidebar-item sidebar-writer">
                        <div class="writer-avatar">
                            <div class="image">
                                <img src="{{ asset('public/frontend/images/avatar/user-3.jpg') }}" alt="">
                            </div>
                            <div>
                                <div class="name">
                                    <h6><a class="link" href="#">Shara Miller</a></h6>
                                    <p class="text-caption-1">200 Follower</p>
                                </div>
                                <a href="#" class="button-follow text-btn-uppercase link">Follow</a>
                            </div>
                        </div>
                        <div class="writer-content">
                            <p>Jessie Nguyen (@Jessie_ng) is a writer who draws. He’s the Bestselling author of “Number of The Year”. Donec vitae tortor efficitur, convallis lelobortis elit.</p>
                            <ul class="tf-social-icon">
                                <li><a href="#" class="social-facebook"><i class="icon icon-fb"></i></a></li>
                                <li><a href="#" class="social-twiter"><i class="icon icon-x"></i></a></li>
                                <li><a href="#" class="social-instagram"><i class="icon icon-instagram"></i></a></li>
                                <li><a href="#" class="social-tiktok"><i class="icon icon-tiktok"></i></a></li>
                                <li><a href="#" class="social-amazon"><i class="icon icon-amazon"></i></a></li>
                                <li><a href="#" class="social-pinterest"><i class="icon icon-pinterest"></i></a></li>
                            </ul>
                        </div>
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
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /blog-detail -->

<!-- Related Articles -->
<section class="flat-spacing pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading-section">
                    <h3>Related Articles</h3>
                    <p class="body-text-1">Discover the Hottest Fashion News and Trends Straight from the Runway</p>
                </div>
                <div class="swiper tf-sw-recent" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-grid-1.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-grid-1.jpg') }}" alt="">
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
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">How Technology is Transforming the Industry</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-grid-2.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-grid-2.jpg') }}" alt="">
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
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">The Future of Fashion How Technology Transforms the Industry</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-grid-3.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-grid-3.jpg') }}" alt="">
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
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">From Concept to Closet The Journey of Sustainable Fashion</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-grid-2.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-grid-2.jpg') }}" alt="">
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
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">The Future of Fashion How Technology Transforms the Industry</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="wg-blog style-1 hover-image">
                                <div class="image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/blog/blog-grid-3.jpg') }}" src="{{ asset('public/frontend/images/blog/blog-grid-3.jpg') }}" alt="">
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
                                    <div>
                                        <h6 class="title fw-5">
                                            <a class="link" href="blog-detail.html">From Concept to Closet The Journey of Sustainable Fashion</a>
                                        </h6>
                                        <div class="body-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed vulputate massa.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sw-pagination-recent sw-dots type-circle d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Related Articles -->

@endsection

@push('add-js')

@endpush