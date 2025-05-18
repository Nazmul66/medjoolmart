@extends('frontend.layout.master')

@push('add-meta')
    <title>Sazao || About-us Template</title>
@endpush

@push('add-css')

@endpush


@section('body-content')


    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>all brands</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">brands</a></li>
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
        BRANDS PAGE START
    ==============================-->
    <section id="wsus__brands">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_1.jpg') }}" alt="brand" class="img-fluid w-100">
                        <span class="new">new</span>
                        <span class="rating">5 <i class="fas fa-star"></i></span>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_2.jpg') }}" alt="brand" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_3.jpg') }}" alt="brand" class="img-fluid w-100">
                        <span class="new">new</span>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_3.jpg') }}" alt="brand" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_4.jpg') }}" alt="brand" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_5.jpg') }}" alt="brand" class="img-fluid w-100">
                        <span class="new">new</span>
                        <span class="rating">5 <i class="fas fa-star"></i></span>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_6.jpg') }}" alt="brand" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_7.jpg') }}" alt="brand" class="img-fluid w-100">
                        <span class="rating">5 <i class="fas fa-star"></i></span>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_1.jpg') }}" alt="brand" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_2.jpg') }}" alt="brand" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_3.jpg') }}" alt="brand" class="img-fluid w-100">
                        <span class="new">new</span>
                        <span class="rating">5 <i class="fas fa-star"></i></span>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_4.jpg') }}" alt="brand" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_2.jpg') }}" alt="brand" class="img-fluid w-100">
                        <span class="new">new</span>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_3.jpg') }}" alt="brand" class="img-fluid w-100">
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_4.jpg') }}" alt="brand" class="img-fluid w-100">
                        <span class="new">new</span>
                    </a>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <a href="product_grid_view.html" class="wsus__single_brand">
                        <img src="{{ asset('public/frontend/images/brand_logo_7.jpg') }}" alt="brand" class="img-fluid w-100">
                        <span class="rating">5 <i class="fas fa-star"></i></span>
                    </a>
                </div>
                <div class="col-xl-12">
                    <section id="pagination">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link page_active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BRANDS PAGE END
    ==============================-->



@endsection

@push('add-js')

@endpush