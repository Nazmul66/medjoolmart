@extends('frontend.layout.master')

@push('add-meta')
    <title>Register Page</title>
@endpush

@push('add-css')
   
@endpush


@section('body-content')

<!-- page-title -->
<div class="page-title" style="background-image: url({{ asset('public/frontend/images/section/page-title.jpg') }});">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">Create An Account</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ url('/') }}">Homepage</a>
                    </li>
                    {{-- <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>
                        <a class="link" href="#">Pages</a>
                    </li> --}}
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>
                        Register
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
                    <h3>Register</h3>
                </div>

                <form method="POST" action="{{ route('register') }}" class="form-login form-has-password">
                    @csrf

                    <div class="wrap">
                        <fieldset class="">
                            <input type="text" tabindex="2" placeholder="Full Name*" name="name"  value="{{ old('name') }}"  autofocus autocomplete="off">

                            <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger" />
                        </fieldset>

                        <fieldset class="">
                            <input type="email" placeholder="Email Address" name="email" value="{{ old('email') }}" autofocus autocomplete="off">

                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                        </fieldset>

                        <fieldset class="">
                            <input class="input-password" tabindex="2" type="number" placeholder="Phone Number*" name="phone" value="{{ old('phone') }}" pattern="^0\d{10}$"  maxlength="11" >

                            <x-input-error :messages="$errors->get('phone')" class="mt-1 text-danger" />
                        </fieldset>

                        <fieldset class="position-relative password-item">
                            <input class="input-password" tabindex="2" type="password" placeholder="Password*" name="password" tabindex="2" >
                            <span class="toggle-password unshow">
                                <ion-icon name="eye-outline"></ion-icon>
                            </span>
                        </fieldset>
                        <x-input-error :messages="$errors->get('password')" class="text-danger" style="margin-top: -14px;" />

                        <fieldset class="position-relative password-item">
                            <input class="input-password" tabindex="2" type="password" placeholder="Confirm Password*" name="password_confirmation">
                            <span class="toggle-password unshow">
                                <ion-icon name="eye-outline"></ion-icon>
                            </span>

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                        </fieldset>

                        <div class="d-flex align-items-center">
                            <div class="tf-cart-checkbox">
                                <div class="tf-checkbox-wrapp">
                                    <input checked class="" type="checkbox" id="login-form_agree" name="remember">
                                    <div>
                                        <i class='bx bx-check'></i>
                                    </div>
                                </div>
                                <label class="text-secondary-2" for="login-form_agree">
                                    I agree to the&nbsp;
                                </label>
                            </div>
                            <a href="term-of-use.html" title="Terms of Service"> Terms of User</a>
                        </div>
                    </div>
                    <div class="button-submit">
                        <button class="tf-btn btn-fill" type="submit">
                            <span class="text text-button">Register</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="right">
                <h4 class="mb_8">Already have an account?</h4>
                <p class="text-secondary">Welcome back. Sign in to access your personalized experience, saved preferences, and more. We're thrilled to have you with us again!</p>
                <a href="{{ route('login') }}" class="tf-btn btn-fill"><span class="text text-button">Login</span></a>
            </div>
        </div>
    </div>
</section>
<!-- /login -->

@endsection


@push('add-js')

@endpush