@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || user profile dashboard</title>
    <meta name="description" content="">

    <meta property="og:title" content="user profile dashboard">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
   <style>
    input[readonly] {
        background-color: #e9ecef; /* Light gray */
        color: #6c757d; /* Dark gray text */
        cursor: not-allowed;
    }
   </style>
@endpush

@section('dashboard_profile', 'active')


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
                    <h3 class="heading text-center">My Account</h3>
                    <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                        <li>
                            <a class="link" href="{{ route('home') }}">Homepage</a>
                        </li>
                        <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>
                            <a class="link" href="{{ route('product.page') }}">Shop</a>
                        </li>
                        <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>
                            My Account
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- my-account -->
    <section class="flat-spacing">
        <div class="container">
            <div class="my-account-wrap">

                @include('frontend.include.user_sidebar')

                <div class="my-account-content">
                    <div class="account-details">
                        <form action="{{ route('user.dashboard.profile.update', Auth::user()->id) }}" class="form-account-details form-has-password" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="account-info">
                                <h5 class="title">Information</h5>

                                <div class="mb-3">
                                    @if ( !empty(Auth::user()->image) )
                                        <div class="image_bg" style="background-image: url('{{ asset(Auth::user()->image) }}') ;">
                                            <label for="images"> <i class='bx bxs-edit-alt'></i> </label>
                                        </div>
                                    @else
                                        <div class="image_bg" style="background-image: url('{{ asset('public/backend/assets/images/bg-1.jpg') }}') ;">
                                            <label for="images"> <i class='bx bxs-edit-alt'></i> </label>
                                        </div>
                                    @endif
        
                                    <input type="file" name="image" id="images" hidden>

                                    @error('image')
                                        <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="cols mb_20">
                                    <fieldset class="">
                                        <input class="" type="text" placeholder="Username*" name="name" tabindex="2" aria-required="true" required="" value="{{ old('name', Auth::user()->name) }}">

                                        @error('name')
                                            <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </fieldset>

                                    <fieldset class="">
                                        <input class="" type="email" placeholder="Email address*" name="email" tabindex="2" value="{{ old('email', Auth::user()->email) }}" aria-required="true" required="">

                                        @error('email')
                                            <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="cols mb_20">
                                    <fieldset class="">
                                        <input class="" type="text" placeholder="Phone*" name="phone" tabindex="2" aria-required="true" value="{{ old('phone', Auth::user()->phone) }}">

                                        @error('phone')
                                            <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </fieldset>

                                    <fieldset class="">
                                        <input class="" type="text" placeholder="City" name="city" tabindex="2" aria-required="true" value="{{ old('city', Auth::user()->city) }}">

                                        @error('city')
                                            <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </fieldset>
                                </div>

                                <div class="cols mb_20">
                                    <select class="text-title" id="country" name="country">
                                        <option value="bangladesh">Bangladesh</option>
                                    </select>

                                    @error('country')
                                        <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="button-submit mt-3">
                                    <button class="tf-btn btn-fill" type="submit">
                                        <span class="text text-button">Update</span>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="mt-5">
                            <form action="{{ route('user.change-password') }}" class="form-account-details form-has-password" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="account-password">
                                    <h5 class="title">Change Password</h5>
                                    <div class="mb_20">
                                        <fieldset class="position-relative password-item ">
                                            <input class="input-password current_password" type="password" placeholder="current Password*" name="current_password" id="current_password" tabindex="2" aria-required="true" >
                                            <span class="input-group-text px-3">
                                                <a href="javascript:void(0)" class="bg-transparent border-0 p-0 link-secondary  fa fa-fw fa-eye field-icon toggle-current-password" toggle="#password-field">
                                                </a>
                                            </span>
                                        </fieldset>
                                        <div id="current_pass_error"></div>
                                    </div>


                                    <div class="mb_20">
                                        <fieldset class="position-relative password-item">
                                            <input class="input-password new_password" type="password" placeholder="New Password*" name="new_password" id="new_password" tabindex="2" aria-required="true">
                                            <span class="input-group-text px-3">
                                                <a href="javascript:void(0)" class="bg-transparent border-0 p-0 link-secondary fa fa-fw fa-eye field-icon new-toggle-password" toggle="#password-field">
                                                </a>
                                            </span>
                                        </fieldset>
    
                                        @error('new_password')
                                            <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="">
                                        <fieldset class="position-relative password-item">
                                            <input class="input-password confirm_password" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password*" tabindex="2" aria-required="true">
                                            <span class="input-group-text px-3">
                                                <a href="javascript:void(0)" class="bg-transparent border-0 p-0 link-secondary  fa fa-fw fa-eye field-icon confirm-toggle-password" toggle="#password-field">
                                                </a>
                                            </span>
                                        </fieldset>
    
                                        @error('confirm_password')
                                            <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="button-submit">
                                    <button class="tf-btn btn-fill" type="submit">
                                        <span class="text text-button">Update Account</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /my-account -->

@endsection

@push('add-js')

    <script>
        $('#images').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.image_bg').css('background-image', 'url(' + e.target.result + ')');
            }
            reader.readAsDataURL(this.files[0]);
        });

        // password show hide
        $(".toggle-current-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $('.current_password');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".new-toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $('.new_password');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $(".confirm-toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $('.confirm_password');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        // Current Password show
        $('#current_password').on('input', function(e){
            var currentPassword = $(this).val();
            // console.log($(this).val());

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('user.current-password') }}",
                data: { current_password: currentPassword },
                success: function (res) {
                    console.log(res);
                    if (res.match === true) {
                        $('#current_pass_error').html(`
                            <span class="text-success"><strong>Current Password is Correct</strong><i class='bx bx-check'></i></span> 
                        `);
                    }
                    else{
                        $('#current_pass_error').html(`
                            <span class="text-danger"><strong>Current Password is Incorrect</strong><i class='bx bx-x'></i></span> 
                        `); 
                    }
                },
                error: function (err) {
                    console.log(err)
                }
            });
        });
    </script>

    

    @include('frontend.include.full_ajax_cart')

@endpush