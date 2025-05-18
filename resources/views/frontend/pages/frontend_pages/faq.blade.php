@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || Faq Page</title>
    <meta name="description" content="">

    <meta property="og:title" content="Faq Page">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
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
                <h3 class="heading text-center ">FAQs</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ route('home') }}">Homepage</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>
                        <a class="link" href="">Pages</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>
                        FAQs
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- FAQs -->
<section class="flat-spacing">
    <div class="container">
        <div class="col-lg-8 offset-lg-2">
            <div class="page-faqs-wrap">
                <div class="list-faqs">
                    <div>
                        <h3 class="faqs-title text-center skeleton">Frequently Ask Question</h3>
    
                        <ul class="accordion-product-wrap style-faqs" id="accordion-faq-1">
                            @foreach ($data as $key => $row)
                                <li class="accordion-product-item">
                                    <a href="#accordion-{{ $key }}" class="accordion-title skeleton {{ $key != 0 ? 'collapsed' : '' }} current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="accordion-{{ $key }}">
                                        <h5>{{ $row->question }}</h5>
                                        <span class="btn-open-sub"></span>
                                    </a>

                                    <div id="accordion-{{ $key }}" class="collapse skeleton {{ $key == 0 ? 'show' : '' }}" data-bs-parent="#accordion-faq-1">
                                        <div class="accordion-faqs-content">
                                            <p class="text-secondary">{{ $row->answer }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /FAQs -->

@endsection

@push('add-js')

    @include('frontend.include.full_ajax_cart')

@endpush