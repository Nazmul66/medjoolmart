@php
    $categories = App\Models\Category::where('front_status', 1)->where('status', 1)->get();
@endphp

<header id="header" class="header-default header-style-5 header-white">
    <div class="main-header">
        <div class="container">
            <div class="row wrapper-header align-items-center line-top-rgba container_flex">
                <div class="col-md-6 col-6 d-lg-none d-xl-none">
                    <ul class="mobile_menu_icons">
                        <li class="nav_carts skeleton">
                            <a href="#shoppingCart" data-bs-toggle="modal" class="nav-icon-item">
                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>  
                            <span class="count-box skeleton">{{ Cart::content()->count() }}</span></a>
                        </li>

                        <li>
                            <a href="#mobileMenu" class="mobile-menu skeleton" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                                <i class='bx bx-menu' style="font-size: 28px; color: #181818;"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-6 col-6">
                    <div class="wrapper-header-left justify-content-start justify-content-xl-start">
                        <a href="{{ route('home') }}" class="logo-header skeleton">
                            @if ( !empty(getSetting()->logo) )
                                <img src="{{ asset(getSetting()->logo) }}" alt="logo" class="logo" style="width: 70px;">
                            @else
                                <img src="{{ asset('public/frontend/images/logo/logo-white.svg') }}" alt="logo" class="logo">
                            @endif
                        </a>

                        <div class="d-xl-block d-lg-block d-none">
                            <form action="{{ route('product.page') }}">
                                <div class="form-search-select skeleton" style="border: 2px solid #181818;">
                                    <input type="text" name="search" placeholder="What are you looking for today?" value="{{ request()->search }}">
                                    <button class="tf-btn" type="submit">
                                        <span class="text">Search</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-3">
                    <div class="wrapper-header-right">
                        <div class="d-none d-lg-flex d-xl-flex box-support skeleton">
                            <i class='bx bxs-color' style="font-size: 32px; color: #181818;"></i>
                            <div>
                                <a href="tel: {{ getSetting()->phone_optional ?? getSetting()->phone }}" class="text-title" style="color: #181818;">Hotline: +{{ getSetting()->phone_optional ?? getSetting()->phone }}</a>
                                <div class="text-caption-2" style="color: #181818;">24/7 Support Center</div>
                            </div>
                        </div>

                        {{-- <ul class="nav-icon d-flex justify-content-end align-items-center">
                            <li class="nav-search skeleton d-inline-flex d-xl-none"><a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>    
                            </a></li>
                            <li class="nav-account">
                                <a href="#" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <div class="dropdown-account dropdown-login">
                                    <div class="sub-top">
                                        <a href="{{ route('login') }}" class="tf-btn btn-reset">Login</a>
                                        <p class="text-center text-secondary-2">Don’t have an account? <a href="{{ route('register') }}">Register</a></p>
                                    </div>
                                    <div class="sub-bot">
                                        <span class="body-text-">Support</span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-wishlist"><a href="wish-list.html" class="nav-icon-item">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>  
                                </a>
                            </li>
                            <li class="nav-cart"><a href="#shoppingCart" data-bs-toggle="modal" class="nav-icon-item">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>  
                                <span class="count-box">{{ Cart::content()->count() }}</span></a>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom bg-blue-3 d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="wrapper-header d-flex justify-content-between align-items-center">
                <div class="box-left">
                    <div class="tf-list-categories skeleton">
                        <a href="#" class="categories-title"><i class='bx bxs-dashboard' style="font-size: 24px;"></i><span class="text">Shop By Categories</span> <i class='bx bx-chevron-down' style="font-size: 24px;"></i></a>
                        <div class="list-categories-inner">
                            <ul>
                                @foreach ($categories as $item)
                                    @php
                                        $subCats = App\Models\SubCategory::where('category_id', $item->id)->where('status', 1)->get();
                                    @endphp

                                    <li class="sub-categories2">
                                        <a href="{{ route('product.page', ['categories' => $item->slug]) }}" class="categories-item"><span class="inner-left">
                                            <img src="{{ asset($item->category_img) }}" alt="{{ $item->slug  }}"> 
                                            {{ $item->category_name }}</span>

                                            @if ( $subCats->count() > 0 )
                                                <i class='bx bx-chevron-right' style="font-size: 24px;"></i>
                                            @endif
                                        </a>

                                        @if ( $subCats->count() > 0 )
                                            <ul class="list-categories-inner">
                                                @foreach ($subCats as $row)
                                                    <li>
                                                        <a href="{{ route('product.page', ['sub_categories' => $row->slug]) }}" class="categories-item">
                                                            <span class="inner-left">
                                                                <img src="{{ asset($row->subcategory_img) }}" alt="{{ $row->slug  }}">  
                                                                {{ $row->subcategory_name }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <nav class="box-navigation">
                        <ul class="box-nav-ul d-flex align-items-center">
                            <li class="menu-item {{ isActive('home') }}">
                                <a href="{{ route('home') }}" class="skeleton item-link">Home</a>
                            </li>

                            <li class="menu-item {{ isActive('product.page') }}">
                                <a href="{{ route('product.page') }}" class="skeleton item-link">Shop Page</a>
                            </li>

                            {{-- <li class="menu-item {{ isActive('about.us') }}">
                                <a href="{{ route('about.us') }}" class="skeleton item-link">About Us </a>
                            </li> --}}

                            <li class="menu-item {{ isActive('contact.us') }}">
                                <a href="{{ route('contact.us') }}" class="skeleton item-link">Contact Us </a>
                            </li>

                            <li class="menu-item {{ isActive('track.order') }}">
                                <a href="{{ route('track.order') }}" class="skeleton item-link">Tracking Orders </a>
                            </li>

                            {{-- <li class="menu-item position-relative">
                                <a href="#" class="skeleton item-link">Blog</a>
                            </li> --}}
                        </ul>
                    </nav>
                </div>

                <div class="box-right">
                    {{-- <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                        <div class="btn-select">
                            <i class='bx bx-user' style="font-size: 20px;"></i>
                            <span class="text-sort-value">Nazmul Hassan</span>
                            <i class='bx bx-chevron-down' style="font-size: 24px;"></i>
                        </div>
                        <div class="dropdown-menu">
                            <div class="select-item active">
                                <span class="text-value-item">My Account</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">My Profile</span>
                            </div>
                            <div class="select-item">
                                <span class="text-value-item">Logout</span>
                            </div>

                        </div>
                    </div> --}}

                    <ul class="nav-icon d-flex justify-content-end align-items-center">
                        <li class="nav-search skeleton">
                            <a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>    
                            </a>
                        </li>
                        {{-- <li class="nav-search d-inline-flex d-xl-none"><a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>    
                        </a></li> --}}

                        <li class="nav-account skeleton">
                            <div class="nav-icon-item" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            @if ( Auth::guard('web')->check() )
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">My Account</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard.orders') }}">My Order List</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.dashboard.wishlist') }}">Wishlist</a></li>
                                    <li>
                                        <form method="POST" class="dropdown-item" action="{{ route('logout') }}">
                                            @csrf
                                             
                                            <button type="submit" class="btn btn-primary">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <div class="dropdown-account dropdown-login">
                                    <div class="sub-top">
                                        <a href="{{ route('login') }}" class="tf-btn btn-reset">Login</a>
                                        <p class="text-center text-secondary-2">Don’t have an account? <a href="{{ route('register') }}">Register</a></p>
                                    </div>
                                    {{-- <div class="sub-bot">
                                        <span class="body-text-">Support</span>
                                    </div> --}}
                                </div>
                            @endif
                        </li>
                        
                        <li class="nav-wishlist skeleton">
                            <a href="{{ route('wishlist.index') }}" class="nav-icon-item">
                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>  
                            <span class="wishlist_box skeleton">
                                @if ( !Auth::check() )
                                    0
                                @else
                                    {{ App\Models\Wishlist::where('user_id', Auth::user()->id)->count() }}
                                @endif
                            </span></a>
                        </li>

                        <li class="nav-cart skeleton"><a href="#shoppingCart" data-bs-toggle="modal" class="nav-icon-item">
                            <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>  
                            <span class="count-box skeleton">{{ Cart::content()->count() }}</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>