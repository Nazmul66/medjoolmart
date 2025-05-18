@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || user order dashboard</title>
    <meta name="description" content="">

    <meta property="og:title" content="user order dashboard">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
   
@endpush

@section('dashboard_orders', 'active')

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
                                        <th class="fw-6">Order</th>
                                        <th class="fw-6">Total</th>
                                        <th class="fw-6">Date</th>
                                        <th class="fw-6">Status</th>
                                        <th class="fw-6">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $row)
                                    @php
                                        $orderProducts = App\Models\OrderProduct::where('order_id', $row->order_id)->count();
                                    @endphp
                                        <tr class="tf-order-item">
                                            <td>
                                                #{{ $row->order_id }}
                                            </td>
                                            <td>
                                                {{ getSetting()->currency_symbol }}{{ $row->total_amount }} for {{ $orderProducts }} items
                                            </td>
                                            <td>
                                                @if ( $row->order_status === "pending" )
                                                    <span class="badge bg-warning">Shipped</span>
                                                @elseif ( $row->order_status === "processed_and_ready_to_ship" )
                                                    <span class="badge bg-dark">Processed and ready to ship</span>
                                                @elseif ( $row->order_status === "shipped" )
                                                    <span class="badge bg-secondary">Shipped</span>
                                                @elseif ( $row->order_status === "dropped_off" )
                                                    <span class="badge bg-info">Dropped Off</span>
                                                @elseif ( $row->order_status === "out_for_delivery" )
                                                    <span class="badge bg-success">Out For Delivery</span>
                                                @elseif ( $row->order_status === "delivered" )
                                                   <span class="badge bg-success">Delivered</span>
                                                @elseif ( $row->order_status === "cancelled" )
                                                  <span class="badge bg-danger">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ date('F d,Y', strtotime($row->created_at)) }}
                                            </td>
                                            <td>
                                                <a href="{{ route('user.dashboard.order.view', $row->id) }}" class="tf-btn btn-fill radius-4">
                                                    <span class="text">View</span>
                                                </a>
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