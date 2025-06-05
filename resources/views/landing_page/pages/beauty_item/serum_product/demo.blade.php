@extends('landing_page.layout.master')

@push('meta-title')
    Serun Product
@endpush

@push('add-css')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('public/backend/assets/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/assets/css/owl.theme.default.min.css') }}">
<style>

  body {
    font-family: "Hind Siliguri", sans-serif;
  }

</style>

@endpush

@section('body-content')

{{-- Banner Section Start --}}
<section class="banner_section">
  <div class="container text-center py-5">
     <div class="row">
          <div class="header_part">
              <img src="{{ asset('public/landing_page/beauty_product/logo-2.jpg') }}" alt="Dakpakhi Logo" class="mb-3">
              <h2 class="mb-4">DAKPAKHI</h2>
              <p class="lead">BSTI কর্তৃক অনুমোদিত অরিজিনাল পণ্যের একটি বিশ্বস্ত ওয়েবসাইট dakpakhi.com</p>
              <a href="#order" class="btn_custom mb-4">
                <svg aria-hidden="true" class="e-font-icon-svg e-far-hand-point-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M428.8 137.6h-86.177a115.52 115.52 0 0 0 2.176-22.4c0-47.914-35.072-83.2-92-83.2-45.314 0-57.002 48.537-75.707 78.784-7.735 12.413-16.994 23.317-25.851 33.253l-.131.146-.129.148C135.662 161.807 127.764 168 120.8 168h-2.679c-5.747-4.952-13.536-8-22.12-8H32c-17.673 0-32 12.894-32 28.8v230.4C0 435.106 14.327 448 32 448h64c8.584 0 16.373-3.048 22.12-8h2.679c28.688 0 67.137 40 127.2 40h21.299c62.542 0 98.8-38.658 99.94-91.145 12.482-17.813 18.491-40.785 15.985-62.791A93.148 93.148 0 0 0 393.152 304H428.8c45.435 0 83.2-37.584 83.2-83.2 0-45.099-38.101-83.2-83.2-83.2zm0 118.4h-91.026c12.837 14.669 14.415 42.825-4.95 61.05 11.227 19.646 1.687 45.624-12.925 53.625 6.524 39.128-10.076 61.325-50.6 61.325H248c-45.491 0-77.21-35.913-120-39.676V215.571c25.239-2.964 42.966-21.222 59.075-39.596 11.275-12.65 21.725-25.3 30.799-39.875C232.355 112.712 244.006 80 252.8 80c23.375 0 44 8.8 44 35.2 0 35.2-26.4 53.075-26.4 70.4h158.4c18.425 0 35.2 16.5 35.2 35.2 0 18.975-16.225 35.2-35.2 35.2zM88 384c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z"></path></svg>
                অর্ডার করতে ক্লিক করুন</a>
          </div>

          <div class="card_products">
              <div class="card_rows">
                  <img src="{{ asset('public/landing_page/beauty_product/2-2.jpg') }}" alt="Osufi Badsha Serum">
                  <h5 class="mt-3">Osufi Badsha Serum<br>Offer Price: 690/- (<del>990</del>)Tk</h5>
                  <a href="#order" class="btn_custom mt-2">
                    <svg aria-hidden="true" class="e-font-icon-svg e-far-hand-point-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M428.8 137.6h-86.177a115.52 115.52 0 0 0 2.176-22.4c0-47.914-35.072-83.2-92-83.2-45.314 0-57.002 48.537-75.707 78.784-7.735 12.413-16.994 23.317-25.851 33.253l-.131.146-.129.148C135.662 161.807 127.764 168 120.8 168h-2.679c-5.747-4.952-13.536-8-22.12-8H32c-17.673 0-32 12.894-32 28.8v230.4C0 435.106 14.327 448 32 448h64c8.584 0 16.373-3.048 22.12-8h2.679c28.688 0 67.137 40 127.2 40h21.299c62.542 0 98.8-38.658 99.94-91.145 12.482-17.813 18.491-40.785 15.985-62.791A93.148 93.148 0 0 0 393.152 304H428.8c45.435 0 83.2-37.584 83.2-83.2 0-45.099-38.101-83.2-83.2-83.2zm0 118.4h-91.026c12.837 14.669 14.415 42.825-4.95 61.05 11.227 19.646 1.687 45.624-12.925 53.625 6.524 39.128-10.076 61.325-50.6 61.325H248c-45.491 0-77.21-35.913-120-39.676V215.571c25.239-2.964 42.966-21.222 59.075-39.596 11.275-12.65 21.725-25.3 30.799-39.875C232.355 112.712 244.006 80 252.8 80c23.375 0 44 8.8 44 35.2 0 35.2-26.4 53.075-26.4 70.4h158.4c18.425 0 35.2 16.5 35.2 35.2 0 18.975-16.225 35.2-35.2 35.2zM88 384c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z"></path></svg>
                    এখনই অর্ডার করুন</a>
              </div>

              <div class="card_rows">
                  <img src="{{ asset('public/landing_page/beauty_product/4-1-1.jpg') }}" alt="Night Cream Combo">
                  <h5 class="mt-3">Osufi Badsha Serum with Night Cream & Body Oil<br>Offer Price: 990/- (<del>1290</del>)Tk</h5>
                  <a href="#order" class="btn_custom mt-2">
                    <svg aria-hidden="true" class="e-font-icon-svg e-far-hand-point-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M428.8 137.6h-86.177a115.52 115.52 0 0 0 2.176-22.4c0-47.914-35.072-83.2-92-83.2-45.314 0-57.002 48.537-75.707 78.784-7.735 12.413-16.994 23.317-25.851 33.253l-.131.146-.129.148C135.662 161.807 127.764 168 120.8 168h-2.679c-5.747-4.952-13.536-8-22.12-8H32c-17.673 0-32 12.894-32 28.8v230.4C0 435.106 14.327 448 32 448h64c8.584 0 16.373-3.048 22.12-8h2.679c28.688 0 67.137 40 127.2 40h21.299c62.542 0 98.8-38.658 99.94-91.145 12.482-17.813 18.491-40.785 15.985-62.791A93.148 93.148 0 0 0 393.152 304H428.8c45.435 0 83.2-37.584 83.2-83.2 0-45.099-38.101-83.2-83.2-83.2zm0 118.4h-91.026c12.837 14.669 14.415 42.825-4.95 61.05 11.227 19.646 1.687 45.624-12.925 53.625 6.524 39.128-10.076 61.325-50.6 61.325H248c-45.491 0-77.21-35.913-120-39.676V215.571c25.239-2.964 42.966-21.222 59.075-39.596 11.275-12.65 21.725-25.3 30.799-39.875C232.355 112.712 244.006 80 252.8 80c23.375 0 44 8.8 44 35.2 0 35.2-26.4 53.075-26.4 70.4h158.4c18.425 0 35.2 16.5 35.2 35.2 0 18.975-16.225 35.2-35.2 35.2zM88 384c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z"></path></svg>
                    এখনই অর্ডার করুন</a>
              </div>
          </div>
     </div>
  </div>
