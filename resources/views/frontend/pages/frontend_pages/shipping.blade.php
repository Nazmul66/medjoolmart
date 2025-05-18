@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || {{ $data->meta_title ?? 'shipping' }}</title>
    <meta name="description" content="{{ $data->meta_description ?? '' }}">

    <meta property="og:title" content="{{ $data->meta_title ?? 'shipping' }}">
    <meta property="og:description" content="{{ $data->meta_description ?? '' }}">
    <meta property="og:image" content="{{ asset($data->meta_image) ?? '' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
   
@endpush


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
                    <h3 class="heading text-center">{{ $data->title }}</h3>
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
                            {{ $data->title }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /page-title -->

    <!-- Terms of use -->
    <section class="flat-spacing">
        <div class="container">
            <div class="col-lg-10 offset-lg-1">
                <div class="terms-of-use-wrap">
                    <div class="right terms-of-use-item skeleton">

                        {!! $data->content !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Terms of use -->

@endsection


@push('add-js')
    @include('frontend.include.full_ajax_cart')
@endpush