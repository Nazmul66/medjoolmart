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

@push('add-css')
   
@endpush

@php
    $time_schedule = json_decode($time_schedule->value, true);
    // dd($time_schedule[0]);
@endphp


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
                <h3 class="heading text-center">Contact Us</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ route('home') }}">Homepage</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>
                        <a class="link" href="javascript:void();">Pages</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>
                        Contact Us
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- Store locations -->
<section class="flat-spacing">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-us-map">
                    <div class="wrap-map skeleton">
                        {!! getSetting()->google_map !!}
                    </div>

                    <div class="right">
                        <h5 class="skeleton mb-3">Information</h5>
                        <div class="mb_20">
                            <div class="text-title mb_8 skeleton">Phone:</div>
                            @if ( !empty(getSetting()->phone) )
                                <a href="tel:{{ getSetting()->phone }}" class="text-secondary skeleton">{{ getSetting()->phone }}</a>
                            @else
                                <a href="tel:{{ getSetting()->phone_optional }}" class="text-secondary skeleton">{{ getSetting()->phone_optional }}</a>
                            @endif
                        </div>

                        <div class="mb_20">
                            <div class="text-title mb_8 skeleton">Email:</div>
                            @if ( !empty(getSetting()->email) )
                                <a href="mailto:{{ getSetting()->email }}" class="text-secondary skeleton">{{ getSetting()->email }}</a>
                            @else
                                <a href="mailto:{{ getSetting()->email_optional }}" class="text-secondary skeleton">{{ getSetting()->email_optional }}</a>
                            @endif
                        </div>

                        <div class="mb_20">
                            <div class="text-title mb_8 skeleton">Address:</div>
                            <p class="text-secondary skeleton">{{ getSetting()->address }}</p>
                        </div>
                        <div>
                            <div class="text-title mb_8 skeleton">Open Time:</div>
                            <p class="mb_4 open-time skeleton">
                                <span class="text-secondary">{{ $time_schedule[0]['day'] }}:</span> {{ date('h:i a', strtotime($time_schedule[0]['start_time'])) .' - '. date('h:i a', strtotime($time_schedule[0]['end_time'])) }}
                            </p>
                            <p class="open-time skeleton">
                                <span class="text-secondary">{{ $time_schedule[1]['day'] }}:</span> {{ date('h:i a', strtotime($time_schedule[1]['start_time'])) .' - '. date('h:i a', strtotime($time_schedule[1]['end_time'])) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Store locations -->

<!-- Get In Touch -->
<section class="flat-spacing pt-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="heading-section text-center">
                    <h3 class="heading skeleton">Get In Touch</h3>
                    <p class="subheading skeleton">Use the form below to get in touch with the sales team</p>
                </div>
                
                <form id="contact_form" method="post" class="form-leave-comment">
                    @csrf 

                    <div class="wrap">
                        <div class="cols">
                            <fieldset class="skeleton">
                                <input class="" type="text" placeholder="Your Name*" name="name" id="name" value="{{ old('name') }}" aria-required="true">

                                <span id="name_validate" class="text-danger mt-1"></span>
                            </fieldset>

                            <fieldset class="skeleton">
                                <input class="" type="number" placeholder="Phone Number*" name="phone" id="phone" value="{{ old('phone') }}" aria-required="true" >

                                <span id="phone_validate" class="text-danger mt-1"></span>
                            </fieldset>
                        </div>

                        <div class="cols">
                            <fieldset class="skeleton">
                                <input class="" type="email" placeholder="Email Address*" name="email" id="email" value="{{ old('email') }}" aria-required="true">

                                <span id="email_validate" class="text-danger mt-1"></span>
                            </fieldset>
                        </div>

                        <div class="cols">
                            <fieldset class="skeleton">
                                <input class="" type="text" placeholder="Subject Here*" name="subject" id="subject" tabindex="2" value="{{ old('subject') }}" aria-required="true">

                                <span id="subject_validate" class="text-danger mt-1"></span>
                            </fieldset>
                        </div>

                        <fieldset class="skeleton">
                            <textarea name="message" id="message" rows="4" placeholder="Your Message*" tabindex="2" aria-required="true">{{ old('message') }}</textarea>

                            <span id="message_validate" class="text-danger mt-1"></span>
                        </fieldset>
                    </div>

                    <div class="button-submit send-wrap">
                        <button class="tf-btn btn-fill tf_contact_btn skeleton" type="submit">
                            <span class="text text-button" id="contact_btn">Send message</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /Get In Touch -->

@endsection

@push('add-js')

<script>
    // Subscription Form
    $('#contact_form').on('submit', function (e) {
        e.preventDefault();
        let data = $(this).serialize(); // Serialize form data

        $.ajax({
            method: 'POST',
            url: "{{ route('handle.contact.form') }}",
            data: data, // Send form data, including the CSRF token
            beforeSend: function(){
                $('#contact_btn').addClass('contact_gap');
                $('.tf_contact_btn').attr('disabled', true);
                $('#contact_btn').html("<i class='bx bx-loader-alt spinners'></i> Sending....");
            },
            success: function (data) {
                if (data.status === 'success') {
                    toastr.success(data.message);
                    $('#contact_btn').removeClass('contact_gap');
                    $('#contact_btn').text("Send Message");
                    $('#contact_form')[0].reset(); // Reset the form
                    $('.tf_contact_btn').attr('disabled', false);
                }
            },
            error: function (data) {
                console.log(data);
                let errors = data.responseJSON?.errors;

                $('#name_validate').empty().html(errors.name);
                $('#phone_validate').empty().html(errors.phone);
                $('#email_validate').empty().html(errors.email);
                $('#subject_validate').empty().html(errors.subject);
                $('#message_validate').empty().html(errors.message);

                $.each(errors, function (key, value) {
                    toastr.error(value);
                    $('#contact_btn').removeClass('contact_gap');
                    $('#contact_btn').text("Send Message");
                    $('.tf_contact_btn').attr('disabled', false);
                });
            }
        });
    });
</script>

    @include('frontend.include.full_ajax_cart')

@endpush