</section>
{{-- Banner Section End --}}


{{-- Product Description Start --}}
<section class="benefits_use_section">
  <div class="container">
    <div class="row">
      <div class="benefits_use_measurement">
          <h3 class="text-center mb-4">Osufi Badsha Serum ব্যবহারের উপকারীতাঃ</h3>

          <div class="benefit_products">
              <div class="benefit_product_script">
                <h4>Osufi Serum ব্যবহারের উপকারীতা</h4>

                <ul>
                  <li>চুল পড়া বন্ধ করে</li>
                  <li>চুল দ্রুত বৃদ্ধি করে</li>
                  <li>চুল ঘন ও মজবুত করে</li>
                  <li>টাক পড়া রোধ করে</li>
                  <li>নতুন চুল গজাতে সহায়তা করে</li>
                  <li>চুলে একটি সুন্দর ঘ্রাণ যুক্ত করে</li>
                </ul>
              </div>
              
              <div class="benefit_product_script">
                <h4>আমাদের কাছে থেকে কোন কিনবেন?</h4>

                <ul>
                  <li>নিঃসন্দেহে প্রাকৃতিক উপাদানে প্রস্তুত</li>
                  <li>কোনো পার্শ্বপ্রতিক্রিয়া নেই</li>
                  <li>পুরুষ ও মহিলাদের জন্য উপযুক্ত</li>
                </ul>
              </div>
          </div>
      </div>
    </div>
  </div>
</section>
{{-- Product Description End --}}



