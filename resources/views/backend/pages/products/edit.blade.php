@extends('backend.layout.master')

@push('title')
    Create Product
@endpush

@push('add-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                {{-- <h4 class="card-title">Products List</h4> --}}
                <h4 class="card-title">Update Products</h4>
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary"> Back</a>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                <div class="row align-items-end">
                    <div class="col-md-4 mb-3">
                        <div class="d-flex gap-3 align-items-end">
                            <div id="image_preview">
                                <img src="{{ asset($product->thumb_image) }}" width="100" height="100">
                            </div>
    
                            <div class="">
                                <label for="thumb_image" class="form-label">Product Image <sup class="text-danger" style="font-size: 12px;">* resolution (520 x 680)</sup></label>
                                <input type="file" class="form-control" name="thumb_image" id="thumb_image" accept=".png, .jpeg, .jpg, .webp" onchange="previewImage(event)">
                            </div>
                        </div>
    
                        <span id="image_validate" class="text-danger mt-2">
                            @error('thumb_image'){{ $message }}@enderror
                        </span>
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Write product name...." value="{{ old('name', $product->name) }}">
    
                        <span id="name_validate" class="text-danger mt-2">
                            @error('name'){{ $message }}@enderror
                        </span>
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label for="sku" class="form-label">Product Sku <span class="text-danger">*</span></label>
                        <input class="form-control" id="sku" type="text" name="sku" readonly placeholder="Write product sku...." value="{{ $product->sku }}">

                        <span id="name_validate" class="text-danger mt-2">
                            @error('sku'){{ $message }}@enderror
                        </span>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="category_id">Category <span class="text-danger">*</span></label>
                        <select class="form-select category_id" id="category_id" name="category_id">
                            <option value="" disabled selected>Select</option>
    
                            @foreach ($categories as $row)
                                 <option value="{{ $row->id }}" 
                                    data-image-url="{{ asset($row->category_img) }}"
                                    {{ old('category_id', $product->category_id ?? '') == $row->id ? 'selected' : '' }}
                                    >{{ $row->category_name }}</option>
                            @endforeach
                        </select>
    
                        <span id="category_id_validate" class="text-danger mt-2">
                            @error('category_id'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="subCategory_id">SubCategory <span class="text-danger">*</span></label>
                        <select class="form-select subCategory_id" id="subCategory_id" name="subCategory_id">
                            <option value="" disabled selected>Select</option>
                            @foreach ($subCategories as $row)
                                <option value="{{ $row->id }}" 
                                    data-image-url="{{ asset($row->subcategory_img) }}"
                                    {{ old('subCategory_id', $product->subCategory_id ?? '') == $row->id ? 'selected' : '' }}
                                    >{{ $row->subcategory_name }}</option>
                            @endforeach
                        </select>

                        <span id="subCategory_id_validate" class="text-danger mt-2">
                            @error('subCategory_id'){{ $message }}@enderror
                        </span>
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="childCategory_id">ChildCategory</label>
                        <select class="form-select childCategory_id" id="childCategory_id" name="childCategory_id">
                            <option value="" disabled selected>Select</option>
    
                            @foreach ($childCategories as $row)
                                <option value="{{ $row->id }}" 
                                    data-image-url="{{ asset($row->img) }}"
                                    {{ old('childCategory_id', $product->childCategory_id ?? '') == $row->id ? 'selected' : '' }}
                                    >
                                    {{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="brand_id">Brand <span class="text-danger">*</span></label>
                        <select class="form-select" id="brand_id" name="brand_id">
                            <option value="" disabled selected>Select</option>
    
                            @foreach ($brands as $row)
                                <option value="{{ $row->id }}" 
                                    data-image-url="{{ asset($row->image) }}"
                                    {{ old('brand_id', $product->brand_id ?? '') == $row->id ? 'selected' : '' }}
                                    >{{ $row->brand_name }}</option>
                            @endforeach
                        </select>

                        <span id="brand_id_validate" class="text-danger mt-2">
                            @error('brand_id'){{ $message }}@enderror
                        </span>
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="purchase_price">Purchase Price <span class="text-danger">*</span></label>
                        <input class="form-control" id="purchase_price" type="number" name="purchase_price" min="0" value="{{ old('purchase_price', $product->purchase_price) }}" placeholder="Purchase Price....">
    
                        <span id="purchase_price_validate" class="text-danger mt-2">
                            @error('purchase_price'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="selling_price">Selling Price <span class="text-danger">*</span></label>
                        <input class="form-control" id="selling_price" type="number" name="selling_price" min="0" value="{{ old('selling_price', $product->selling_price) }}" placeholder="Selling Price....">

                        <span id="selling_price_validate" class="text-danger mt-2">
                            @error('selling_price'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="discount_type">Discount Type</label>
                        <select class="form-select" id="discount_type" name="discount_type">
                            <option value="none" {{ old('discount_type', $product->discount_type ?? 'none') === 'none' ? 'selected' : '' }}>Select Discount Type</option>

                            <option value="amount" {{ old('discount_type', $product->discount_type ?? '') === 'amount' ? 'selected' : '' }}>Amount ( TK )</option>
                            
                            <option value="percent" {{ old('discount_type', $product->discount_type ?? '') === 'percent' ? 'selected' : '' }}>Percent ( % )</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="qty">Stock Quantity <span class="text-danger">*</span></label>
                        <input class="form-control" min="0" id="qty" type="number" name="qty" placeholder="Product Quantity...." value="{{ old('qty', $product->qty) }}">
    
                        <span id="quantity_validate" class="text-danger mt-2">
                            @error('qty'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="units">Units</label>
                        <select class="form-select" id="units" name="units">
                            @foreach (config('units_data.units') as $key => $row)
                                <option value="{{ $key }}"  {{ (old('units', $product->units ?? '') == $key) ? 'selected' : '' }}>{{ $row }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3 discount_value d-none">
                        <label class="form-label" for="discount_value">Discount Value <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" id="discount_value" name="discount_value" value="{{ old('discount_value', $product->discount_value ?? 0) }}"  placeholder="Discount Value....">

                        <span id="long_validate" class="text-danger mt-1">
                            @error('discount_value'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="col-md-4 mb-3 offer_start_value d-none">
                        <label class="form-label" for="offer_start_date">Offer Start Date <span class="text-danger">*</span></label>
                        <input class="form-control offer_start_date" type="date" id="offer_start_date" name="offer_start_date" placeholder="Select a date...." value="{{ old('offer_start_date', $product->offer_start_date) }}">

                        <span id="offer_start_validate" class="text-danger mt-2">
                            @error('offer_start_date'){{ $message }}@enderror
                        </span>
                    </div>
    
                    <div class="col-md-4 mb-3 offer_end_value d-none">
                        <label class="form-label" for="offer_end_date">Offer End Date <span class="text-danger">*</span></label>
                        <input class="form-control offer_end_date" type="date" id="offer_end_date" name="offer_end_date" value="{{ old('offer_end_date', $product->offer_end_date) }}" placeholder="Select a date....">

                        <span id="offer_end_validate" class="text-danger mt-2">
                            @error('offer_end_date'){{ $message }}@enderror
                        </span>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="video_link">Video Link</label>
                        <textarea class="form-control" id="video_link" name="video_link"  rows="7" placeholder="Link Paste Here....">{{ old('video_link', $product->video_link) }}</textarea>
                    </div>
    
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="short">Short Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="short" class="" name="short_description" rows="7" placeholder="Short Description....">{{ old('short_description', $product->short_description) }}</textarea>
    
                        <span id="short_validate" class="text-danger mt-2">
                            @error('short_description'){{ $message }}@enderror
                        </span>
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="long_description">Long Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="long_description" name="long_description" rows="8" placeholder="Long Description....">{{ old('long_description', $product->long_description) }}</textarea>
                    </div>
    
                    <span id="long_validate" class="text-danger mt-1">
                        @error('long_description'){{ $message }}@enderror
                    </span>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="return_policy">Return Policy </label>
                        <textarea class="form-control" id="return_policy" name="return_policy" rows="8" placeholder="Return Policy....">{{ old('return_policy', $product->return_policy) }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label" for="shipping_return">Shipping Return</label>
                        <textarea class="form-control" id="shipping_return" name="shipping_return" rows="8" placeholder="Shipping Return....">{{ old('shipping_return', $product->shipping_return) }}</textarea>
                    </div>
                </div>
    
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="product_size"><strong>Multiple Products Tag</strong></label>
                    <input type="text" class="product-tags" value="{{ old('tags', $product->tags) }}" name="tags" />
                </div>
    
                <div class="row">
                    {{-- <div class="col-md-4 mb-3">
                        <label class="form-label" for="type">Product Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="" disabled selected>Select</option>
                            <option value="new_arrived">New Arrived</option>
                            <option value="featured">Featured</option>
                            <option value="best">Best</option>
                            <option value="top">Top</option>
                        </select>
                    </div> --}}
    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="is_featured">Is Featured</label>
                        <select class="form-select" id="is_featured" name="is_featured">
                            <option value="1" @if(old('is_featured', $product->is_featured) == 1) selected @endif>Yes</option>
                            <option value="0" @if(old('is_featured', $product->is_featured) == 0) selected @endif>No</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="is_top">Is Top</label>
                        <select class="form-select" id="is_top" name="is_top">
                            <option value="1" @if(old('is_top', $product->is_top) == 1) selected @endif>Yes</option>
                            <option value="0" @if(old('is_top', $product->is_top) == 0) selected @endif>No</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="is_best">Is Best</label>
                        <select class="form-select" id="is_best" name="is_best">
                            <option value="1" @if(old('is_best', $product->is_best) == 1) selected @endif>Yes</option>
                            <option value="0" @if(old('is_best', $product->is_best) == 0) selected @endif>No</option>
                        </select>
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="seo_title">SEO Title</label>
                        <input class="form-control" id="seo_title" type="text" name="seo_title" placeholder="Write SEO Title...." value="{{ old('seo_title', $product->seo_title) }}">
                    </div>
    
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="seo_description">SEO Description</label>
                        <input class="form-control" id="seo_description" type="text" name="seo_description" placeholder="Write SEO Description...." value="{{ old('seo_description', $product->seo_description) }}">
                    </div>
                </div>
    
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </form>
        </div>
    </div>


@endsection


@push('add-script')
    {{-- data.setData(res.data.schedules_desc); --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
    <script src="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>

    <script>

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('image_preview').innerHTML = `
                <img src="${e.target.result}" width="100" height="100">`;
                reader.readAsDataURL(file);
            }
        }

        $(document).ready(function () {
            function toggleDiscountDivs() {
                const selectedValue = $('#discount_type').val();

                if (selectedValue === 'amount' || selectedValue === 'percent') {
                    // Show all related divs
                    $('.discount_value').removeClass('d-none'); // Show discount value div (if it exists)
                    $('.offer_start_value').removeClass('d-none'); // Show offer start date div
                    $('.offer_end_value').removeClass('d-none'); // Show offer end date div
                } else {
                    // Hide all related divs
                    $('.discount_value').addClass('d-none');
                    $('.offer_start_value').addClass('d-none');
                    $('.offer_end_value').addClass('d-none');
                }
            }

            // Initial check on page load
            toggleDiscountDivs();

            // Event listener for changes to #discount_type
            $('#discount_type').on('change', function () {
                toggleDiscountDivs();
            });

            // Flatpicker Plugin
            $(".offer_start_date").flatpickr({
                minDate: "today"
            });

            $(".offer_end_date").flatpickr({
                minDate: "today",
            });

            // Choice.js plugin
            const product_tags = new Choices('.product-tags',{
                removeItems: true,
                duplicateItemsAllowed: false,
                removeItemButton: true,
                delimiter: ',',
            });

            // Ckeditor 5 plugin
            let jReq;
            ClassicEditor
                .create(document.querySelector('#long_description'))
                .then(newEditor => {
                    jReq = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });


            let policy;
            ClassicEditor
                .create(document.querySelector('#return_policy'))
                .then(newEditor => {
                    policy = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });


            let shipping;
            ClassicEditor
                .create(document.querySelector('#shipping_return'))
                .then(newEditor => {
                    shipping = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });

            // Initialize Select2 for category, subcategory, and child category
            initializeSelect2();

            // Automatically populate subcategories and child categories if category/subcategory is pre-selected
            const selectedCategoryId = "{{ old('category_id', $product->category_id ?? '') }}";
            if (selectedCategoryId) {
                populateSubCategories(selectedCategoryId, "{{ old('subCategory_id', $product->subCategory_id ?? '') }}");
            }

            const selectedSubCategoryId = "{{ old('subCategory_id', $product->subCategory_id ?? '') }}";
            if (selectedSubCategoryId) {
                populateChildCategories(selectedSubCategoryId, "{{ old('childCategory_id', $product->childCategory_id ?? '') }}");
            }

            // Handle category change event
            $(document).on('change', '.category_id', function () {
                const category_id = $(this).val();
                populateSubCategories(category_id); // Fetch subcategories
                clearChildCategories(); // Clear child categories since subcategory has changed
            });

            // Handle subcategory change event
            $(document).on('change', '.subCategory_id', function () {
                const subCategory_id = $(this).val();
                if (subCategory_id) {
                    populateChildCategories(subCategory_id); // Fetch child categories
                } else {
                    clearChildCategories(); // Clear child categories if no subcategory is selected
                }
            });

            // Function to populate subcategories
            function populateSubCategories(category_id, selectedSubCategoryId = null) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.get.product.subCategory.data') }}",
                    data: { id: category_id },
                    success: function (res) {
                        if (res.status && res.data.length > 0) {
                            // Populate subcategory dropdown
                            $('.subCategory_id').empty().append('<option value="" disabled selected>Select</option>');
                            $.each(res.data, function (key, subCategory) {
                                $('.subCategory_id').append(
                                    `<option value="${subCategory.id}" data-image-url="${subCategory.image_url}">${subCategory.subcategory_name}</option>`
                                );
                            });

                            // Reinitialize Select2 and set selected subcategory if applicable
                            $('#subCategory_id').select2({
                                templateResult: formatState,
                                templateSelection: formatState,
                            });

                            if (selectedSubCategoryId) {
                                $('.subCategory_id').val(selectedSubCategoryId).trigger('change');
                            }
                        } else {
                            clearSubCategories(); // Clear if no subcategories exist
                            clearChildCategories(); // Clear child categories too
                        }
                    },
                    error: function (err) {
                        console.error(err);
                    },
                });
            }

            // Function to populate child categories
            function populateChildCategories(subCategory_id, selectedChildCategoryId = null) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.get.product.childCategory.data') }}",
                    data: { id: subCategory_id },
                    success: function (res) {
                        if (res.status && res.data.length > 0) {
                            // Populate child category dropdown
                            $('.childCategory_id').empty().append('<option value="" disabled selected>Select</option>');
                            $.each(res.data, function (key, childCategory) {
                                $('.childCategory_id').append(
                                    `<option value="${childCategory.id}" data-image-url="${childCategory.image_url}">${childCategory.name}</option>`
                                );
                            });

                            // Reinitialize Select2 and set selected child category if applicable
                            $('#childCategory_id').select2({
                                templateResult: formatState,
                                templateSelection: formatState,
                            });

                            if (selectedChildCategoryId) {
                                $('.childCategory_id').val(selectedChildCategoryId).trigger('change');
                            }
                        } else {
                            clearChildCategories(); // Clear if no child categories exist
                        }
                    },
                    error: function (err) {
                        console.error(err);
                    },
                });
            }

            // Function to clear subcategories
            function clearSubCategories() {
                $('.subCategory_id').empty().append('<option value="" disabled selected>Select</option>');
                $('#subCategory_id').select2({
                    templateResult: formatState,
                    templateSelection: formatState,
                });
            }

            // Function to clear child categories
            function clearChildCategories() {
                $('.childCategory_id').empty().append('<option value="" disabled selected>Select</option>');
                $('#childCategory_id').select2({
                    templateResult: formatState,
                    templateSelection: formatState,
                });
            }

            // Function to initialize Select2
            function initializeSelect2() {
                $('#category_id, #subCategory_id, #childCategory_id').select2({
                    templateResult: formatState,
                    templateSelection: formatState,
                });
            }

            // Function for formatting select2 options
            function formatState(state) {
                if (!state.id) {
                    return state.text; // Return text for placeholder option
                }

                const imageUrl = $(state.element).data('image-url'); // Access image URL from data attribute
                if (!imageUrl) {
                    return state.text; // Return text if no image URL is available
                }

                return $(
                    `<span><img src="${imageUrl}" style="width: 35px; height: 30px; margin-right: 8px;" /> ${state.text}</span>`
                );
            }


    });
    </script>
@endpush