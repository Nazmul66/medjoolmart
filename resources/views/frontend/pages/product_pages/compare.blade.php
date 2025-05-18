@extends('frontend.layout.master')

@push('add-meta')
    <title>Sazao || About-us Template</title>
@endpush

@push('add-css')

@endpush


@section('body-content')

        <!-- page-title -->
        <div class="page-title" style="background-image: url({{ asset('public/frontend/images/section/page-title.jpg') }});">
            <div class="container">
                <h3 class="heading text-center">Compare Products</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li><a class="link" href="index.html">Homepage</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="shop-default-grid.html">Shop</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>Compare</li>
                </ul>
            </div>
        </div>
        <!-- /page-title -->
        <!-- Section compare product -->
        <section class="flat-spacing">
            <div class="container">
                <div class="tf-compare-table">
                    <div class="tf-compare-row tf-compare-grid">
                        <div class="tf-compare-col d-md-block d-none"></div>
                        <div class="tf-compare-col">
                            <div class="tf-compare-item">
                                <a class="tf-compare-image" href="product-detail.html">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-19.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-19.jpg') }}" alt="img-compare">
                                </a>
                                <div class="tf-compare-content">
                                    <a class="link text-title text-line-clamp-1" href="product-detail.html">V-neck cotton T-shirt</a>
                                    <p class="desc text-caption-1">Clothes, women, T-shirt</p>
                                </div>
                            </div>
                        </div>
                        <div class="tf-compare-col">
                            <div class="tf-compare-item">
                                <a class="tf-compare-image" href="product-detail.html">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-29.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-29.jpg') }}" alt="img-compare">
                                </a>
                                <div class="tf-compare-content">
                                    <a class="link text-title text-line-clamp-1" href="product-detail.html">Ramie shirt with pockets </a>
                                    <p class="desc text-caption-1">Clothes, women, T-shirt</p>
                                </div>
                            </div>
                        </div>
                        <div class="tf-compare-col">
                            <div class="tf-compare-item">
                                <a class="tf-compare-image" href="product-detail.html">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/products/womens/women-1.jpg') }}" src="{{ asset('public/frontend/images/products/womens/women-1.jpg') }}" alt="img-compare">
                                </a>
                                <div class="tf-compare-content">
                                    <a class="link text-title text-line-clamp-1" href="product-detail.html">Ribbed cotton-blend top</a>
                                    <p class="desc text-caption-1">Clothes, women, T-shirt</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-compare-row">
                        <div class="tf-compare-col tf-compare-field d-md-block d-none">
                            <h6>Rating</h6>
                        </div>
                        <div class="tf-compare-col tf-compare-field tf-compare-rate">
                            <div class="list-star">
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                            </div>
                            <span>(1.234)</span>
                        </div>
                        <div class="tf-compare-col tf-compare-field tf-compare-rate">
                            <div class="list-star">
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                            </div>
                            <span>(1.234)</span>
                        </div>
                        <div class="tf-compare-col tf-compare-field tf-compare-rate">
                            <div class="list-star">
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                                <span class="icon icon-star"></span>
                            </div>
                            <span>(1.234)</span>
                        </div>
                    </div>
                    <div class="tf-compare-row">
                        <div class="tf-compare-col tf-compare-field d-md-block d-none">
                            <h6>Price</h6>
                        </div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="price">$68.00</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="price">$68.00</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="price">$68.00</span></div>
                    </div>
                    <div class="tf-compare-row">
                        <div class="tf-compare-col tf-compare-field d-md-block d-none">
                            <h6>Type</h6>
                        </div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="type">Jacket</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="type">Jacket</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="type">Jacket</span></div>
                    </div>
                    <div class="tf-compare-row">
                        <div class="tf-compare-col tf-compare-field d-md-block d-none">
                            <h6>Brand</h6>
                        </div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="brand">Gucci</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="brand">Channel</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="brand">Channel</span></div>
                    </div>
                    <div class="tf-compare-row">
                        <div class="tf-compare-col tf-compare-field d-md-block d-none">
                            <h6>size</h6>
                        </div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="size">X, XS, L, M, XL</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="size">X, XS, L, M, XL</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="size">X, XS, L, M, XL</span></div>
                    </div>
                    <div class="tf-compare-row">
                        <div class="tf-compare-col tf-compare-field d-md-block d-none">
                            <h6>Color</h6>
                        </div>
                        <div class="tf-compare-col tf-compare-field text-center">
                            <div class="list-compare-color justify-content-center">
                                <span class="item bg-pink"></span>
                                <span class="item bg-yellow"></span>
                                <span class="item bg-primary active"></span>
                                <span class="item bg-success"></span>
                                <span class="item bg-warning"></span>
                            </div>
                        </div>
                        <div class="tf-compare-col tf-compare-field text-center">
                            <div class="list-compare-color justify-content-center">
                                <span class="item bg-pink"></span>
                                <span class="item bg-yellow"></span>
                                <span class="item bg-primary active"></span>
                                <span class="item bg-success"></span>
                                <span class="item bg-warning"></span>
                            </div>
                        </div>
                        <div class="tf-compare-col tf-compare-field text-center">
                            <div class="list-compare-color justify-content-center">
                                <span class="item bg-pink"></span>
                                <span class="item bg-yellow"></span>
                                <span class="item bg-primary active"></span>
                                <span class="item bg-success"></span>
                                <span class="item bg-warning"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tf-compare-row">
                        <div class="tf-compare-col tf-compare-field d-md-block d-none">
                            <h6>Metarial</h6>
                        </div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="size">Cotton</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="size">Silk</span></div>
                        <div class="tf-compare-col tf-compare-field text-center"><span class="size">Velvet</span></div>
                    </div>
                    <div class="tf-compare-row">
                        <div class="tf-compare-col tf-compare-field d-md-block d-none">
                            <h6>Add To Cart</h6>
                        </div>
                        <div class="tf-compare-col tf-compare-field tf-compare-viewcart text-center"><a href="shopping-cart.html" class="btn-view-cart">Add To Cart</a></div>
                        <div class="tf-compare-col tf-compare-field tf-compare-viewcart text-center"><a href="shopping-cart.html" class="btn-view-cart">Add To Cart</a></div>
                        <div class="tf-compare-col tf-compare-field tf-compare-viewcart text-center"><a href="shopping-cart.html" class="btn-view-cart">Add To Cart</a></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Section compare product -->

@endsection

@push('add-js')
    
@endpush