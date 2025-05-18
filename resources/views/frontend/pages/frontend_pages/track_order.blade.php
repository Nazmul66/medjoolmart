@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || tracking order</title>
    <meta name="description" content="">

    <meta property="og:title" content="tracking order">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')

@endpush


@section('body-content')

<!-- order track -->
<section class="flat-spacing">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="tracking-wrap ">
                    <div class="left">
                        <div class="heading mb-5 text-center">
                            <h4 class="mb-1 skeleton" style="font-size: 30px;">Order Tracking</h4>
                            <p class="skeleton">Tracking Your Order Status</p>
                        </div>

                        <form method="GET" action="{{ route('track.order') }}" class="form-login">
                            
                            <div class="wrap">
                                {{-- <fieldset class="text-start">
                                    <label for="" class="mb-2" style="font-weight: 500;">Tracking Number*</label>
                                    <input type="text" placeholder="E.X: TRK98220020">
                                </fieldset> --}}

                                <fieldset class="text-start skeleton">
                                    <label for="" class="mb-2" style="font-weight: 500;">Order Id*</label>
                                    <input type="number" value="{{ @$order->order_id }}" name="tracker" placeholder="E.X: 158287801">  
                                </fieldset>
                            </div>

                            <div class="button-submit skeleton">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text">Tracking Orders</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        @if ( !empty($order->order_id) )
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-lg-3">
                    <div class="wsus__track_header_single">
                        <h5 style="text-transform: capitalize; font-size: 20px;">Order Date:</h5>
                        <p>{{ date('d F, Y', strtotime(@$order->created_at)) }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-3">
                    <div class="wsus__track_header_single">
                        <h5 style="text-transform: capitalize; font-size: 20px;">Payment Status:</h5>
                        <p>
                            @if ( $order->payment_status == 1 )
                                <span class="badge bg-success" style="text-transform: capitalize">Paid Payment</span>
                            @elseif( $order->payment_status == 2 )
                                <span class="badge bg-info" style="text-transform: capitalize">Due Payment</span>
                            @else
                                <span class="badge bg-danger" style="text-transform: capitalize">Pending Payment</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-3">
                    <div class="wsus__track_header_single">
                        <h5 style="text-transform: capitalize; font-size: 20px;">Order status:</h5>
                        <span class="badge bg-dark">{{ @$order->order_status }}</span>
                    </div>
                </div>
                
                <div class="col-xl-3 col-sm-6 col-lg-3">
                    <div class="wsus__track_header_single border_none">
                        <h5 style="text-transform: capitalize; font-size: 20px;">Order Id:</h5>
                        <span class="badge bg-secondary">#{{ @$order->order_id }}</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <ul class="progtrckr" data-progtrckr-steps="4"
                    style="justify-content: {{ $order->order_status === 'cancelled' ? 'start' : 'space-between' }};"                
                >
                    <li class="progtrckr_done icon_one check_mark">Order pending</li>

                    @if ( $order->order_status === 'cancelled')
                        <li class="icon_one red_mark">Cancelled</li>
                    @else
                        <li class="progtrckr_done icon_two 
                        @if ( $order->order_status === 'processed_and_ready_to_ship' ||
                            $order->order_status === 'dropped_off' ||
                            $order->order_status === 'shipped' ||
                            $order->order_status === 'out_for_delivery' ||
                            $order->order_status === 'delivered'
                        )
                            check_mark
                        @endif
                        ">order Processing</li>
                        <li class="icon_three
                            @if ( $order->order_status === 'out_for_delivery' || 
                                $order->order_status === 'delivered'
                            )
                                check_mark
                            @endif
                        ">on the way</li>
                        <li class="icon_four
                            @if ( $order->order_status === 'delivered')
                                check_mark
                            @endif
                        ">Delivered</li>
                    @endif
                </ul>
            </div>

            <div class="col-xl-12 mt-5">
                <a href="{{ route('home') }}" class="tf-btn btn-fill">
                    <i class="fas fa-chevron-left" aria-hidden="true"></i> 
                    <span class="text">back to home</span>
                </a>
            </div>
        @endif

    </div>
</section>
<!-- /login -->

@endsection

@push('add-js')
    
@endpush