<!doctype html>
<html lang="en">
    
<!-- Meta-Titles Head Tag -->
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <title>
        {{ config('app.name') }} | @stack('title')
    </title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('public/backend/assets/images/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('public/backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('public/backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="{{ asset('public/backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- toaster css plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- App Css-->
    <link href="{{ public_path('public/backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    {{-- <!-- Style Css-->
    <link href="{{ public_path('backend/assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" /> --}}

    <!-- Font Awesome CDN File -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">


    <!-- Style Css-->
    <link href="{{ public_path('backend/assets/css/style.css') }}" />

    <style>
        .select2-container {
            display: block !important;
            width: 100% !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 37px;
        }
        .select2-selection__arrow {
            height: 37px !important;
        }
        .select2-search--dropdown .select2-search__field {
            outline: none;
        }
    </style>
</head>



@php
    $coupon = json_decode($order->coupon, true);
    $bio    = json_decode($order->order_address, true);

    $coupon_amount    = 0;
    if ( is_array($coupon) && isset($coupon['discount_type']) ){
        if ( $coupon['discount_type'] === 'percent' ) {
            $coupon_amount = ( $order->subtotal * $coupon['discount'] ) / 100;
        }
        elseif ( $coupon['discount_type'] === 'amount' ) {
            $coupon_amount   =  $coupon['discount'];
        }
        else{
            $coupon_amount = 0;
        }
    }
    else{
        $coupon_amount = 0;
    }
@endphp


<body>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice_print">
                        <div class="invoice-title">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <div class="mb-4">
                                        @if ( !empty(getSetting()->logo) )
                                            <img src="{{ asset(getSetting()->logo) }}" alt="" height="35"><span class="logo-txt">{{ getSetting()->site_name }}</span>
                                        @else
                                            <img src="{{ asset('public/backend/assets/images/logo-sm.svg') }}" alt="" height="35"><span class="logo-txt">Minia</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="mb-4">
                                        <h4 class="float-end font-size-16">Invoice # {{ $order->invoice_id }}</h4>
                                    </div>
                                </div>
                            </div>
                            
    
                            <p class="mb-1">
                                @if ( !empty(getSetting()->address) )
                                    {{ getSetting()->address }}
                                @else
                                    {{ getSetting()->address_optional }}
                                @endif
                            </p>
                            <p class="mb-1">
                                <i class="mdi mdi-email align-middle me-1"></i> 
    
                                @if ( !empty(getSetting()->email) )
                                    {{ getSetting()->email }}
                                @else
                                    {{ getSetting()->email_optional }}
                                @endif
                            </p>
                            <p>
                                <i class="mdi mdi-phone align-middle me-1"></i> 
    
                                @if ( !empty(getSetting()->phone) )
                                    {{ getSetting()->phone }}
                                @else
                                    {{ getSetting()->phone_optional }}
                                @endif
                            </p>
                        </div>
    
                        <hr class="my-4">
    
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <h5 class="font-size-15 mb-3">Billed To:</h5>
                                    <h5 class="font-size-14 mb-2">{{ $bio['full_name'] }}</h5>
                                    <p class="mb-1">{{ $bio['address'] }}</p>
                                    <p class="mb-1">
                                        @if ( !empty($bio['email']) )
                                            {{ $bio['email'] }}
                                        @endif
                                    </p>
                                    <p>{{ $bio['phone'] }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <div>
                                        <h5 class="font-size-15">Order Date:</h5>
                                        <p>{{ date('F d, Y', strtotime($order->created_at)) }}</p>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <h5 class="font-size-15">Payment Method:</h5>
                                        <p class="mb-1">{{ $order->payment_method }}</p>
                                    </div>
    
                                    <div class="mt-4">
                                        <h5 class="font-size-15">Order Status:</h5>
                                        <select class="form-select" id="order_status" data-id="{{ $order->id }}" style="max-width: 200px;">
                                            @foreach (config('order_status_data.order_status') as $key => $status)
                                                <option value="{{ $key }}" @if( $order->order_status === $key ) selected @endif>{{ ucfirst($status['status']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="py-2 mt-3">
                            <h5 class="font-size-15">Order summary</h5>
                        </div>
    
                        <div class="p-4 border rounded">
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Variants</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th class="text-end" style="width: 120px;">Total Price</th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @foreach ($order_products as $key => $item)
                                            @php
                                                $variants = json_decode($item->variants, true); // Convert to array
                                                $total_price = $item->qty * ( $item->variant_total + $item->unit_price );
                                            @endphp
    
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>
                                                        <h5 class="font-size-15 mb-1">{{ $item->product_name }}</h5>
                                                        <p class="font-size-13 text-muted mb-0">Bootstrap 5 Admin Dashboard </p>
                                                    </td>
                                                    <td>
                                                        @if ( !empty($variants['size_name']) )
                                                            <h5 class="font-size-15 mb-2">Size : {{ strtoupper($variants['size_name']) }} ( {{ $order->currency_symbol }}{{ $variants['size_price'] }} )</h5>
                                                        @endif
    
                                                        @if ( !empty($variants['color_name']) )
                                                            <h5 class="font-size-15 mb-0">Color : {{ strtoupper($variants['color_name']) }} ( {{ $order->currency_symbol }}{{ $variants['color_price'] }} )</h5>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->qty }} Qty</td>
                                                    <td>{{ $order->currency_symbol }}{{ number_format($item->unit_price, 2, '.', ''); }}</td>
                                                    <td class="text-end">{{ $order->currency_symbol }}{{ number_format($total_price, 2, '.', ''); }}</td>
                                                </tr>
                                        @endforeach
    
                                        <tr>
                                            <th scope="row" colspan="5" class="text-end">Sub Total</th>
                                            <td class="text-end">{{ $order->currency_symbol }}{{ number_format($order->subtotal, 2, '.', ''); }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="5" class="border-0 text-end">
                                               (-) Tax</th>
                                            <td class="border-0 text-end">{{ $order->currency_symbol }}0.00</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="5" class="border-0 text-end">
                                                (-) Coupon  
                                                @if (is_array($coupon) && isset($coupon['discount_type']))
                                                    @if ($coupon['discount_type'] === 'percent')
                                                        ( {{ $coupon['discount'] }}% )
                                                    @elseif ($coupon['discount_type'] === 'amount')
                                                        ( {{ $coupon['discount'] }}{{ $order->currency_name }} )
                                                    @endif
                                                @endif
                                            </th>
                                            <td class="border-0 text-end">
                                                @if (is_array($coupon) && isset($coupon['discount_type']))
                                                    <span>{{ $order->currency_symbol }}{{ number_format($coupon_amount, 2, '.', '') }}</span>
                                                @else
                                                    <span>{{ $order->currency_symbol }}{{ number_format($coupon_amount, 2, '.', '') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="5" class="border-0 text-end">
                                                (+) Shipping Charge</th>
                                            <td class="border-0 text-end">{{ $order->currency_symbol }}{{ number_format($order->delivery_charge, 2, '.', ''); }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="5" class="border-0 text-end">Total Amount</th>
                                            <td class="border-0 text-end"><h4 class="m-0">{{ $order->currency_symbol }}{{ number_format($order->total_amount, 2, '.', ''); }}</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <script src="{{ asset('/public/backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="{{ asset('/public/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   
    <script src="{{ asset('/public/backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
   
    <script src="{{ asset('/public/backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('/public/backend/assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    {{-- <script src="{{ asset('/public/backend/assets/libs/pace-js/pace.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    <!-- toaster Js plugins  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('/public/backend/assets/js/app.js') }}"></script>
</body>
</html>