@extends('backend.layout.master')

@push('title')
   Home Page Setting
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@php
    $popularCategorySection    = json_decode($popularCategorySection->value, true);
    $productSliderSectionOne   = json_decode($productSliderSectionOne->value, true);
    $productSliderSectionTwo   = json_decode($productSliderSectionTwo->value, true);
    $productSliderSectionThree = json_decode($productSliderSectionThree->value, true);
    // dd($productSliderSectionOne);
@endphp

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Home Page Setting</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Home Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- Tab Part --}}
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active mb-2" id="v-popular-category-tab" data-bs-toggle="pill" href="#v-popular-category" role="tab" aria-controls="v-popular-category" aria-selected="false">Popular Category</a>

                    <a class="nav-link mb-2" id="v-slider-section-one-tab" data-bs-toggle="pill" href="#v-slider-section-one" role="tab" aria-controls="v-slider-section-one" aria-selected="false">Product slider section one</a>

                    <a class="nav-link mb-2" id="v-slider-section-two-tab" data-bs-toggle="pill" href="#v-slider-section-two" role="tab" aria-controls="v-slider-section-two" aria-selected="false">Product slider section two</a>

                    <a class="nav-link" id="v-slider-section-three-tab" data-bs-toggle="pill" href="#v-slider-section-three" role="tab" aria-controls="v-slider-section-three" aria-selected="true">Product slider section three</a>
                    </div>
                </div><!-- end col -->

                {{-- Body Part --}}
                <div class="col-md-9">
                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-popular-category" role="tabpanel" aria-labelledby="v-popular-category-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.popular.category.section') }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <h4 class="mb-3">Category 1</h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select main-category" name="cat_one">
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->category_img) }}"
                                                            {{ $row->id == $popularCategorySection[0]['category'] ? 'selected' : ''}}
                                                                >{{ $row->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $subCategories = App\Models\Subcategory::where('category_id', $popularCategorySection[0]['category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label">Sub Category</label>
                                                    <select class="form-select sub-category" name="subCat_one">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($subCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->subcategory_img) }}"
                                                            {{ $row->id == $popularCategorySection[0]['sub_category'] ? 'selected' : ''}}
                                                                >{{ $row->subcategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $childCategories = App\Models\ChildCategory::where('subCategory_id', $popularCategorySection[0]['sub_category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label" >Child Category</label>
                                                    <select class="form-select child-category" name="childCat_one">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($childCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->img) }}"
                                                            {{ $row->id == $popularCategorySection[0]['child_category'] ? 'selected' : ''}}
                                                                >{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="mb-3 mt-3">Category 2</h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select main-category" name="cat_two">
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->category_img) }}"
                                                            {{ $row->id == $popularCategorySection[1]['category'] ? 'selected' : ''}}    
                                                            >{{ $row->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $subCategories = App\Models\Subcategory::where('category_id', $popularCategorySection[1]['category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label">Sub Category</label>
                                                    <select class="form-select sub-category" name="subCat_two">
                                                        <option value="" selected >Select</option>
                                                        @foreach ($subCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->subcategory_img) }}"
                                                            {{ $row->id == $popularCategorySection[1]['sub_category'] ? 'selected' : ''}}
                                                                >{{ $row->subcategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $childCategories = App\Models\ChildCategory::where('subCategory_id', $popularCategorySection[1]['sub_category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label" >Child Category</label>
                                                    <select class="form-select child-category" name="childCat_two">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($childCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->img) }}"
                                                            {{ $row->id == $popularCategorySection[1]['child_category'] ? 'selected' : ''}}
                                                                >{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="mb-3 mt-3">Category 3</h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select main-category" name="cat_three">
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->category_img) }}"
                                                            {{ $row->id == $popularCategorySection[2]['category'] ? 'selected' : ''}}      
                                                            >{{ $row->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $subCategories = App\Models\Subcategory::where('category_id', $popularCategorySection[2]['category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label">Sub Category</label>
                                                    <select class="form-select sub-category" name="subCat_three">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($subCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->subcategory_img) }}"
                                                            {{ $row->id == $popularCategorySection[2]['sub_category'] ? 'selected' : ''}}
                                                                >{{ $row->subcategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $childCategories = App\Models\ChildCategory::where('subCategory_id', $popularCategorySection[2]['sub_category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label" >Child Category</label>
                                                    <select class="form-select child-category" name="childCat_three">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($childCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->img) }}"
                                                            {{ $row->id == $popularCategorySection[2]['child_category'] ? 'selected' : ''}}
                                                                >{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="mb-3 mt-3">Category 4</h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select main-category" name="cat_four">
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->category_img) }}"
                                                            {{ $row->id == $popularCategorySection[3]['category'] ? 'selected' : ''}}      
                                                            >{{ $row->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $subCategories = App\Models\Subcategory::where('category_id', $popularCategorySection[3]['category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label">Sub Category</label>
                                                    <select class="form-select sub-category" name="subCat_four">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($subCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->subcategory_img) }}"
                                                            {{ $row->id == $popularCategorySection[3]['sub_category'] ? 'selected' : ''}}
                                                                >{{ $row->subcategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $childCategories = App\Models\ChildCategory::where('subCategory_id', $popularCategorySection[3]['sub_category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label" >Child Category</label>
                                                    <select class="form-select child-category" name="childCat_four">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($childCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->img) }}"
                                                            {{ $row->id == $popularCategorySection[3]['child_category'] ? 'selected' : ''}}
                                                                >{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="mt-4 btn btn-primary waves-effect waves-light">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="v-slider-section-one" role="tabpanel" aria-labelledby="v-slider-section-one-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.product.slider.section.one') }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <h4 class="mb-3">Product Slider Section One </h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select main-category" name="cat_one">
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->category_img) }}"
                                                            {{ $row->id == $productSliderSectionOne['category'] ? 'selected' : ''}}
                                                            >{{ $row->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $subCategories = App\Models\Subcategory::where('category_id', $productSliderSectionOne['category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label">Sub Category</label>
                                                    <select class="form-select sub-category" name="subCat_one">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($subCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->subcategory_img) }}"
                                                            {{ $row->id == $productSliderSectionOne['sub_category'] ? 'selected' : ''}}
                                                                >{{ $row->subcategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                     @php
                                                        $childCategories = App\Models\ChildCategory::where('subCategory_id', $productSliderSectionOne['sub_category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label" >Child Category</label>
                                                    <select class="form-select child-category" name="childCat_one">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($childCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->img) }}"
                                                            {{ $row->id == $productSliderSectionOne['child_category'] ? 'selected' : ''}}
                                                                >{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="mt-4 btn btn-primary waves-effect waves-light">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-slider-section-two" role="tabpanel" aria-labelledby="v-slider-section-two-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.product.slider.section.two') }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <h4 class="mb-3">Product Slider Section Two </h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select main-category" name="cat_one">
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->category_img) }}"
                                                            {{ $row->id == $productSliderSectionTwo['category'] ? 'selected' : ''}}
                                                            >{{ $row->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $subCategories = App\Models\Subcategory::where('category_id', $productSliderSectionTwo['category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label">Sub Category</label>
                                                    <select class="form-select sub-category" name="subCat_one">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($subCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->subcategory_img) }}"
                                                            {{ $row->id == $productSliderSectionTwo['sub_category'] ? 'selected' : ''}}
                                                                >{{ $row->subcategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                     @php
                                                        $childCategories = App\Models\ChildCategory::where('subCategory_id', $productSliderSectionTwo['sub_category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label" >Child Category</label>
                                                    <select class="form-select child-category" name="childCat_one">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($childCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->img) }}"
                                                            {{ $row->id == $productSliderSectionTwo['child_category'] ? 'selected' : ''}}
                                                                >{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="mt-4 btn btn-primary waves-effect waves-light">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-slider-section-three" role="tabpanel" aria-labelledby="v-slider-section-three-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.product.slider.section.three') }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <h4 class="mb-3">Product Slider Section Three </h4>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Category</label>
                                                    <select class="form-select main-category" name="cat_one">
                                                        <option value="" selected disabled>Select</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->category_img) }}"
                                                            {{ $row->id == $productSliderSectionThree['category'] ? 'selected' : ''}}
                                                            >{{ $row->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    @php
                                                        $subCategories = App\Models\Subcategory::where('category_id', $productSliderSectionThree['category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label">Sub Category</label>
                                                    <select class="form-select sub-category" name="subCat_one">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($subCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->subcategory_img) }}"
                                                            {{ $row->id == $productSliderSectionThree['sub_category'] ? 'selected' : ''}}
                                                                >{{ $row->subcategory_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                     @php
                                                        $childCategories = App\Models\ChildCategory::where('subCategory_id', $productSliderSectionThree['sub_category'])->where('status', 1)->get();
                                                    @endphp
                                                    <label class="form-label" >Child Category</label>
                                                    <select class="form-select child-category" name="childCat_one">
                                                        <option value="" selected>Select</option>
                                                        @foreach ($childCategories as $row)
                                                            <option value="{{ $row->id }}" data-image-url="{{ asset($row->img) }}"
                                                            {{ $row->id == $productSliderSectionThree['child_category'] ? 'selected' : ''}}
                                                                >{{ $row->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="mt-4 btn btn-primary waves-effect waves-light">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--  end col -->
            </div><!-- end row -->
        </div>
    </div>

@endsection

@push('add-script')
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
         //____ Category_id Select2 ____//
         $('.main-category').select2({
            templateResult: formatState, 
            templateSelection: formatState,    
        });

        //____ subCategory_id Select2 ____//
        $('.sub-category').select2({
            templateResult: formatState, 
            templateSelection: formatState,    
        });

        //____ ChildCategory_id Select2 ____//
        $('.child-category').select2({
            templateResult: formatState, 
            templateSelection: formatState,    
        });

        //____ Ajax subCategory ____//
        $('body').on('change', '.main-category', function(e){
            e.preventDefault();
            let id = $(this).val();
            let row = $(this).closest('.row');

            $.ajax({
                method: 'GET',
                url: "{{ route('admin.get.subCategory.data') }}",
                data: {id: id},
                success: function(res){
                    console.log(res.data);
                    let selector = row.find('.sub-category'); // Only update the sub-category in the same row
                    selector.html('<option value="" selected>Select</option>');

                    $.each(res.data, function(i, item){
                        selector.append(`<option value="${item.id}" data-image-url="${item.image_url}">${item.subcategory_name}</option>`);
                    })

                    // Reinitialize Select2 with custom template function
                    selector.select2({
                        templateResult: formatState, // Format options to show image
                        templateSelection: formatState, // Show image in selected option
                        width: '100%'
                    });
                },
                error: function(err){

                },
            })
        })

        //____ Ajax childCategory ____//
        $('body').on('change', '.sub-category', function(e){
            e.preventDefault();
            let id = $(this).val();
            let row = $(this).closest('.row');

            $.ajax({
                method: 'GET',
                url: "{{ route('admin.get.childCategory.data') }}",
                data: {id: id},
                success: function(res){
                    console.log(res.data);
                    let selector = row.find('.child-category'); // Only update the child-category in the same row
                    selector.html('<option value="" selected>Select</option>');

                    $.each(res.data, function(i, item){
                        selector.append(`<option value="${item.id}" data-image-url="${item.image_url}">${item.name}</option>`);
                    })

                    // Reinitialize Select2 with custom template function
                    selector.select2({
                        templateResult: formatState, // Format options to show image
                        templateSelection: formatState, // Show image in selected option
                    });
                },
                error: function(err){

                },
            })
        })


        function formatState (state) {
            if (!state.id) {
                return state.text; // Return text for disabled option
            }

            var imageUrl = $(state.element).data('image-url'); // Access image URL from data attribute

            if (!imageUrl) {
                return state.text; // Return text if no image URL is available
            }

            var $state = $(
                '<span><img src="' + imageUrl + '" style="width: 35px; height: 30px; margin-right: 8px;" /> ' + state.text + '</span>'
            );
            return $state;
        };
    </script>
@endpush