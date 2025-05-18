<div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
    <i class='bx bx-x icon-close-popup' style="font-size: 32px;" data-bs-dismiss="offcanvas" aria-label="Close"></i>
    <div class="mb-canvas-content">
        <div class="mb-body">
            <div class="mb-content-top">
                {{-- <form class="form-search">
                    <fieldset class="text">
                        <input type="text" placeholder="What are you looking for?" class="" name="text" tabindex="0" value="" aria-required="true" required="">
                    </fieldset>
                    <button class="" type="submit">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.9984 20.9999L16.6484 16.6499" stroke="#181818" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                                
                    </button>
                </form> --}}
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item active">
                        <a href="{{ route('home') }}" class="mb-menu-link">
                            <span>Home</span>
                        </a>

                    </li>
                    <li class="nav-mb-item">
                        <a href="{{ route('product.page') }}" class="mb-menu-link">
                            <span>Shop</span>
                        </a>
                    </li>

                    {{-- <li class="nav-mb-item">
                        <a href="{{ route('product.page') }}" class="mb-menu-link">
                            <span>About Us</span>
                        </a>
                    </li> --}}
                    
                    <li class="nav-mb-item">
                        <a href="{{ route('contact.us') }}" class="mb-menu-link">
                            <span>Contact Us</span>
                        </a>
                    </li>

                    @if ( Auth::check() )
                        <li class="nav-mb-item">
                            <a href="#dropdown-menu-five" class="mb-menu-link collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-five">
                                <span>My Accounts</span>
                                <span class="btn-open-sub"></span>
                            </a>
                            <div id="dropdown-menu-five" class="collapse" style="">
                                <ul class="sub-nav-menu">
                                    <li><a href="{{ route('user.dashboard') }}" class="sub-nav-link">Dashboard</a></li>
                                    <li><a href="{{ route('user.dashboard.profile') }}" class="sub-nav-link">Account Details</a></li>
                                    <li><a href="{{ route('user.dashboard.orders') }}" class="sub-nav-link">Your Orders</a></li>
                                    <li><a href="{{ route('user.dashboard.wishlist') }}" class="sub-nav-link">My Wishlist</a></li>  
                                    <li><a href="{{ route('user.dashboard.review') }}" class="sub-nav-link">Reviews</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    <li class="nav-mb-item">
                        <a href="{{ route('track.order') }}" class="mb-menu-link">
                            <span>Tracking Order</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mb-other-content">
                <div class="group-icon">
                    <a href="{{ route('wishlist.index') }}" class="site-nav-icon">
                        <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Wishlist 
                    </a>

                    @if ( Auth::check() )
                        <form method="POST" class="site-nav-icon" action="{{ route('logout') }}" style="background: transparent; border: none;">
                            @csrf
                            
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route("login") }}" class="site-nav-icon">
                            <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>  
                            Login
                        </a>
                    @endif
                </div>

                <div class="mb-notice">
                    <a href="{{ route('contact.us') }}" class="text-need">Need Help?</a>
                </div>

                <div class="mb-contact">
                    <p class="text-caption-1">{{ getSetting()->address }}</p>
                    <a href="{{ url('/contact-us') }}" class="tf-btn-default text-btn-uppercase">GET DIRECTION<i class='bx bx-right-top-arrow-circle'></i>
                    </a>
                </div>

                <ul class="mb-info">
                    <li>
                        <i class='bx bx-envelope me-2'></i>
                        @if ( !empty(getSetting()->email) )
                            <a href="mailto:{{ getSetting()->email }}" style="color: #A0A0A0;">{{ getSetting()->email }}</a>
                        @else
                            <a href="mailto:{{ getSetting()->email_optional }}" style="color: #A0A0A0;">{{ getSetting()->email_optional }}</a>
                        @endif
                    </li>
                    <li>
                        <i class='bx bx-phone-call me-2'></i>
                        @if ( !empty(getSetting()->phone) )
                            <a href="tel:{{ getSetting()->phone }}" style="color: #A0A0A0;">{{ getSetting()->phone }}</a>
                        @else
                            <a href="tel:{{ getSetting()->phone_optional }}" style="color: #A0A0A0;">{{ getSetting()->phone_optional }}</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        {{-- <div class="mb-bottom">
            <div class="bottom-bar-language">
                <div class="tf-currencies">
                    <select class="image-select center style-default type-currencies">
                        <option selected data-thumbnail="images/country/us.svg">USD</option>
                        <option data-thumbnail="images/country/vn.svg">VND</option>
                    </select>
                </div>
                <div class="tf-languages">
                    <select class="image-select center style-default type-languages">
                        <option>English</option>
                        <option>Vietnam</option>
                    </select>
                </div>
            </div>
        </div> --}}
    </div>
</div>