{{-- Product Video Start --}}
<section class="youtube_section">
  <div class="container">
    <h4 class="mb-4">অর্ডার সফলদের ভিডিও বার্তা</h4>
    <div class="row">
        <div class="col-lg-8 offset-lg-2" style="box-shadow: 0px 0px 20px rgba(255,0,0,0.5); padding: 0;">
           <iframe width="560" height="315" src="https://www.youtube.com/embed/ZLx4YmCZa10?si=JKD5eCLHRg8fEGYX" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>

    <div class="text-center mt-4">
      <a href="#order" class="btn_custom mt-2">
        <svg aria-hidden="true" class="e-font-icon-svg e-far-hand-point-right" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M428.8 137.6h-86.177a115.52 115.52 0 0 0 2.176-22.4c0-47.914-35.072-83.2-92-83.2-45.314 0-57.002 48.537-75.707 78.784-7.735 12.413-16.994 23.317-25.851 33.253l-.131.146-.129.148C135.662 161.807 127.764 168 120.8 168h-2.679c-5.747-4.952-13.536-8-22.12-8H32c-17.673 0-32 12.894-32 28.8v230.4C0 435.106 14.327 448 32 448h64c8.584 0 16.373-3.048 22.12-8h2.679c28.688 0 67.137 40 127.2 40h21.299c62.542 0 98.8-38.658 99.94-91.145 12.482-17.813 18.491-40.785 15.985-62.791A93.148 93.148 0 0 0 393.152 304H428.8c45.435 0 83.2-37.584 83.2-83.2 0-45.099-38.101-83.2-83.2-83.2zm0 118.4h-91.026c12.837 14.669 14.415 42.825-4.95 61.05 11.227 19.646 1.687 45.624-12.925 53.625 6.524 39.128-10.076 61.325-50.6 61.325H248c-45.491 0-77.21-35.913-120-39.676V215.571c25.239-2.964 42.966-21.222 59.075-39.596 11.275-12.65 21.725-25.3 30.799-39.875C232.355 112.712 244.006 80 252.8 80c23.375 0 44 8.8 44 35.2 0 35.2-26.4 53.075-26.4 70.4h158.4c18.425 0 35.2 16.5 35.2 35.2 0 18.975-16.225 35.2-35.2 35.2zM88 384c0 13.255-10.745 24-24 24s-24-10.745-24-24 10.745-24 24-24 24 10.745 24 24z"></path></svg>
        এখনই অর্ডার করুন</a>
    </div>
  </div>
</section>
{{-- Product Video ENd --}}



{{-- Customer Contact Start --}}
<section class="communicate_section">
  <div class="container">
    <div class="row">
       <div class="communicate_details">
        <p>নিয়মিত আপডেট পেতে আমাদের ফেসবুক পেইজর সাথে যুক্ত থাকুন।</p>

        <a href="#order" class="btn_custom mt-2">
          <svg aria-hidden="true" class="e-font-icon-svg e-fab-facebook" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg>
          ফেসবুক পেজ</a>

        <p>নিয়মিত আপডেট পেতে আমাদের ফেসবুক পেইজর সাথে যুক্ত থাকুন।</p>

        <a href="#order" class="btn_custom mt-2">
          <svg aria-hidden="true" class="e-font-icon-svg e-fab-whatsapp" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>
          01717600468</a>
       </div>
    </div>
  </div>
</section>
{{-- Customer Contact End --}}



{{-- Customer Review Carousel Start --}}
<section class="customer_section section-padding text-center">
  <div class="container">
    <h4 class="mb-4">কাস্টোমার রিভিউ</h4>
    <div class="row">

      <div class="owl-carousel owl-theme" id="testimonial">
          <div class="testimonial">
            <img src="{{ asset('public/backend/screenshot/ss-01.jpg') }}" alt="Review 1">
          </div>

          <div class="testimonial">
            <img src="{{ asset('public/backend/screenshot/ss-02.jpg') }}" alt="Review 2">
          </div>

          <div class="testimonial">
            <img src="{{ asset('public/backend/screenshot/ss-03.jpg') }}" alt="Review 3">
          </div>

          <div class="testimonial">
            <img src="{{ asset('public/backend/screenshot/ss-02.jpg') }}" alt="Review 2">
          </div>
      </div>

    </div>
  </div>
</section>
{{-- Customer Review Carousel End --}}



