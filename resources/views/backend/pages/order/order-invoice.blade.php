@extends('backend.layout.master')

@push('title')
    Order Invoice Details
@endpush

@section('all_orders', 'mm-active')

@push('add-css')

@endpush


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


@section('body-content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Invoice Detail</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                        <li class="breadcrumb-item active">Invoice Detail</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    
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

                    <div class="d-print-none mt-3">
                        <div class="float-end">
                            <a href="{{ route('admin.order.order_invoice_pdf', $order->id) }}" class="btn btn-info waves-effect waves-light me-1"><i class="fa fa-download"></i></a>
                            <a href="javascript:window.print();" id="invoice_print" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                            <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@push('add-script')

<script>
    $(document).ready(function () {
        // Order status updates
        $(document).on('change', '#order_status', function () {
            var id     = $(this).data('id');
            var status = $(this).val();

            // console.log(id, status);

            $.ajax({
                type: "POST",
                url: "{{ route('admin.change.order.status') }}",
                data: {
                    // '_token': token,
                    id: id,
                    status: status
                },
                success: function (res) {

                    // Display a success message
                    if (res.status === "pending") {
                        Swal.fire({
                            title: 'Order status ( Pending ) updated successfully!',
                            icon: 'success'
                        });
                    } 
                    else if (res.status === "processed_and_ready_to_ship") {
                        Swal.fire({
                            title: 'Order status ( processed_and_ready_to_ship ) updated successfully!',
                            icon: 'success'
                        });
                    }
                    else if (res.status === "dropped_off") {
                            Swal.fire({
                                title: 'Order status ( dropped_off ) updated successfully!',
                                icon: 'success'
                            });
                        }
                    else if (res.status === "shipped") {
                        Swal.fire({
                            title: 'Order status ( shipped ) updated successfully!',
                            icon: 'success'
                        });
                    }
                    else if (res.status === "out_for_delivery") {
                        Swal.fire({
                            title: 'Order status ( out_for_delivery ) updated successfully!',
                            icon: 'success'
                        });
                    } 
                    else {
                        Swal.fire({
                            title: 'Order status ( delivered ) updated successfully!',
                            icon: 'success'
                        });
                    }
                },
                error: function (err) {
                    console.error(err);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update payment status.',
                        icon: 'error'
                    });
                }
            })
        })

    })
</script>

@endpush