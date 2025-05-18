@extends("backend.layout.master")


@push('meta-title')
    {{ env('APP_NAME') }} | Dashboard 
@endpush


@push('style-css')
      
@endpush


@section('body-content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('message.dashboard') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ url('/admin/order/all') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-primary">
                            <i class='bx bx-package'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Orders</h6>
                             <p>{{ $total_order }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-primary">
                            <i class='bx bx-line-chart'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Today's Orders</h6>
                             <p>{{ $today_order }}</p>
                         </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ url('/admin/order/pending') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-info">
                            <i class='bx bx-chart'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Pending Orders</h6>
                             <p>{{ $pending_order }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ url('/admin/order/delivered') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-info">
                            <i class='bx bx-trending-up'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Complete Orders</h6>
                             <p>{{ $delivered_order }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ url('/admin/order/cancelled') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-danger">
                            <i class='bx bx-trending-down' ></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Cancelled Orders</h6>
                             <p>{{ $cancelled_order }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-danger">
                            <span>{{ getSetting()->currency_symbol }}</span>
                         </div>

                         <div class="cart_text">
                             <h6>Total Earnings</h6>
                             <p>{{ getSetting()->currency_symbol }}{{ $total_amount }}</p>
                         </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-danger">
                            <i class='bx bx-money' ></i>
                         </div>

                         <div class="cart_text">
                             <h6>Today's Earnings</h6>
                             <p>{{ getSetting()->currency_symbol }}{{ $todays_amount }}</p>
                         </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-danger">
                            <i class='bx bx-money' ></i>
                         </div>

                         <div class="cart_text">
                             <h6>This Month Earnings</h6>
                             <p>{{ getSetting()->currency_symbol }}{{ $monthly_amount }}</p>
                         </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-danger">
                            <i class='bx bx-money' ></i>
                         </div>

                         <div class="cart_text">
                             <h6>This Year Earnings</h6>
                             <p>{{ getSetting()->currency_symbol }}{{ $yearly_amount }}</p>
                         </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ url('/admin/reviews') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-warning">
                            <i class='bx bxs-star' ></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Reviews</h6>
                             <p>{{ $reviews }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ route('admin.brand.index') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-warning">
                            <i class='bx bx-at'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Brands</h6>
                             <p>{{ $brands }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ route('admin.category.index') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-warning">
                            <i class='bx bx-category'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Categories</h6>
                             <p>{{ $categories }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-warning">
                            <i class='bx bx-archive'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Blogs</h6>
                             <p>0</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ route('admin.subscription.index') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-dark">
                            <i class='bx bx-purchase-tag-alt'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Subscribers</h6>
                             <p>{{ $subscriber }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ route('admin.product.index') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-dark">
                            <i class='bx bx-cart'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Products</h6>
                             <p>{{ $products }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ route('admin.product.collection.index') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-dark">
                            <i class='bx bx-collection'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Products Collection</h6>
                             <p>{{ $collections }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <a href="{{ route('admin.customer.index') }}" class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-dark">
                            <i class='bx bx-user'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Users</h6>
                             <p>{{ $users }}</p>
                         </div>
                    </div>
                </a><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body" style="height: 110px;">
                    <div class="analytics_card">
                         <div class="icon_design bg-dark">
                            <i class='bx bx-heart'></i>
                         </div>

                         <div class="cart_text">
                             <h6>Total Wishlist</h6>
                             <p>{{ $wishlists }}</p>
                         </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

    </div><!-- end row-->

@endsection


@push('script')
    
@endpush