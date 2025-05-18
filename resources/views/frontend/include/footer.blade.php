<footer id="footer" class="footer bg-main">
    <div class="footer-wrap">
        <div class="footer-body">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="footer-infor">
                            <div class="footer-logo ">
                                <a href="{{ route('home') }}">
                                    @if ( !empty(getSetting()->logo) )
                                        <img src="{{ asset(getSetting()->logo) }}" alt="{{ getSetting()->site_name }}" style="width: 75px;">
                                    @else
                                        <img src="{{ asset('public/frontend/images/logo/logo-white.svg') }}" alt="" style="width: 75px;">
                                    @endif
                                </a>
                            </div>
                            <div class="footer-address">
                                <p>{{ getSetting()->address }}</p>
                                <a href="{{ url('/contact-us') }}" class="tf-btn-default style-white fw-6">GET DIRECTION</a>
                            </div>
                            <ul class="footer-info">
                                <li>
                                    <i class='bx bx-envelope'></i>
                                    @if ( !empty(getSetting()->email) )
                                        <a href="mailto:{{ getSetting()->email }}" style="color: #A0A0A0;">{{ getSetting()->email }}</a>
                                    @else
                                        <a href="mailto:{{ getSetting()->email_optional }}" style="color: #A0A0A0;">{{ getSetting()->email_optional }}</a>
                                    @endif
                                </li>
                                <li>
                                    <i class='bx bx-phone-call'></i>
                                    @if ( !empty(getSetting()->phone) )
                                        <a href="tel:{{ getSetting()->phone }}" style="color: #A0A0A0;">{{ getSetting()->phone }}</a>
                                    @else
                                        <a href="tel:{{ getSetting()->phone_optional }}" style="color: #A0A0A0;">{{ getSetting()->phone_optional }}</a>
                                    @endif
                                </li>
                            </ul>
                            <ul class="tf-social-icon style-white">
                                @if ( !empty(getSetting()->facebook) )
                                    <li>
                                        <a href="{{ getSetting()->facebook }}" class="social-facebook">
                                            <i class='bx bxl-facebook'></i>
                                        </a>
                                    </li>
                                @endif

                                @if ( !empty(getSetting()->twitter) )
                                    <li>
                                       <a href="{{ getSetting()->twitter }}" class="social-twiter">
                                           <i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                    </li>
                                @endif

                                @if ( !empty(getSetting()->quora) )
                                    <li>
                                        <a href="{{ getSetting()->quora }}" class="social-pinterest">
                                            <i class='bx bxl-quora' ></i>
                                        </a>
                                    </li>
                                @endif

                                @if ( !empty(getSetting()->linkedin) )
                                    <li>
                                       <a href="{{ getSetting()->twitter }}" class="social-facebook">
                                            <i class='bx bxl-linkedin' ></i>
                                        </a>
                                    </li>
                                @endif

                                @if ( !empty(getSetting()->youtube) )
                                    <li>
                                        <a href="{{ getSetting()->youtube }}" class="social-pinterest">
                                            <i class="fa-brands fa-youtube"></i>
                                        </a>
                                    </li>
                                @endif

                                @if ( !empty(getSetting()->instagram) )
                                    <li>
                                    <a href="{{ getSetting()->instagram }}" class="social-instagram">
                                            <i class='bx bxl-instagram' ></i>
                                        </a>
                                    </li>
                                @endif


                                @if ( !empty(getSetting()->pinterest) )
                                    <li>
                                        <a href="{{ getSetting()->pinterest }}" class="social-pinterest">
                                            <i class='bx bxl-pinterest-alt' ></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- <li>
                                    <a href="#" class="social-tiktok">
                                        <i class='bx bxl-tiktok'></i>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="footer-menu">
                            <div class="footer-col-block">
                                <div class="footer-heading text-button footer-heading-mobile">
                                    Infomation
                                </div>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        {{-- <li class="text-caption-1">
                                            <a href="{{ route('about.us') }}" class="footer-menu_item">About Us</a>
                                        </li> --}}
                                        <li class="text-caption-1">
                                            <a href="{{ route('wishlist.index') }}" class="footer-menu_item">My Wishlist</a>
                                        </li>

                                        <li class="text-caption-1">
                                            <a href="{{ route('customer.feedback') }}" class="footer-menu_item">Customer Feedback</a>
                                        </li>

                                        <li class="text-caption-1">
                                            <a href="{{ route('faq') }}" class="footer-menu_item">Orders FAQs</a>
                                        </li>

                                        {{-- <li class="text-caption-1">
                                            <a href="#" class="footer-menu_item">Size Guide</a>
                                        </li> --}}

                                        <li class="text-caption-1">
                                            <a href="{{ route('contact.us') }}" class="footer-menu_item">Contact us</a>
                                        </li>

                                         @if ( Auth::Check() )
                                            <li class="text-caption-1">
                                                <a href="{{ route('user.dashboard') }}" class="footer-menu_item">My Account</a>
                                            </li>
                                         @endif
                                    </ul>
                                </div>
                            </div>


                            <div class="footer-col-block">
                                <div class="footer-heading text-button footer-heading-mobile">
                                    Info Links
                                </div>
                                <div class="tf-collapse-content">
                                    <ul class="footer-menu-list">
                                        <li class="text-caption-1">
                                            <a href="{{ route('privacy.policy') }}" class="footer-menu_item">Privacy Policy</a>
                                        </li>

                                        <li class="text-caption-1">
                                            <a href="{{ route('terms.condition') }}" class="footer-menu_item">Terms & Conditions</a>
                                        </li>

                                        <li class="text-caption-1">
                                            <a href="{{ route('return.refund') }}" class="footer-menu_item">Return & Refund</a>
                                        </li>

                                        <li class="text-caption-1">
                                            <a href="{{ route('shipping') }}" class="footer-menu_item">Shipping</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="footer-col-block">
                            <div class="footer-heading text-button footer-heading-mobile">
                                Newletter
                            </div>
                            <div class="tf-collapse-content">
                                <div class="footer-newsletter">
                                    <p class="text-caption-1">Sign up for our newsletter and get discount offers</p>
                                    <div class="sib-form">
                                        <div id="sib-form-container" class="sib-form-container">
                                            <div id="sib-container" class="sib-container--large sib-container--vertical">
                                                <form method="POST" action="{{ route('newsletter.request') }}" class="form-newsletter" id="newsletter_form">
                                                    @csrf
                                                    
                                                    <div>
                                                        <div class="sib-input sib-form-block">
                                                            <div class="form__entry entry_block">
                                                                <div class="form__label-row ">
                                                                    <label class="entry__label" for="EMAIL">
                                                                    </label>

                                                                    <div class="entry__field">
                                                                        <input class="input radius-60 subscribe_input" type="text" id="EMAIL" name="email" autocomplete="off" placeholder="Enter your e-mail..." value="{{ old('email') }}" />
                                                                    </div>
                                                                </div>
                                                                <label class="entry__error entry__error--primary"></label>
                                                                <label class="entry__specification">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <div class="sib-form-block">
                                                            <button class="sib-form-block__button sib-form-block__button-with-loader subscribe-button radius-60" type="submit" id="subscription_btn">
                                                                <i class='bx bx-up-arrow-alt'></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Footer --}}
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-bottom-wrap">
                            <div class="left">
                                <p class="text-caption-1">©{{ date('Y') }} {{ getSetting()->site_name  }}. All Rights Reserved.</p>
                            </div>

                            <div class="tf-payment">
                                <p class="text-caption-1">Payment:</p>
                                <ul>
                                    <li>
                                        <img src="{{ asset('public/frontend/images/payment/bkash_bg.png') }}" alt="">
                                    </li>
                                    <li>
                                        <img src="{{ asset('public/frontend/images/payment/nagad.png') }}" alt="">
                                    </li>
                                    <li>
                                        <img src="{{ asset('public/frontend/images/payment/ssl_commerz.png') }}" alt="">
                                    </li>
                                    {{-- <li>
                                        <img src="{{ asset('public/frontend/images/payment/img-4.png') }}" alt="">
                                    </li>
                                    <li>
                                        <img src="{{ asset('public/frontend/images/payment/img-5.png') }}" alt="">
                                    </li>
                                    <li>
                                        <img src="{{ asset('public/frontend/images/payment/img-6.png') }}" alt="">
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>