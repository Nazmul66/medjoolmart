@extends('frontend.layout.master')

@push('add-meta')
    <title>Login Page</title>
@endpush

@push('add-css')
   
@endpush


@section('body-content')

     <!-- page-title -->
     <div class="page-title" style="background-image: url({{ asset('public/frontend/images/section/page-title.jpg') }});">
        <div class="container-full">
            <div class="row">
                <div class="col-12">
                    <h3 class="heading text-center">Login</h3>
                    <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                        <li>
                            <a class="link" href="{{ url('/') }}">Homepage</a>
                        </li>
                        {{-- <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>
                            <a class="link" href="#">Pages</a>
                        </li> --}}
                        <li>
                            <i class='bx bx-chevron-right'></i>
                        </li>
                        <li>
                            Login
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- login -->
    <section class="flat-spacing">
        <div class="container">
            <div class="login-wrap">

                <div class="left">
                    <div class="heading">
                        <h3>Login</h3>
                    </div>


                    <form method="POST" action="{{ route('login') }}" class="form-login form-has-password">
                        @csrf

                        <div class="wrap">
                            <fieldset class="">
                                <input class="" type="text" placeholder="Email Address or Phone Number" name="login" tabindex="2" value="{{ old('login') }}" aria-required="true" >
                            </fieldset>
                            <x-input-error :messages="$errors->get('login')" class="mt-1 text-danger" style="margin-top: -20px !important; " />


                            <fieldset class="position-relative password-item">
                                <input class="input-password" type="password" placeholder="Password*" name="password" tabindex="2" aria-required="true" >
                                <span class="toggle-password unshow">
                                    <ion-icon name="eye-outline"></ion-icon>
                                </span>
                            </fieldset>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" style="margin-top: -20px !important;" />


                            <div class="d-flex align-items-center justify-content-between">
                                <div class="tf-cart-checkbox">
                                    <div class="tf-checkbox-wrapp">
                                        <input class="" tabindex="2" type="checkbox" id="login-form_agree" name="remember" required>
                                        <div>
                                            <i class='bx bx-check'></i>
                                        </div>
                                    </div>
                                    <label for="login-form_agree">
                                        Remember me
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" class="font-2 text-button forget-password link">Forgot Your Password?</a>
                            </div>
                        </div>

                        <div class="button-submit">
                            <button class="tf-btn btn-fill" type="submit">
                                <span class="text text-button">Login</span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="right">
                    <h4 class="mb_8">New Customer</h4>
                    <p class="text-secondary">Be part of our growing family of new customers! Join us today and unlock a world of exclusive benefits, offers, and personalized experiences.</p>
                    <a href="{{ route('register') }}" class="tf-btn btn-fill"><span class="text text-button">Register</span></a>
                </div>
            </div>
        </div>
    </section>
    <!-- /login -->


@endsection


@push('add-js')

@endpush