{{-- Checkout Process Start --}}
<section class="checkout_form_section mb-5">
  <div class="container">
    <div class="row">
        <h4 class="text-center mb-4">অর্ডার করতে নিচের তথ্য দিয়ে ফর্মটি পূরণ করুন</h4>
        
        <div class="checkout_form">
            <h3 class="mb-3">কম্বো সিলেক্ট করুন</h3>

            <div class="product_select_list">
              <div class="product_single_list">
                 <input type="radio" name="" id="" checked>
                 <img src="{{ asset('public/landing_page/beauty_product/2-2.jpg') }}" alt="">

                  <!-- Title + Quantity -->
                  <div class="product-title-qty">
                    <span class="product-title">demo × <span>1</span></span>

                    <div class="wrap_quantity">
                      <div class="quantity">
                          <button>-</button>
                          <input type="text" value="1" />
                          <button>+</button>
                      </div>

                      <div class="product-price">
                        ৳100.00
                      </div>
                    </div>
                  </div>
              </div>
            </div>

            <div class="row">
               <div class="col-lg-6">
                  <div class="billing_address">
                      <h3 class="mb-4">Billing details</h3>

                      <div class="mb-3">
                        <label for="name" class="form-label mb-1">আপনার নাম *</label>
                        <input type="text" class="form-control" id="name" name="name">
                      </div>

                      <div class="mb-3">
                        <label for="address" class="form-label mb-1">আপনার সম্পূর্ণ ঠিকানা *</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="House Number and Street name">
                      </div>

                      <div class="lg:mb-5 mb-3">
                        <label for="phone" class="form-label mb-1">আপনার মোবাইল নাম্বার *</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                      </div>

                      <div class="lg:mb-3 mb-5">
                        <label for="Shipping" class="form-label mb-1" style="font-size: 22px;">Shipping</label>
                        <select class="form-select" aria-label="Default select example">
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                      </div>
                  </div>
               </div>


               <div class="col-lg-6">
                  <div class="order_details">
                      <h3 class="lg:mb-4 mb-3">Your order</h3>

                      <table class="shop_table">
                        <thead>
                          <tr>
                            <th class="product-name">Product</th>
                            <th class="product-total">Subtotal</th>
                          </tr>
                        </thead>

                        <tbody>
                            <tr>
                              <td class="product-name">
                                  <div class="d-flex gap-3 align-items-center justify-content-between">
                                      <div class="d-flex gap-3 align-items-center">
                                          <img src="{{ asset('public/landing_page/beauty_product/2-2.jpg') }}" alt="" style="width: 50px; border-radius: 6px;">
                                          <span class="text-black" style="font-weight: 600">demo</span>
                                      </div>

                                      <strong>x <span class="qty">1</span></strong>
                                  </div>
                              </td>

                              <td class="product-total">
                                  <strong><span>৳100.00</span></strong>
                              </td>
                            </tr>

                            <tr>
                              <td class="product-name">
                                   Subtotal
                              </td>

                              <td class="product-total">
                                  <strong><span>৳100.00</span></strong>
                              </td>
                            </tr>

                            <tr>
                              <td class="product-name">
                                  (+) Shipping
                              </td>

                              <td class="product-total">
                                  <strong><span>৳0.00</span></strong>
                              </td>
                            </tr>

                            <tr>
                              <td class="product-name">
                                  <strong>Total</strong>
                              </td>

                              <td class="product-total">
                                  <strong><span>৳100.00</span></strong>
                              </td>
                            </tr>
                        </tbody>
                      </table>

                      <div class="payment_process">
                        <ul>
                          <li>
                            <label style="cursor: pointer;">
                              <input type="radio" name="checkout" value="cod" checked>
                                Cash on delivery
                            </label>
                            <div class="desc-box active" id="desc-cod">
                                Pay with cash upon delivery.
                            </div>
                          </li>

                          {{-- <li>
                            <label  style="cursor: pointer;">
                              <input type="radio" name="checkout" value="bkash">
                              bKash <img src="{{ asset('public/landing_page/bkash.png') }}" class="payment-logo" alt="bKash logo">
                            </label>
                            <div class="desc-box" id="desc-bkash">
                                Pay with your bKash account.
                            </div>
                          </li> --}}
                        </ul>
                      
                        <div class="privacy-note">
                            Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
                        </div>
                      
                        <button class="place-order">🛒 Place Order ৳100.00</button>
                      </div>
                      
                  </div>
             </div>
            </div>
        </div>
    </div>
  </div>
</section>
{{-- Checkout Process End --}}

@endsection


@push('add-js')

  <!-- Jquery JS File -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- Owl Carousel JS File -->
  <script src="{{ asset('public/backend/assets/js/owl.carousel.min.js') }}"></script>

  <script>
      $('#testimonial').owlCarousel({
          loop:true,
          margin:60,
          nav: true,
          dots: false,
          autoplay: true,
          autoplayTimeout: 5000,
          autoplayHoverPause: true,
          navText: ['<i class="fa-solid fa-arrow-left"></i>' , '<i class="fa-solid fa-arrow-right"></i>'],
          responsive:{
              0:{
                  nav: true,
                  items:1
              },
              780:{
                  nav: true,
                  items: 2
              },
              1000:{
                  nav: true,
                  items:3,
              },
          }
      })


      const radios = document.querySelectorAll('input[name="checkout"]');
      const descriptions = {
        cod: document.getElementById('desc-cod'),
        bkash: document.getElementById('desc-bkash'),
      };

      radios.forEach(radio => {
        radio.addEventListener('change', () => {
          Object.values(descriptions).forEach(desc => desc.classList.remove('active'));
          descriptions[radio.value].classList.add('active');
        });
      });
  </script>

@endpush
