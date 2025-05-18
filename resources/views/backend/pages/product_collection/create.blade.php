@extends('backend.layout.master')

@push('title')
    Create Product CollectIon
@endpush

@push('add-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Create Collection</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Collection</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Create Collection</h4>
                <a href="{{ route('admin.product.collection.index') }}" class="btn btn-primary"> Back</a>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.product.collection.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body mb-3" style="box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.15);">
                                <div class="mb-4">
                                    <h5 for="title" class="mb-3">Title</h5>
                                    <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g Summer Collection, Under $100, Staff Picks">

                                    @error('title')
                                        <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-4">
                                    <h5 for="description" class="mb-3">Description</h5>
                                    <textarea class="form-control" id="description" name="description" rows="8">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        {{-- Product Collection Image --}}
                        <div class="card">
                            <div class="card-body mb-3" style="box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.15);">
                                <h5 for="" class="mb-3">Collection Image</h5>
                                <div class="multiple-image">
                                    <label class="file_div" for="fileUploader" id="image_preview" style="padding: 20px;">
                                        {{-- <h2>Upload</h2> --}}
                                        <img src="{{ asset('public/backend/images/Upload_icon.png') }}" alt="" class="img_upload">
                                        <h3>Upload Files or <span>Browse</span></h3>
                                        <p>Supported formates: JPEG, PNG, JPG</p>
                                        <figcaption class="file_name d-none" ></figcaption>
                                    </label>
                                    <input type="file" class="d-none" id="fileUploader" accept=".jpg, .png, .jpeg, .webp" name="image" >
                                </div>

                                @error('image')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="card-body" style="box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.15);">
                                <h5 for="" class="mb-3">Products <span class="text-danger" style="font-size: 14px;">* Must select products</span></h5>
                                <div class="main_search_product">
                                    <div class="search_product">
                                        <select name="bulk_product" id="bulk_product">
                                            <option value="" disabled selected>Please select a product</option>
                                            @foreach ($products as $row)
                                                <option value="{{ $row->slug }}" data-image-url="{{ asset($row->thumb_image) }}" data-name={{ $row->name }} data-id="{{ $row->id }}" data-qty={{ $row->qty }}>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('bulk_product')
                                    <span class="multi_product text-danger mt-1">{{ $message }}</span>
                                @enderror

                                <div class="">
                                    <table class="table mb-0">
                                        <tbody class="body_part">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>



    {{-- Modal Product Popup  --}}
    {{-- <div class="modal fade bs-example-modal-center" id="search_product" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background: rgba(243, 243, 243, 1);">
                    <h5 style="color: #495057; margin-bottom: 0;
                    line-height: 1.5;">Add Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #000 !important;">X</button>
                </div>

                <div class="modal-header">
                    <div class="search_product">
                        <input type="text" class="form-control" id="search" placeholder="Search Products" style="padding-left: 36px;">
                        <i class='bx bx-search'></i>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="modal_body_height">
                        <table class="table mb-0">
                            <tbody>
                                @foreach ($products as $row)
                                    <tr>
                                        <td>
                                            <div class="search_product_show">
                                                <input type="checkbox" class="form-check-input" id="" value="check-{{ $row->id }}" style="width: 1.2em;
                                                height: 1.2em;">
                                                <img src="{{ asset( $row->thumb_image ) }}" alt="" style="width: 50px;">
                                                <h5>{{ $row->name }}</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div> --}}

@endsection


@push('add-script')
    {{-- data.setData(res.data.schedules_desc); --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>

    <script>
        document.getElementById('fileUploader').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('image_preview');
            const files = event.target.files;

            if (files.length > 0) {
                // Clear existing content
                imagePreview.innerHTML = '';

                // Loop through selected files and display previews
                Array.from(files).forEach(file => {
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.width = '100%';
                            img.style.height = '100%';
                            img.style.objectFit = 'cover';
                            imagePreview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });

        $(document).ready(function () {
            // Ckeditor 5 plugin
            let jReq;
            ClassicEditor
            .create(document.querySelector('#description'))
            .then(newEditor => {
                jReq = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
       });
    </script>

<script>

    $(document).ready(function () {
        // Initialize Select2 for the bulk_product dropdown
        $('#bulk_product').select2({
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

        // When a new product is selected
        $('#bulk_product').on('select2:select', function (e) {
            const selectedValue = e.params.data.id; // Get the selected product ID
            const selectedOption = $(e.params.data.element); // Get the selected option element
            const productId = selectedOption.data('id'); // Get the product name
            const productQty = selectedOption.data('qty'); // Get the product name
            const productName = selectedOption.data('name'); // Get the product name
            const productImage = selectedOption.data('image-url'); // Get the product image URL

            // Disable the option in the dropdown
            selectedOption.prop('disabled', true);
                $('#bulk_product').select2({   // Reinitialize Select2 to reflect the changes
                    templateResult: formatState,
                    templateSelection: formatState,
                });

                // Format options in Select2
                function formatState(state) {
                    if (!state.id) {
                        return state.text;
                    }
                    const imageUrl = $(state.element).data('image-url');
                    if (!imageUrl) {
                        return state.text;
                    }
                    return $(`
                        <span>
                            <img src="${imageUrl}" style="width: 35px; height: 30px; margin-right: 8px;" /> 
                            ${state.text}
                        </span>
                    `);
                }

                $('.multi_product').text('');

            // Append the selected product to the table
            $('.body_part').append(`
                <tr data-id="${selectedValue}">
                    <td>
                        <input type="hidden" value="${productId}" name="product_id[]">
                        <input type="hidden" value="${productName}" name="name[]">
                        <input type="hidden" value="${productQty}" name="qty[]">

                        <div class="search_product_show d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="${productImage}" alt="" style="width: 50px; height: 50px; object-fit: cover;">
                                <h5>${productName}</h5>
                            </div>

                            <div style="font-size: 14px; line-height: 24px;">
                                Qty: ${productQty}
                            </div>

                            <a href="javascript:void(0);" class="text-danger remove-product" style="font-size: 26px; line-height: 24px;">
                                <i class='bx bx-x'></i>
                            </a>
                        </div>
                    </td>
                </tr>
            `);

            // Reset the dropdown after a value is selected
            // $('#bulk_product').val('').trigger('change');
        });

        // Handle removal of a product from the table
        $(document).on('click', '.remove-product', function () {
            const row = $(this).closest('tr'); // Find the closest row (tr)
            row.remove(); // Remove the row from the table
            toastr.success('Product removed successfully!');
        });
    });
</script>

@endpush