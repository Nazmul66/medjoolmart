@extends('frontend.layout.master')

@push('add-meta')
    <title>{{ env('APP_NAME') }} || Shop Page</title>
    <meta name="description" content="">

    <meta property="og:title" content="Shop Page">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@push('add-css')
    <style>
        .accordion-product-item .btn-open-sub {
            position: relative;
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .accordion-product-item .btn-open-sub::before {
            content: "";
            position: absolute;
            z-index: 1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: var(--main);
            transition: 0.4s ease 0.1s;
            margin: auto;
        }
        .accordion-product-item .btn-open-sub::after {
            content: "";
            position: absolute;
            z-index: 1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: var(--main);
            transition: 0.4s ease 0.1s;
            margin: auto;
        }
        .accordion-product-item .btn-open-sub::after {
            width: 18px;
            height: 2px;
        }
        .accordion-product-item .btn-open-sub::before {
            width: 2px;
            height: 18px;
        }
        .accordion-product-item .accordion-title:not(.collapsed) .btn-open-sub::before {
            transform: rotate(90deg);
        }
    </style>
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
                <h3 class="heading text-center">
                    @if ( request()->has('categories') )
                        {{ ucwords(request()->categories) }}
                    @elseif ( request()->has('sub_categories') )
                        {{ ucwords(request()->sub_categories) }}
                    @else
                        All Products
                    @endif
                </h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ route('home') }}">Homepage</a>
                    </li>
                    <li>
                        <i class='bx bx-chevron-right'></i>
                    </li>
                    <li>
                        @if ( request()->has('categories'))
                            {{ ucwords(request()->categories) }}
                        @elseif ( request()->has('sub_categories') )
                            {{ ucwords(request()->sub_categories) }}
                        @else
                            Products
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /page-title -->

