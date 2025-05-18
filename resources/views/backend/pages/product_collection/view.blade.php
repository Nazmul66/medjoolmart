@extends('backend.layout.master')

@push('title')
    Create Product
@endpush

@push('add-css')

@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Product View List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="header_navbar">
                <ul class="nav nav-pills my-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-main-tab" data-bs-toggle="pill" data-bs-target="#pills-main" type="button" role="tab" aria-controls="pills-main" aria-selected="true">Main Info</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-long-description-tab" data-bs-toggle="pill" data-bs-target="#pills-long-description" type="button" role="tab" aria-controls="pills-long-description" aria-selected="false">Long Description</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-return-policy-tab" data-bs-toggle="pill" data-bs-target="#pills-return-policy" type="button" role="tab" aria-controls="pills-return-policy" aria-selected="false">Return Policy</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-shipping-return-tab" data-bs-toggle="pill" data-bs-target="#pills-shipping-return" type="button" role="tab" aria-controls="pills-shipping-return" aria-selected="false">Shipping Return</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-video-link-tab" data-bs-toggle="pill" data-bs-target="#pills-video-link" type="button" role="tab" aria-controls="pills-video-link" aria-selected="false">Video Link</button>
                      </li>

                  </ul>

                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                   Back
                </a>
            </div>
        </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        {{-- Main Product List --}}
        <div class="tab-pane fade show active" id="pills-main" role="tabpanel" aria-labelledby="pills-main-tab" tabindex="0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card cards">
                        <div class="card-body">
                            <h4 class="mb-3">Product Info</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%">Element Name</th>
                                            <th style="width: 60%">Element Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $product->name }}</td>
                                        </tr>
        
                                        <tr>
                                            <td>Slug</td>
                                            <td>{{ $product->slug }}</td>
                                        </tr>
        
                                        <tr>
                                            <td>Category Name</td>
                                            <td>{{ $product->cat_name }}</td>
                                        </tr>
        
                                        <tr>
                                            <td>SubCategory Name</td>
                                            <td>{{ $product->subCat_name }}</td>
                                        </tr>
        
                                        <tr>
                                            <td>ChildCategory Name</td>
                                            <td>
                                                @if ( !empty( $product->childCat_name ) )
                                                    {{ $product->childCat_name }}
                                                @else
                                                    <span class="text-danger">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Brand Name</td>
                                            <td>
                                                <span class="text-dark">{{ $product->brand_name }}</span>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Is Top Product</td>
                                            <td>
                                                @if ( $product->is_top == 1)
                                                    <button class="btn btn-success">Yes</button>
                                                @else
                                                    <button class="btn btn-danger">No</button>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Is Best Product</td>
                                            <td>
                                                @if ( $product->is_best == 1)
                                                    <button class="btn btn-success">Yes</button>
                                                @else
                                                    <button class="btn btn-danger">No</button>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Is Featured Product</td>
                                            <td>
                                                @if ( $product->is_featured == 1)
                                                   <button class="btn btn-success">Yes</button>
                                                @else
                                                   <button class="btn btn-danger">No</button>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Is Approved</td>
                                            <td>
                                                @if ( $product->is_approved == 1)
                                                    <button class="btn btn-info">Approved</button>
                                                @else
                                                    <button class="btn btn-danger">Pending</button>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                @if ( $product->status == 1)
                                                    <button class="btn btn-success">Active</button>
                                                @else
                                                    <button class="btn btn-danger">Inactive</button>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Offer Date Start</td>
                                            <td>
                                                @if ( !empty($product->offer_start_date) )
                                                    {{ date('d M, Y', strtotime($product->offer_start_date)) }}
                                                @else
                                                   <span class="text-danger">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Offer Date End</td>
                                            <td>
                                                @if ( !empty($product->offer_end_date) )
                                                    {{ date('d M, Y', strtotime($product->offer_end_date)) }}
                                                @else
                                                    <span class="text-danger">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Tags</td>
                                            <td>
                                                @if($product->tags)
                                                    @foreach(explode(',', $product->tags) as $tag)
                                                        <span class="badge bg-primary mb-1" style="padding: 8px 12px; font-size: 14px;">{{ trim($tag) }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">No Tags</span>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Meta Title</td>
                                            <td>
                                                @if ( !empty($product->seo_title) )
                                                    <span class="text-dark">{{ $product->seo_title }}</span>
                                                @else
                                                   <span class="text-danger">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Meta Description</td>
                                            <td>
                                                @if ( !empty($product->seo_description) )
                                                    <span class="text-dark">{{ $product->seo_description }}</span>
                                                @else
                                                   <span class="text-danger">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>Short Description</td>
                                            <td>{{ $product->short_description }}</td>
                                        </tr>

                                        <tr>
                                            <td>Created Date</td>
                                            <td>{{ date('d M, Y', strtotime($product->created_at)) }}</td>
                                        </tr>
        
                                        <tr>
                                            <td>Updated Date</td>
                                            <td>{{ date('d M, Y', strtotime($product->updated_at)) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-lg-6">
                    <div class="card cards">
                        <div class="card-body">
                            <h4 class="mb-3">Thumnail Image</h4>
                            <div class="product_image">
                                <a href="{{ asset($product->thumb_image) }}" target="_blank">
                                    <img src="{{ asset($product->thumb_image) }}" alt="" >
                                </a>
                            </div>
                        </div>
                    </div>  
        
                    <div class="card cards">
                        <div class="card-body">
                            <h4 class="mb-3">Product QRCode</h4>
                            <div class="product_qrcode">
                                <span>{!! DNS2D::getBarcodeHTML($product->barcode, 'QRCODE') !!}</span>
                            </div>
                        </div>
                    </div>    
        
                    <div class="card cards">
                        <div class="card-body">
                            <h4 class="mb-3">Product Management</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%">Element Name</th>
                                            <th style="width: 60%">Element Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Barcode</td>
                                            <td>
                                                <span>{!! DNS1D::getBarcodeHTML($product->barcode, 'EAN13', 2, 50, 'black', true) !!}</span>
                                                <p>Code: {{ $product->barcode }}</p>
                                            </td>
                                        </tr>
        
                                        <tr>
                                            <td>SKU</td>
                                            <td>{{ $product->sku }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Quantity</td>
                                            <td>{{ $product->qty }}</td>
                                        </tr>
        
                                        <tr>
                                            <td>Purchase Price</td>
                                            <td>{{ $product->purchase_price }} TK</td>
                                        </tr>
        
                                        <tr>
                                            <td>Selling Price</td>
                                            <td>{{ $product->selling_price }} Tk</td>
                                        </tr>
        
                                        <tr>
                                            <td>Discount Type</td>
                                            <td>{{ ucwords($product->discount_type) }}</td>
                                        </tr>
        
                                        <tr>
                                            <td>Discount Value</td>
                                            <td>
                                                @if ( $product->discount_type === "amount" )
                                                    {{ $product->discount_value }} Tk
                                                @elseif ( $product->discount_type === "percent" )
                                                    {{ $product->discount_value }} %
                                                @else
                                                    <span class="text-danger">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="pills-long-description" role="tabpanel" aria-labelledby="pills-long-description-tab" tabindex="0">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="multi_description">
                            {!! $product->long_description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="pills-return-policy" role="tabpanel" aria-labelledby="pills-return-policy-tab" tabindex="0">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="multi_description">
                            {!! $product->return_policy !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="pills-shipping-return" role="tabpanel" aria-labelledby="pills-shipping-return-tab" tabindex="0">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="multi_description">
                            {!! $product->shipping_return !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-video-link" role="tabpanel" aria-labelledby="pills-video-link-tab" tabindex="0">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="multi_description">
                            {!! $product->video_link !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>


@endsection


@push('add-script')


@endpush