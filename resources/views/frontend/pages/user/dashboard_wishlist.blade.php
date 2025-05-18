@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || user wishlist dashboard</title>
    <meta name="description" content="">

    <meta property="og:title" content="user wishlist dashboard">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
   
@endpush

@section('dashboard_wishlist', 'active')

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
                                        <th class="fw-6">Image</th>
                                        <th class="fw-6">Product Name</th>
                                        <th class="fw-6">Quantity</th>
                                        <th class="fw-6">Price</th>
                                        <th class="fw-6">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlists as $row)
                                        <tr class="tf-order-item" data-id={{ $row->wish_id }}>
                                            <td>
                                                <a href="{{ route('product.details', $row->slug) }}">
                                                    <img src="{{ asset($row->thumb_image) }}" alt="{{ $row->slug }}" style="width: 50px;">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('product.details', $row->slug) }}">
                                                    {{ $row->name }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $row->qty }} Pcs
                                            </td>
                                            <td>
                                                @if ( checkDiscount($row) )
                                                    @if ( $row->discount_type === "amount")
                                                        {{ getSetting()->currency_symbol }}{{ $row->selling_price }} ${{ $row->selling_price - $row->discount_value }}
                                                    @elseif( $row->discount_type === "percent" )
                                                        @php
                                                            $discount_val = $row->selling_price * $row->discount_value / 100;
                                                        @endphp
                                                        {{ getSetting()->currency_symbol }}{{ $row->selling_price }}${{ $row->selling_price - $discount_val }}</
                                                    @else
                                                        {{ getSetting()->currency_symbol }}{{ $row->selling_price }}
                                                    @endif
                                                @else
                                                    {{ getSetting()->currency_symbol }}{{ $row->selling_price }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void();" data-id="{{ $row->wish_id }}" class="tf-btn btn-fill radius-4 product_wishlist_remove">
                                                    <span class="text">Remove</span>
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

  <script>
        // Product Wishlist Remove 
        $(document).on('click', '.product_wishlist_remove', function(e){
            e.preventDefault();
            let id = $(this).data('id'); 
            // console.log(id);

            $.ajax({
                method: 'DELETE',
                url: "{{ url('/user/dashboard/wishlist-remove') }}/" + id,
                data: { 
                    _token: "{{ csrf_token() }}",
                    id: id ,
                },
                success: function (res) {
                    if(res.status === 'success') {
                        toastr.success(res.message);
                        $('.tf-order-item[data-id="' + id + '"]').remove(); // Fix selector
                    }
                },
                error: function (data) {
                    console.log(data);
                    let errors = data.responseJSON?.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value);
                    });
                }
            });
        });
  </script>

    @include('frontend.include.full_ajax_cart')

@endpush