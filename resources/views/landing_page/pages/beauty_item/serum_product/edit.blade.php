@extends('backend.layout.master')

@push('title')
    Update Landing Page
@endpush

@push('add-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    @php
        $useful_lists = json_decode($landingPage->useful_list_name);
        $why_lists    = json_decode($landingPage->why_list_name);
    @endphp

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Serum Landing Page</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Landing Page</li>
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
                <h4 class="card-title">Update Serum Product</h4>
                <a href="{{ route('admin.serum.index') }}" class="btn btn-primary"> Back</a>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.serum.update', $landingPage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Header Title--}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="slug" class="card-title mb-3">Product Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $landingPage->slug }}" required placeholder="Slug Here.....">
                            </div>

                            <div class="col-lg-6">
                                <label for="header_title" class="card-title mb-3">Header Title</label>
                                <input type="text" class="form-control" id="header_title" name="header_title" value="{{ $landingPage->header_title }}" required placeholder="Header Title Here.....">
                            </div>
                        </div>
                    </div>
                </div>
    

                {{-- Product showcase --}}
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Product Showcase</h3>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_product_id" class="form-label">First Product <span class="text-danger">*</span></label>
                                    <select class="form-select" id="first_product_id" name="first_product_id">
                                        <option value="" disabled>Select First Product</option>
                
                                        @foreach ($products as $row)
                                            <option value="{{ $row->id }}" @if( $landingPage->first_product_id == $row->id ) selected @endif 
                                                data-image-url="{{ asset($row->thumb_image) }}"
                                                >{{ $row->name }}</option>
                                        @endforeach
                                    </select>
    
                                    <span id="product_id_validate" class="text-danger mt-2">
                                        @error('product_id'){{ $message }}@enderror
                                    </span>
                                </div>
    
                                <div class="col-md-6 mb-3">
                                    <label for="second_product_id" class="form-label">Second Product <span class="text-danger">*</span></label>
                                    <select class="form-select" id="second_product_id" name="second_product_id">
                                        <option value="" disabled>Select Second Product</option>
                
                                        @foreach ($products as $row)
                                            <option value="{{ $row->id }}" 
                                                @if( $landingPage->second_product_id == $row->id ) selected @endif 
                                                data-image-url="{{ asset($row->thumb_image) }}"
                                                >{{ $row->name }}</option>
                                        @endforeach
                                    </select>
    
                                    <span id="brand_id_validate" class="text-danger mt-2">
                                        @error('brand_id'){{ $message }}@enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- List Data Link --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label" for="">ব্যবহারের উপকারীতা</label>

                                <div class="table-responsive text-nowrap mb-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>List Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-border-bottom-0 useful_table_extend">
                                            @if ( !empty($useful_lists) )
                                                @foreach ($useful_lists as $item)
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control useful_list_name"  name="useful_list_name[]" 
                                                            value="{{ $item }}">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger useful_delete_btn">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control useful_list_name"  name="useful_list_name[]">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info useful_add_btn">Add</button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label" for="">আমাদের কাছে থেকে কোন কিনবেন?</label>

                                <div class="table-responsive text-nowrap mb-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>List Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="table-border-bottom-0 why_table_extend">
                                            @if ( !empty($why_lists) )
                                                @foreach ($why_lists as $item)
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control why_list_name"  name="why_list_name[]" 
                                                            value="{{ $item }}">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger why_delete_btn">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control why_list_name" name="why_list_name[]">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info why_add_btn">Add</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    
                {{-- Youtube Video Link --}}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <label class="form-label" for="video_link">Video Link</label>
                                <textarea class="form-control" id="video_link" name="video_link"  rows="7" placeholder="Link Paste Here....">{{ old('video_link', $landingPage->video_link) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Social Link --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 ">
                                <div class="mb-3">
                                    <label class="form-label" for="facebook_link">Facebook Link</label>
                                    <input type="url" class="form-control" name="facebook_link" placeholder="Facebook Link....." value="{{ $landingPage->facebook_link }}" >
                                </div>
                            </div>

                            <div class="col-lg-6 ">
                                <div class="mb-3">
                                    <label class="form-label" for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" placeholder="Phone Number....." value="{{ $landingPage->phone_number }}" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Multiple Image --}}
                <div class="card">
                    <div class="card-body">
                        <div class="multiple-image">
                            <label class="file_div" for="fileUploader">
                                {{-- <h2>Upload</h2> --}}
                                <img src="{{ asset('public/backend/images/Upload_icon.png') }}" alt="" class="img_upload">
                                <h3>Upload Files or <span>Browse</span></h3>
                                <p>Supported formates: JPEG, PNG, JPG</p>
                                <figcaption class="file_name d-none" ></figcaption>
                            </label>
                            <input type="file" class="d-none" id="fileUploader" accept=".jpg, .png, .jpeg, .webp" name="images[]" multiple >

                            <div id="previewContainer" class="preview-container"></div>

                            <div class="row mt-3" id="sortable">
                                @foreach ($serumReviewImages as $item)
                                    <div class="images_container image_sortable" >
                                        <img src="{{ asset($item->images) }}" alt="">
                                        <a href="{{ route('admin.review-serum-image.delete', $item->id ) }}" class="delete-image" >
                                            <i class='bx bx-x x-image'></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

    
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light">Save changes</button>
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
        $(document).ready(function () {
            let selectedFiles = []; // Array to track selected files

            document.getElementById('fileUploader').addEventListener('change', function (event) {
                const previewContainer = document.getElementById('previewContainer');
                const files = Array.from(event.target.files);

                // Add new files to the `selectedFiles` array
                selectedFiles.push(...files);

                // Clear the preview container and re-render previews
                renderPreviews(previewContainer);
            });

            function renderPreviews(previewContainer) {
                previewContainer.innerHTML = ''; // Clear existing previews

                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const preview = document.createElement('div');
                        preview.className = 'preview';
                        preview.innerHTML = `
                            <img src="${e.target.result}" alt="Preview Image">
                            <button class="delete-btn" data-index="${index}">&times;</button>
                        `;
                        previewContainer.appendChild(preview);

                        // Handle delete button
                        preview.querySelector('.delete-btn').addEventListener('click', function () {
                            // Remove the file from the `selectedFiles` array
                            selectedFiles.splice(index, 1);

                            // Re-render the previews
                            renderPreviews(previewContainer);
                        });
                    };
                    reader.readAsDataURL(file);
                });
            }

            // add new input rows
            $(document).on("click", ".useful_add_btn", function(){
                $('.useful_table_extend').prepend(`
                    <tr>
                        <td>
                            <input type="text" class="form-control useful_list_name" name="useful_list_name[]">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger useful_delete_btn">Remove</button>
                        </td>
                    </tr>
                `);
            });

            // delete all single input rows
            $(document).on("click", ".useful_delete_btn", function(){
                $(this).closest("tr").remove();
            })

            // add new input rows
            $(document).on("click", ".why_add_btn", function(){
                $('.why_table_extend').prepend(`
                    <tr>
                        <td>
                            <input type="text" class="form-control why_list_name" name="why_list_name[]">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger why_delete_btn">Remove</button>
                        </td>
                    </tr>
                `);
            });

            // delete all single input rows
            $(document).on("click", ".why_delete_btn", function(){
                $(this).closest("tr").remove();
            })


            //____  Select2 ____//
            $('#first_product_id').select2({
                // dropdownParent: $('#createModal'),
                templateResult: formatState,
                templateSelection: formatState,
            });

            $('#second_product_id').select2({
                // dropdownParent: $('#createModal'),
                templateResult: formatState,
                templateSelection: formatState,
            });

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
        });
    </script>
@endpush