<!-- Section product -->
<section class="flat-spacing">
    <div class="container">
        <div class="tf-shop-control">
            <div class="tf-control-filter">
                <button id="filterShop" class="filterShop skeleton tf-btn-filter">
                    <i class='bx bx-filter-alt' style="font-size: 22px;"></i>
                    <span class="text">Filters</span></button>
                <div class="d-none d-lg-flex shop-sale-text skeleton">
                    <i class='bx bx-check-circle text-success' style="font-size: 22px;"></i>
                    <p class="text-caption-1">Best Quality items</p>
                </div>
            </div>

            {{-- <ul class="tf-control-layout">
                <li class="tf-view-layout-switch sw-layout-2" data-value-layout="tf-col-2">
                    <div class="item">
                        <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="6" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="14" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="6" cy="14" r="2.5" stroke="#181818"/>
                            <circle cx="14" cy="14" r="2.5" stroke="#181818"/>
                        </svg>
                    </div>
                </li>
                <li class="tf-view-layout-switch sw-layout-3 active" data-value-layout="tf-col-3">
                    <div class="item">
                        <svg class="icon" width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="3" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="11" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="19" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="3" cy="14" r="2.5" stroke="#181818"/>
                            <circle cx="11" cy="14" r="2.5" stroke="#181818"/>
                            <circle cx="19" cy="14" r="2.5" stroke="#181818"/>
                        </svg>
                    </div>
                </li>
                <li class="tf-view-layout-switch sw-layout-4" data-value-layout="tf-col-4">
                    <div class="item">
                        <svg class="icon" width="30" height="20" viewBox="0 0 30 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="3" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="11" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="19" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="27" cy="6" r="2.5" stroke="#181818"/>
                            <circle cx="3" cy="14" r="2.5" stroke="#181818"/>
                            <circle cx="11" cy="14" r="2.5" stroke="#181818"/>
                            <circle cx="19" cy="14" r="2.5" stroke="#181818"/>
                            <circle cx="27" cy="14" r="2.5" stroke="#181818"/>
                        </svg>
                    </div>
                </li>
            </ul> --}}

            {{-- Product Sorting --}}
            <div class="tf-control-sorting">
                <p class="d-none d-lg-block text-caption-1 skeleton">Sort by:</p>
                <div class="tf-dropdown-sort skeleton" data-bs-toggle="dropdown">
                    <div class="btn-select">
                        <span class="text-sort-value">Best selling</span>
                        <i class='bx bx-chevron-down' style="font-size: 20px;"></i>
                    </div>
                    <div class="dropdown-menu">
                        <div class="select-item" data-sort-value="a_z">
                            <span class="text-value-item">Alphabetically, A-Z</span>
                        </div>
                        <div class="select-item" data-sort-value="z_a">
                            <span class="text-value-item">Alphabetically, Z-A</span>
                        </div>
                        <div class="select-item" data-sort-value="price_low_high">
                            <span class="text-value-item">Price, low to high</span>
                        </div>
                        <div class="select-item" data-sort-value="price_high_low">
                            <span class="text-value-item">Price, high to low</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-control-shop">
            <div class="meta_filter_shop">
                {{-- <div class="count-text">
                    <span class="count"><span id="product_count">{{ $products->count() }}</span> Products Found</span>
                </div> --}}
                {{-- <div id="product-count-list" class="count-text"></div> --}}
                {{-- <div id="applied-filters"></div> --}}
                {{-- <button id="remove_all" class="remove_all_filters text-btn-uppercase">Reset Filters <i class='bx bx-x' style="font-size: 20px;"></i></button> --}}
            </div>

            <div class="row">
                <div class="col-xl-3">
                    <div class="sidebar-filter canvas-filter left">
                        <div class="canvas-wrapper">
                            <div class="canvas-header d-flex d-xl-none skeleton">
                                <h5 class="">Filters</h5>
                                <i class='bx bx-x close-filter' style="font-size: 28px; cursor:pointer;"></i>
                            </div>

                            <div class="canvas-body">
                                <form id="filterForm" method="POST">
                                    @csrf

                                    <input type="text" hidden name="product_category_id" id="get_category_id">
                                    <input type="text" hidden name="product_subCategory_id" id="get_subCategory_id">
                                    <input type="text" hidden name="product_childCategory_id" id="get_childCategory_id">
                                    <input type="text" hidden name="size_id" id="get_size_id">
                                    <input type="text" hidden name="color_id" id="get_color_id">
                                    <input type="text" hidden name="brand_id" id="get_brand_id">
                                    <input type="text" hidden name="stock_id" id="get_stock_id">
                                    <input type="text" hidden name="sorting_id" id="get_sorting_id">
                                    <input type="text" hidden name="start_price" id="get_start_price">
                                    <input type="text" hidden name="end_price" id="get_end_price">
                                </form>

                                {{-- Category Wise Filter --}}
                                <div class="widget-facet facet-fieldset accordion-product-item">
                                    <a href="#category" class="skeleton facet-title accordion-title current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="category" style="font-size: 20px;">
                                        <h5>Product Categories</h5>
                                        <span class="btn-open-sub "></span>
                                    </a>

                                    <div id="category" class="box-fieldset-item collapse show" data-bs-parent="#accordion-faq-1">
                                        @if ( request()->has('categories') )
                                            @foreach ($categoryItems as $item)
                                                @php
                                                    $count = App\Models\Product::where('category_id', $item->id)->count();
                                                @endphp

                                                <fieldset class="fieldset-item skeleton">
                                                    <input type="checkbox"
                                                     name="categories" 
                                                     class="tf-check change_category" 
                                                     id="{{ $item->slug }}"
                                                     {{ request()->categories == $item->slug ? 'checked' : '' }}
                                                     value="{{ $item->id }}"
                                                     >
                                                    <label for="{{ $item->slug }}">{{ $item->category_name }} <span class="count-category">( {{ $count }} )</span></label>
                                                </fieldset>
                                            @endforeach

                                        @elseif ( request()->has('sub_categories') )
                                            @foreach ($categoryItems as $item)
                                                @php
                                                   $count = App\Models\Product::where('subCategory_id', $item->id)->count();
                                                @endphp

                                                <fieldset class="fieldset-item skeleton">
                                                    <input type="checkbox" 
                                                    name="sub_categories" 
                                                    class="tf-check change_subCategory" 
                                                    id="{{ $item->slug }}"
                                                    {{ request()->sub_categories == $item->slug ? 'checked' : '' }}
                                                    value="{{ $item->id }}"
                                                    >
                                                    <label for="{{ $item->slug }}">{{ $item->subcategory_name }} <span class="count-category">( {{ $count }} )</span></label>
                                                </fieldset>
                                            @endforeach

                                        @elseif ( request()->has('child_categories') )
                                            @foreach ($categoryItems as $item)
                                                @php
                                                   $count = App\Models\Product::where('childCategory_id', $item->id)->count();
                                                @endphp

                                                <fieldset class="fieldset-item skeleton">
                                                    <input type="checkbox" 
                                                    name="child_categories" 
                                                    class="tf-check change_childCategory" 
                                                    id="{{ $item->slug }}"
                                                    {{ request()->child_categories == $item->slug ? 'checked' : '' }}
                                                    value="{{ $item->id }}"
                                                    >
                                                    <label for="{{ $item->slug }}">{{ $item->name }} <span class="count-category">( {{ $count }} )</span></label>
                                                </fieldset>
                                            @endforeach

                                        @else
                                            @foreach ($categoryItems as $item)
                                                @php
                                                    $count = App\Models\Product::where('category_id', $item->id)->count();
                                                @endphp
                                                <fieldset class="fieldset-item skeleton">
                                                    <input type="checkbox"
                                                        name="brand" 
                                                        class="tf-check change_category" 
                                                        id="{{ $item->slug }}"
                                                        {{ request()->categories == $item->slug ? 'checked' : '' }}
                                                        value="{{ $item->id }}"
                                                        >
                                                    <label for="{{ $item->slug }}">{{ $item->category_name }} <span class="count-category">( {{ $count }} )</span></label>
                                                </fieldset>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                {{-- Price Range Filter --}}
                                <div class="widget-facet facet-price accordion-product-item">
                                    <a href="#price_range" class="skeleton facet-title accordion-title current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="price_range" style="font-size: 20px;">
                                        <h5 >Price</h5>
                                        <span class="btn-open-sub"></span>
                                    </a>

                                    <div id="price_range" class="box-fieldset-item collapse show" data-bs-parent="#accordion-faq-2">
                                        <div class="price-val-range" id="price-value-range" data-min="0" data-max="{{ $maxPrice }}"></div>
                                        <div class="box-price-product">
                                            <div class="box-price-item skeleton">
                                                <span class="title-price">Min price</span>
                                                <div class="price-val price-min-value" id="price-min-value" data-currency="$"></div>
                                            </div>
                                            <div class="box-price-item skeleton">
                                                <span class="title-price">Max price</span>
                                                <div class="price-val price-max-value" id="price-max-value" data-currency="$"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Size Filter --}}
                                <div class="widget-facet facet-size accordion-product-item">
                                    <a href="#size_filter" class="skeleton facet-title accordion-title current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="size_filter" style="font-size: 20px;">
                                        <h5>Size</h5>
                                        <span class="btn-open-sub"></span>
                                    </a>

                                    <div id="size_filter" class="size-box collapse show" data-bs-parent="#accordion-faq-3">
                                        <div class="facet-size-box box-fieldset-item">
                                            @foreach ($product_sizes as $row)
                                                <span class="size-item size-check skeleton" id={{ $row->id }} data-val="0">{{ $row->value }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Colors Filter --}}
                                <div class="widget-facet facet-color accordion-product-item">
                                    <a href="#color_filter" class="skeleton facet-title accordion-title current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="color_filter" style="font-size: 20px;">
                                        <h5>Color</h5>
                                        <span class="btn-open-sub"></span>
                                    </a>

                                    <div id="color_filter" class="collapse show" data-bs-parent="#accordion-faq-4">
                                        <div class="facet-color-box">
                                            @foreach ($product_colors as $row)
                                                <div class="color-item color-check skeleton" id={{ $row->id }} data-val="0">
                                                    <span 
                                                        class="color {{ in_array($row->color_value, ['#FFFFFF', '#FFF', '#F8F8F8']) ? 'line-black' : '' }}" 
                                                        style="background: {{ $row->color_value }};">
                                                    </span>
                                                    {{ $row->value }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Stock Filter --}}
                                <div  class="widget-facet facet-fieldset accordion-product-item">
                                    <a href="#stock_available" class="skeleton facet-title accordion-title current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="stock_available" style="font-size: 20px;">
                                        <h5>Availability</h5>
                                        <span class="btn-open-sub"></span>
                                    </a>

                                    <div id="stock_available" class="box-fieldset-item collapse show" data-bs-parent="#accordion-faq-4">
                                        <fieldset class="fieldset-item skeleton">
                                            <input type="radio" name="availability"  class="tf-check change_stock" id="inStock" value="stock_in">
                                            <label for="inStock">In stock <span class="count-stock">( {{ $stockIn }} )</span></label>
                                        </fieldset>
                                        
                                        <fieldset class="fieldset-item skeleton">
                                            <input type="radio" name="availability" class="tf-check change_stock" id="outStock" value="stock_out">
                                            <label for="outStock">Out of stock <span class="count-stock">( {{ $stockOut }} )</span></label>
                                        </fieldset>
                                    </div>
                                </div>

                                {{-- Brands Filter --}}
                                <div class="widget-facet facet-fieldset accordion-product-item">
                                    <a href="#brand_filter" class="skeleton facet-title accordion-title current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="brand_filter" style="font-size: 20px;">
                                        <h5>Brands</h5>
                                        <span class="btn-open-sub"></span>
                                    </a>

                                    <div id="brand_filter" class="box-fieldset-item collapse show" data-bs-parent="#accordion-faq-6">
                                        @foreach ($brands as $item)
                                                @php
                                                    $count = App\Models\Product::where('brand_id', $item->id)->count();
                                                @endphp
                                            <fieldset class="fieldset-item skeleton">
                                                <input type="checkbox" 
                                                name="brand" 
                                                class="tf-check change_brand" 
                                                value="{{ $item->id }}" 
                                                id="{{ $item->slug }}"
                                                {{ request()->brands == $item->slug ? 'checked' : '' }}
                                                >
                                                <label for="{{ $item->slug }}">{{ $item->brand_name }} <span class="count-brand">( {{ $count }} )</span></label>
                                            </fieldset>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="canvas-bottom d-block d-xl-none">
                                <button id="reset-filter" class="tf-btn btn-reset">Reset Filters</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-9">
                    <div class="wrapper-shop">
                        @include('frontend.include.render_product_page')
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- /Section product -->

