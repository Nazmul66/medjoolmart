@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || user review dashboard</title>
    <meta name="description" content="">

    <meta property="og:title" content="user review dashboard">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
   
@endpush

@section('dashboard_review', 'active')

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
                    <div class="account-orders">
                        <div class="wrap-account-order">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="fw-6">#SL.</th>
                                        <th class="fw-6">Product Name</th>
                                        <th class="fw-6">Rating</th>
                                        <th class="fw-6">Review</th>
                                        <th class="fw-6">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_reviews as $key => $row)
                                        <tr class="tf-order-item">
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                <a href="{{ route('product.details', $row->slug) }}">
                                                    <strong>{{ $row->prdt_name }}</strong>
                                                </a>
                                            </td>
                                            <td>
                                                {{ $row->ratings }} Star
                                            </td>
                                            <td>
                                                {{ $row->review }}
                                            </td>
                                            <td>
                                                @if ( $row->status === 1 )
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-danger">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /my-account -->

@endsection

@push('add-js')

    @include('frontend.include.full_ajax_cart')

@endpush