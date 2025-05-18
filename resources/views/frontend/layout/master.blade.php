
<!DOCTYPE html>
<html lang="en-US">

<head>
    @include('frontend.include.css') 
</head>

<body class="preload-wrapper">

    {{-- @include('frontend.include.scroll_preloader')  --}}

    <div id="wrapper">
        <!-- Top Bar -->
            {{-- @include('frontend.include.topbar') --}}
        <!-- /Top Bar -->

        <!-- Header -->
            @include('frontend.include.header')
        <!-- /Header -->

        
            <!-- Main Body Content  -->

                @yield('body-content')
                
            <!-- Main Body Content  -->


        <!-- Footer -->
            @include('frontend.include.footer')
        <!-- /Footer -->

        <!-- toolbar-bottom -->
            @include('frontend.include.toolbar_bottom')
        <!-- /toolbar-bottom -->

    </div>

    <!-- search -->
        @include('frontend.include.search')
    <!-- /search -->

    {{-- <!-- modalDemo -->
    <div class="modal fade modalDemo" id="modalDemo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="mega-menu">
                    <div class="row-demo">
                        <div class="demo-item">
                            <a href="index.html">
                                <div class="demo-image position-relative">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-womenswear.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-womenswear.jpg') }}" alt="home-fashion-womenswear">
                                    <div class="demo-label">
                                        <span class="demo-new">New</span>
                                        <span>Trend</span>
                                    </div>
                                </div>
                                <span class="demo-name">Fashion Womenswear</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-eleganceNest.html">
                                <div class="demo-image position-relative">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-eleganceNest.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-eleganceNest.jpg') }}" alt="home-fashion-eleganceNest">
                                    <div class="demo-label">
                                        <span class="demo-new">New</span>
                                        <span class="demo-hot">Hot</span>
                                    </div>
                                </div>
                                <span class="demo-name">Fashion EleganceNest</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-main.html">
                                <div class="demo-image position-relative">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-main.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-main.jpg') }}" alt="home-fashion-main">
                                    <div class="demo-label">
                                        <span class="demo-hot">Hot</span>
                                    </div>
                                </div>
                                <span class="demo-name">Fashion Main</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-trendset.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-trendset.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-trendset.jpg') }}" alt="home-fashion-trendset">
                                </div>
                                <span class="demo-name">Fashion TrendsetHome</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-vogueLing.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-vogueLiving.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-vogueLiving.jpg') }}" alt="home-fashion-vogueLiving">
                                </div>
                                <span class="demo-name">Fashion VogueLiving</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-elegantAbode.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-elegantAbode.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-elegantAbode.jpg') }}" alt="home-fashion-elegantAbode">
                                </div>
                                <span class="demo-name">Fashion ElegantAbode</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-glamDwell.html">
                                <div class="demo-image position-relative">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-glamDwell.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-glamDwell.jpg') }}" alt="home-fashion-glamDwell">
                                    <div class="demo-label">
                                        <span class="demo-new">New</span>
                                    </div>
                                </div>
                                <span class="demo-name">Fashion GlamDwell</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-classyCove.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-classycove.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-classycove.jpg') }}" alt="home-fashion-classyCove">
                                </div>
                                <span class="demo-name">Fashion ClassyCove</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-chicHaven.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-chicHaven.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-chicHaven.jpg') }}" alt="home-fashion-chicHaven1">
                                </div>
                                <span class="demo-name">Fashion ChicHaven 1</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-chicHaven-02.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-chicHaven2.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-chicHaven2.jpg') }}" alt="home-fashion-chicHaven2">
                                </div>
                                <span class="demo-name">Fashion ChicHaven 2</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-tiktok.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-tiktok.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-tiktok.jpg') }}" alt="home-fashion-tiktok">
                                </div>
                                <span class="demo-name">Fashion TikTok</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-luxeLiving.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-luxeLiving.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-luxeLiving.jpg') }}" alt="home-fashion-luxeLiving">
                                </div>
                                <span class="demo-name">Fashion LuxeLiving</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-fashion-modernRetreat.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-fashion-modernRetreat.jpg') }}" src="{{ asset('public/frontend/images/demo/home-fashion-modernRetreat.jpg') }}" alt="home-fashion-modernRetreat">
                                </div>
                                <span class="demo-name">Fashion ModernRetreat</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-beauty.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-beauty.jpg') }}" src="{{ asset('public/frontend/images/demo/home-beauty.jpg') }}" alt="home-beauty">
                                </div>
                                <span class="demo-name">Beauty</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-skincare.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-skinCare.jpg') }}" src="{{ asset('public/frontend/images/demo/home-skinCare.jpg') }}" alt="home-skincare">
                                </div>
                                <span class="demo-name">Skin Care</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-cosmetic.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-cosmetic.jpg') }}" src="{{ asset('public/frontend/images/demo/home-cosmetic.jpg') }}" alt="home-cosmetic">
                                </div>
                                <span class="demo-name">Cosmetic</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-decor.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-decor.jpg') }}" src="{{ asset('public/frontend/images/demo/home-decor.jpg') }}" alt="home-decor">
                                </div>
                                <span class="demo-name">Decor</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-furniture.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-furniture.jpg') }}" src="{{ asset('public/frontend/images/demo/home-furniture.jpg') }}" alt="home-furniture">
                                </div>
                                <span class="demo-name">Furniture</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-jewelry-01.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-jewelry.jpg') }}" src="{{ asset('public/frontend/images/demo/home-jewelry.jpg') }}" alt="home-jewelry-elegantGems">
                                </div>
                                <span class="demo-name">Jewelry ElegantGems</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-jewelry-02.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-jewelry2.jpg') }}" src="{{ asset('public/frontend/images/demo/home-jewelry2.jpg') }}" alt="home-jewelry-glitterGlam">
                                </div>
                                <span class="demo-name">Jewelry GlitterGlam</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-activewear.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-activewear.jpg') }}" src="{{ asset('public/frontend/images/demo/home-activewear.jpg') }}" alt="home-activewear">
                                </div>
                                <span class="demo-name">Activewear</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-organic.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-organic.jpg') }}" src="{{ asset('public/frontend/images/demo/home-organic.jpg') }}" alt="home-organic">
                                </div>
                                <span class="demo-name">Organic</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-sock.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-sock.jpg') }}" src="{{ asset('public/frontend/images/demo/home-sock.jpg') }}" alt="home-sock">
                                </div>
                                <span class="demo-name">Socks</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-camping.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-camping.jpg') }}" src="{{ asset('public/frontend/images/demo/home-camping.jpg') }}" alt="home-camping">
                                </div>
                                <span class="demo-name">Camping</span>
                            </a>
                        </div>
                        <div class="demo-item active">
                            <a href="home-electronic.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-electronic.jpg') }}" src="{{ asset('public/frontend/images/demo/home-electronic.jpg') }}" alt="home-electronic">
                                </div>
                                <span class="demo-name">Electronic Market</span>
                            </a>
                        </div>
                        <div class="demo-item">
                            <a href="home-pet-store.html">
                                <div class="demo-image">
                                    <img class="lazyload" data-src="{{ asset('public/frontend/images/demo/home-pet-store.jpg') }}" src="{{ asset('public/frontend/images/demo/home-pet-store.jpg') }}" alt="home-pet-store">
                                </div>
                                <span class="demo-name">Pet Store</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /modalDemo --> --}}

    <!-- mobile menu -->
        @include('frontend.include.mobile_menu')
    <!-- /mobile menu -->

    <!-- Categories Mobile Sidebar -->
        @include('frontend.include.categories_sidebar')
    <!-- /Categories Mobile Sidebar -->

    <!-- quickView -->
        @include('frontend.include.product_quick_view')
    <!-- /quickView -->

    <!-- shoppingCart Sidebar -->
        @include('frontend.include.cart_sidebar')
    <!-- /shoppingCart Sidebar -->

    <!-- wishlist Mobile Sidebar -->
        {{-- @include('frontend.include.wishlist_sidebar') --}}
    <!-- /wishlist Mobile Sidebar -->

    <!-- size-guide -->
    {{-- <div class="modal fade modal-size-guide" id="size-guide">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content widget-tabs style-2">
                <div class="header">
                    <ul class="widget-menu-tab">
                        <li class="item-title active">
                            <span class="inner text-button">Size </span>
                        </li>
                        <li class="item-title">
                            <span class="inner text-button">Size Guide</span>
                        </li>
                    </ul>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="widget-content-tab">
                        <div class="widget-content-inner active">
                            <div class="tab-size">
                                <div>
                                    <div class="widget-size mb_16">
                                        <div class="box-title-size">
                                            <div class="title-size">Height</div>
                                            <div class="number-size">
                                                <span class="max-size">100</span>
                                                <span class="text-caption-1 text-secondary">Cm</span>
                                            </div>
                                        </div>
                                        <div class="range-input">
                                            <div class="tow-bar-block">
                                                <div class="progress-size" style="width: 50%;"></div>
                                            </div>
                                            <input type="range" min="0" max="200" value="100" class="range-max" />
                                        </div>
                                    </div>
                                    <div class="widget-size">
                                        <div class="box-title-size">
                                            <div class="title-size">Weight</div>
                                            <div class="number-size">
                                                <span class="max-size">50</span>
                                                <span class="text-caption-1 text-secondary">Kg</span>
                                            </div>
                                        </div>
                                        <div class="range-input">
                                            <div class="tow-bar-block">
                                                <div class="progress-size" style="width: 50%;"></div>
                                            </div>
                                            <input type="range" min="0" max="100" value="50" class="range-max" />
                                        </div>
                                    </div>
                                </div>
                                <div class="size-button-wrap choose-option-list">
                                    <div class="size-button-item choose-option-item">
                                        <h5>thin</h5>
                                    </div>
                                    <div class="size-button-item choose-option-item select-option">
                                        <h5>Normal</h5>
                                    </div>
                                    <div class="size-button-item choose-option-item">
                                        <h5>plump</h5>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="suggests-title">Modave suggests for you:</h6>
                                    <div class="suggests-list">
                                        <a href="#" class="suggests-item link text-button">L - shirt</a>
                                        <a href="#" class="suggests-item link text-button">XL - Pant</a>
                                        <a href="#" class="suggests-item link text-button">31 - Jeans</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-inner">
                            <table class="tab-sizeguide-table">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>US</th>
                                        <th>Bust</th>
                                        <th>Waist</th>
                                        <th>Low Hip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>XS</td>
                                        <td>2</td>
                                        <td>32</td>
                                        <td>24 - 25</td>
                                        <td>33 - 34</td>
                                    </tr>
                                    <tr>
                                        <td>S</td>
                                        <td>4</td>
                                        <td>26 - 27</td>
                                        <td>34 - 35</td>
                                        <td>35 - 26</td>
                                    </tr>
                                    <tr>
                                        <td>M</td>
                                        <td>6</td>
                                        <td>28 - 29</td>
                                        <td>36 - 37</td>
                                        <td>38 - 40</td>
                                    </tr>
                                    <tr>
                                        <td>L</td>
                                        <td>8</td>
                                        <td>30 - 31</td>
                                        <td>38 - 29</td>
                                        <td>42 - 44</td>
                                    </tr>
                                    <tr>
                                        <td>XL</td>
                                        <td>10</td>
                                        <td>32 - 33</td>
                                        <td>40 - 41</td>
                                        <td>45 - 47</td>
                                    </tr>
                                    <tr>
                                        <td>XXL</td>
                                        <td>12</td>
                                        <td>34 - 35</td>
                                        <td>42 - 43</td>
                                        <td>48 - 50</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- /size-guide -->

    {{-- <!-- compare -->
        @include('frontend.include.compare_modal')
    <!-- /compare --> --}}

    <!-- Product quickAdd -->
        @include('frontend.include.product_quick_add')
    <!-- /Product quickAdd -->

    <!-- Javascript -->
    @include('frontend.include.script')

</body>

</html>