@endsection

@push('add-js')
    <script type="text/javascript" src="{{ asset('public/frontend/js/nouislider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/shop.js') }}"></script>

    <script>
        $(document).ready(function(){
            var xhr; 
            var i = 0;

            // Filter Form
            function filterForm(){
                if( xhr && xhr.readyState !== 4){
                    xhr.abort();
                }

                xhr = $.ajax({
                    method: 'POST',
                    url: "{{ url('get_filter_product_ajax') }}",
                    data: $('#filterForm').serialize(),
                    dataType: "json",
                    success: function(data) {
                        if( data.status === true ){
                            $('.wrapper-shop').html(data.success); 
                            $('#product_count').html(data.count); 
                        }
                    },
                    error: function(data) {
                        // toastr.error('Failed to filtering products');
                    },
                });
            }

            // Category Id
            $('.change_category').change(function(){
                console.log('Category changed');
                var ids = '';
                $('.change_category').each(function(){
                    if( this.checked ){
                        var id = $(this).val();
                        ids += id + ',';
                    }
                })

                // console.log(ids);
                $('#get_category_id').val(ids);
                filterForm();
            })

            // SubCategory Id
            $('.change_subCategory').change(function(){
                console.log('change_subCategory');
                var ids = '';
                $('.change_subCategory').each(function(){
                    if( this.checked ){
                        var id = $(this).val();
                        ids += id + ',';
                    }
                })

                // console.log(ids);
                $('#get_subCategory_id').val(ids);
                filterForm();
            })

            // ChildCategory Id
            $('.change_childCategory').change(function(){
                console.log('change_childCategory');
                var ids = '';
                $('.change_childCategory').each(function(){
                    if( this.checked ){
                        var id = $(this).val();
                        ids += id + ',';
                    }
                })

                // console.log(ids);
                $('#get_childCategory_id').val(ids);
                filterForm();
            })
  
            // Size Id
            $(document).on('click', '.size-check', function () {
                console.log('size-check');
                var id     = $(this).attr('id');
                var status = $(this).attr('data-val');
                if( status == 0 ){
                    $(this).attr('data-val', 1);
                    $(this).addClass('active');
                }
                else{
                    $(this).attr('data-val', 0);
                    $(this).removeClass('active');
                }

                var ids = '';
                $('.size-check').each(function(){
                    var status = $(this).attr('data-val');

                    if( status == 1 ){
                        var id = $(this).attr('id');
                        ids += id + ',';
                    }
                });

                // console.log(ids);
                $('#get_size_id').val(ids);
                filterForm();
            });

            // Color Id 
            $(document).on('click', '.color-check', function () {
                console.log('color-check');
                var id     = $(this).attr('id');
                var status = $(this).attr('data-val');
                if( status == 0 ){
                    $(this).attr('data-val', 1);
                    $(this).addClass('active');
                }
                else{
                    $(this).attr('data-val', 0);
                    $(this).removeClass('active');
                }

                var ids = '';
                $('.color-check').each(function(){
                    var status = $(this).attr('data-val');

                    if( status == 1 ){
                        var id = $(this).attr('id');
                        ids += id + ',';
                    }
                });

                // console.log(ids);
                $('#get_color_id').val(ids);
                filterForm();
            });

            // Sorting Id
            $('.select-item').on('click', function(){
                console.log('Sorting-check');
                var id = $(this).attr('data-sort-value');
                // console.log(id);

                $('#get_sorting_id').val(id);
                filterForm();
            })

            // Stock Id
            $('.change_stock').change(function(){
                console.log('change_stock');
                var id = $(this).val();
                // console.log(id);

                $('#get_stock_id').val(id);
                filterForm();
            })

            // Brand Id
            $('.change_brand').change(function(){
                console.log('change_brand');
                var ids = '';
                $('.change_brand').each(function(){
                    if( this.checked ){
                        var id = $(this).val();
                        ids += id + ',';
                    }
                })

                // console.log(ids);
                $('#get_brand_id').val(ids);
                filterForm();
            })

            // Price Range filter
            var rangeTwoPrice = function() {
                if ($("#price-value-range").length > 0) {
                    var skipSlider = document.getElementById("price-value-range");

                    // Destroy slider if it exists (prevents duplicate initialization)
                    if (skipSlider.noUiSlider) {
                        skipSlider.noUiSlider.destroy();
                    }

                    var skipValues = [
                        document.querySelector(".price-min-value"),
                        document.querySelector(".price-max-value"),
                    ];

                    var min = parseInt(skipSlider.getAttribute("data-min"));
                    var max = parseInt(skipSlider.getAttribute("data-max"));

                    noUiSlider.create(skipSlider, {
                        start: [min, max],
                        connect: true,
                        step: 1,
                        range: {
                            min: min,
                            max: max,
                        },
                        format: {
                            from: function(value) {
                                return parseInt(value);
                            },
                            to: function(value) {
                                return parseInt(value);
                            },
                        },
                    });

                    let debounceTimer;
                    skipSlider.noUiSlider.on("update", function(val, e) {
                        console.log('get_start_price');
                        $('#get_start_price').val(parseInt(val[0]));
                        $('#get_end_price').val(parseInt(val[1]));
                        skipValues[e].innerText = val[e];
                        
                        if( i == 0 || i == 1 ){
                            i++;
                        }
                        else{
                            clearTimeout(debounceTimer);
                            debounceTimer = setTimeout(() => {
                                filterForm();
                            }, 150); // Delay by 150ms
                        }
                    });
                }
            };

            rangeTwoPrice();

            // pagination
            $(document).on("click", ".pagination a", function(e){
                e.preventDefault();
                let page = $(this).attr("href").split('page=')[1];
                let formData = $('#filterForm').serialize(); // Serialize the filter form data
                // console.log(page);

                $.ajax({
                    url: "{{ url('/pagination/paginate-data') }}?page=" + page,
                    method: "GET",
                    data: formData, // Send filter data along with pagination
                    success: function(data) {
                        if( data.status === true ){
                            $('.wrapper-shop').html(data.success); 
                            $('#product_count').html(data.count); 
                        }
                    },
                    error: function(data) {
                        // toastr.error('Failed to filtering products');
                    },
                });

            })
            
        })
    </script>

    {{-- Add To Cart Ajax --}}
    @include('frontend.include.full_ajax_cart')
    
@endpush