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
                <h3 class="heading text-center">Customer Feedbacks</h3>
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
                        Customer Feedbacks
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- Customer Feedbacks -->
<section class="flat-spacing">
    <div class="container">
        <div class="tf-grid-layout md-col-3 mb_30">
            @foreach ( $productReviews as $row )
                @php
                    $avgRatings = App\Models\ProductReview::where('product_id', $row->id)->where('status', 1)->avg('ratings');
                @endphp

                <div class="testimonial-item style-2">
                    <div class="content-top">
                        <div class="list-star-default skeleton">
                            @for ( $i = 1; $i <= 5; $i++ )
                                @if ( $i <= round($avgRatings))
                                    <i class="bx bxs-star" style="color: #F0A750;"></i>
                                @else
                                    <i class="bx bx-star" style="color: #F0A750;"></i>
                                @endif
                            @endfor
                        </div>

                        <p class="text-secondary skeleton">{{ Str::substr($row->review, 0, 200) }}...</p>

                        <div class="box-author skeleton">
                            <div class="text-title author">{{ $row->user_name }}</div>
                            <svg class="icon" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_15758_14563)">
                                <path d="M6.875 11.6255L8.75 13.5005L13.125 9.12549" stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 18.5005C14.1421 18.5005 17.5 15.1426 17.5 11.0005C17.5 6.85835 14.1421 3.50049 10 3.50049C5.85786 3.50049 2.5 6.85835 2.5 11.0005C2.5 15.1426 5.85786 18.5005 10 18.5005Z" stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_15758_14563">
                                <rect width="20" height="20" fill="white" transform="translate(0 0.684082)"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </div>
                    </div>

                    <div class="box-avt">
                        <div class="avatar avt-60 round skeleton">
                            @if ( !empty($row->user_img) )
                                <img src="{{ asset($row->user_img) }}" alt="avt">
                            @else
                                <img src="{{ asset('public/backend/assets/images/no_Image_available.jpg') }}" alt="avt">
                            @endif
                        </div>

                        @php
                            $total_sum = App\Models\OrderProduct::where('product_id', $row->product_id)->sum(DB::raw('(variant_total + unit_price) * qty'));
                        @endphp

                        <div class="box-price">
                            <p class="text-title text-line-clamp-1 skeleton">{{ $row->product_name }}</p>
                            <div class="text-button price skeleton mt-2">{{ getSetting()->currency_symbol }}{{ $total_sum }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <ul class="wg-pagination justify-content-center">
            <li>
                <a href="#" class="pagination-item text-button">1</a>
            </li>
            <li class="active">
                <div class="pagination-item text-button">2</div>
            </li>
            <li>
                <a href="#" class="pagination-item text-button">3</a>
            </li>
            <li>
                <a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a>
            </li>
        </ul> --}}
    </div>
</section>
<!-- /Customer Feedbacks -->
@endsection


@push('add-js')

    @include('frontend.include.full_ajax_cart')

@endpush