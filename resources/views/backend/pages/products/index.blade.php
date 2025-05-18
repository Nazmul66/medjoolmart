@extends('backend.layout.master')

@push('title')
    All Products List
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
                <h4 class="card-title">Products List</h4>

                @if(auth("admin")->user()->can("create.product"))
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                        Add New
                    </a>
                @endif
            </div>
        </div>
        
        <div class="row px-3 pt-3">
            <div class="col-lg-3">
                <label for="">Categories</label>
                <select class="form-select submitable" name="category_id" id="category_id">
                        <option value="" selected>All</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}" data-image-url="{{ asset($item->category_img) }}">{{ $item->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3">
                <label for="">Sub-Categories</label>
                <select class="form-select submitable" name="subCategory_id" id="subCategory_id">
                        <option value="" selected>All</option>
                    @foreach ($subCategories as $item)
                        <option value="{{ $item->id }}" data-image-url="{{ asset($item->subcategory_img) }}">{{ $item->subcategory_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3">
                <label for="">Product Quantity</label>
                <select class="form-select submitable" name="product_qty" id="product_qty">
                    <option value="" selected>All</option>
                    <option value="0-10">Quantity: 0 - 10</option>
                    <option value="11-25">Quantity: 11 - 25</option>
                    <option value="26-50">Quantity: 26 - 50</option>
                    <option value="51-100">Quantity: 51 - 100</option>
                    <option value="101-250">Quantity: 101 - 250</option>
                </select>
            </div>

            <div class="col-lg-3">
                <label for="">Product Price</label>
                <select class="form-select submitable" name="product_price" id="product_price">
                    <option value="" selected>All</option>
                    <option value="0-250">Price: {{ getSetting()->currency_symbol }}0 - {{ getSetting()->currency_symbol }}250</option>
                    <option value="251-500">Price: {{ getSetting()->currency_symbol }}251 - {{ getSetting()->currency_symbol }}500</option>
                    <option value="501-1000">Price: {{ getSetting()->currency_symbol }}501 - {{ getSetting()->currency_symbol }}1,000</option>
                    <option value="1001-2000">Price: {{ getSetting()->currency_symbol }}1,001 - {{ getSetting()->currency_symbol }}2,000</option>
                    <option value="2001-5000">Price: {{ getSetting()->currency_symbol }}2,001 - {{ getSetting()->currency_symbol }}5,000</option>
                    <option value="5001-10000">Price: {{ getSetting()->currency_symbol }}5,001 - {{ getSetting()->currency_symbol }}10,000</option>
                </select>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <table class="table table-bordered mb-0 datatables">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#SL.</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Quantity</th>
                            <th>Product Categorized</th>
                            <th>Special Featured</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
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
    <script src="{{ asset('public/backend/assets/js/all_plugins.js') }}"></script>

    <script>
     $(document).ready(function () {

        // Choice.js plugin
        // const product_tags = new Choices('.product-tags',{
        //     removeItems: true,
        //     duplicateItemsAllowed: false,
        //     removeItemButton: true,
        //     delimiter: ',',
        // });

        // let tagChoices = new Choices('.up_product_tags',{
        //     removeItems: true,
        //     duplicateItemsAllowed: false,
        //     removeItemButton: true,
        //     delimiter: ',',
        // });


        // Ckeditor 5 plugin
        // let jReq;
        // ClassicEditor
        //     .create(document.querySelector('#long_description'))
        //     .then(newEditor => {
        //         jReq = newEditor;
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });


        //     let longDescriptionEditor;
        //     ClassicEditor
        //         .create(document.querySelector('#up_long_description'))
        //         .then(newEditor => {
        //             longDescriptionEditor = newEditor; // Store the editor instance
        //         })
        //         .catch(error => {
        //             console.error(error);
        //     });

            // function previewImage(event) {
            //     const file = event.target.files[0];
            //     if (file) {
            //         const reader = new FileReader();
            //         reader.onload = e => document.getElementById('image_preview').innerHTML = `
            //         <img src="${e.target.result}" width="100" height="100">`;
            //         reader.readAsDataURL(file);
            //     }
            // }

            // $('#discount_type').on('change', function () {
            //     const selectedValue = $(this).val();
                
            //     if (selectedValue === 'amount' || selectedValue === 'percent') {
            //         $('.discount_value').removeClass('d-none'); // Show the discount_value div
            //     } else {
            //         $('.discount_value').addClass('d-none'); // Hide the discount_value div
            //     }
            // });

            // // Fetching subcategory information
            // $(document).on('input', '.category_id', function(){
            //     var category_id = $(this).val();
            //     // console.log(category_id);

            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('admin.get.product.subCategory.data') }}",
            //         data: {
            //             id: category_id
            //         },
            //         success: function (res) {
            //             console.log(res.data);
            //             if (res.status) {
            //                 // Clear any previous subcategory options
            //                 $('.subCategory_id').empty();
            //                 // Add default "Select" option
            //                 $('.subCategory_id').append('<option value="" disabled selected>Select</option>');

            //                 // Append new subcategories with images
            //                 $.each(res.data, function (key, subCategory) {
            //                     var option = '<option value="' + subCategory.id + '" data-image-url="' + subCategory.image_url + '">' + subCategory.subcategory_name + '</option>';
            //                     $('.subCategory_id').append(option);
            //                 });


            //                 // Trigger select2 to reinitialize so the images appear
            //                 $('#subCategory_id').select2({
            //                     dropdownParent: $('#createModal'),
            //                     templateResult: formatState,
            //                     templateSelection: formatState,
            //                 });
            //             }
            //         },
            //         error: function (err) {
            //             console.log(err);
            //         }

            //     })
            // })


            //  // Fetching Child-subcategory information
            //  $(document).on('input', '.subCategory_id', function(){
            //     var subCategory_id = $(this).val();
            //     // console.log(category_id);

            //     $.ajax({
            //         type: "POST",
            //         url: "{{ route('admin.get.product.childCategory.data') }}",
            //         data: {
            //             id: subCategory_id
            //         },
            //         success: function (res) {
            //             console.log(res.data);
            //             if (res.status) {
            //                 // Clear any previous subcategory options
            //                 $('.childCategory_id').empty();
            //                 // Add default "Select" option
            //                 $('.childCategory_id').append('<option value="" disabled selected>Select</option>');

            //                 // Append new subcategories with images
            //                 $.each(res.data, function (key, childCategory) {
            //                     var option = '<option value="' + childCategory.id + '" data-image-url="' + childCategory.image_url + '">' + childCategory.name + '</option>';
            //                     $('.childCategory_id').append(option);
            //                 });


            //                 // Trigger select2 to reinitialize so the images appear
            //                 $('#childCategory_id').select2({
            //                     dropdownParent: $('#createModal'),
            //                     templateResult: formatState,
            //                     templateSelection: formatState,
            //                 });
            //             }
            //         },
            //         error: function (err) {
            //             console.log(err);
            //         }

            //     })
            // })


            // Show Data through Datatable
            let datatables = $('.datatables').DataTable({
                "order": [
                    [0, 'desc']
                ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url" : "{{ route('admin.product-data') }}",
                    "data": function(e){
                        e.category_id     = $('#category_id').val();
                        e.subCategory_id  = $('#subCategory_id').val();
                        e.product_qty     = $('#product_qty').val();
                        e.product_price   = $('#product_price').val();
                    }
                },
                // pageLength: 30,
                columns: [
                    { 
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false 
                    },
                    {
                        data: 'product_img',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'product_details',
                    },
                    {
                        data: 'quantity',
                    },
                    {
                        data: 'categorized',
                    },
                    {
                        data: 'special_featured',
                    },
                    {
                        data: 'status',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            // status updates
            $(document).on('click', '#status', function () {
                var id = $(this).data('id');
                var status = $(this).data('status');

                // console.log(id, status);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.product.status') }}",
                    data: {
                        // '_token': token,
                        id: id,
                        status: status
                    },
                    success: function (res) {
                        datatables.ajax.reload();

                        if (res.status == 1) {
                            swal.fire(
                                {
                                    title: 'Status Changed to Active',
                                    icon: 'success'
                                })
                        } else {
                            swal.fire(
                                {
                                    title: 'Status Changed to Inactive',
                                    icon: 'success'
                                })
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }

                })
            })

            // Create
            // $('#createForm').submit(function (e) {
            //     e.preventDefault();

            //     let formData = new FormData(this);

            //     $.ajax({
            //         type: "POST",
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         url: "{{ route('admin.product.store') }}",
            //         data: formData,
            //         processData: false,  // Prevent jQuery from processing the data
            //         contentType: false,  // Prevent jQuery from setting contentType
            //         success: function (res) {
            //             console.log(res);
            //             if (res.status === true) {
            //                 $('#createModal').modal('hide');
            //                 $('#createForm')[0].reset();
            //                 datatables.ajax.reload();

            //                 swal.fire({
            //                     title: "Success",
            //                     text: `${res.message}`,
            //                     icon: "success"
            //                 })
            //             }
            //         },
            //         error: function (err) {
            //             let error = err.responseJSON.errors;

            //             $('#image_validate').empty().html(error.thumb_image);
            //             $('#name_validate').empty().html(error.name);
            //             $('#category_id_validate').empty().html(error.category_id);
            //             $('#brand_id_validate').empty().html(error.brand_id);
            //             $('#price_validate').empty().html(error.price);
            //             $('#quantity_validate').empty().html(error.qty);
            //             $('#short_validate').empty().html(error.short_description);
            //             $('#long_validate').empty().html(error.long_description);
            //             $('#is_featured_validate').empty().html(error.is_featured);
            //             $('#is_top_validate').empty().html(error.is_top);
            //             $('#is_best_validate').empty().html(error.is_best);
            //             $('#status_validate').empty().html(error.status);

            //             swal.fire({
            //                 title: "Failed",
            //                 text: "Something Went Wrong !",
            //                 icon: "error"
            //             })
            //         }
            //     });
            // })


            // // Edit 
            // $(document).on("click", '#editButton', function (e) {
            //     let id = $(this).attr('data-id');
            //     // alert(id);

            //     $.ajax({
            //         type: 'GET',
            //         // headers: {
            //         //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         // },
            //         url: "{{ url('admin/product') }}/" + id + "/edit",
            //         processData: false,  // Prevent jQuery from processing the data
            //         contentType: false,  // Prevent jQuery from setting contentType
            //         success: function (res) {
            //             console.log(res.success);
            //             let data = res.success;

            //             $('#id').val(data.id);
            //             $('#up_name').val(data.name);
            //             $('#up_sku').val(data.sku);
            //             $('#up_category_id').val(data.category_id).trigger('change');  // <-- This is important for select2
            //             $('#up_subCategory_id').val(data.subCategory_id).trigger('change');  // <-- This is important for select2
            //             $('#up_childCategory_id').val(data.childCategory_id).trigger('change');  // <-- This is important for select2
            //             $('#up_brand_id').val(data.brand_id).trigger('change');  // <-- This is important for select2
            //             $('#up_price').val(data.price);
            //             $('#up_offer_price').val(data.offer_price);
            //             $('#up_qty').val(data.qty);
            //             $('#up_offer_start_date').val(data.offer_start_date);
            //             $('#up_offer_end_date').val(data.offer_end_date);
            //             $('#up_video_link').val(data.video_link);
            //             $('#up_short').val(data.short_description);

            //             // Set CKEditor content
            //             if (longDescriptionEditor) {
            //                 longDescriptionEditor.setData(data.long_description); // Set long_description
            //             }

            //             // Reinitialize Choices after setting the value
            //             tagChoices.setValue(data.tags.split(','));

            //             $('#up_type').val(data.type);
            //             // $('#up_is_featured').val(data.is_featured);
            //             // $('#up_is_top').val(data.is_top);
            //             // $('#up_is_best').val(data.is_best);
            //             $('#up_seo_title').val(data.seo_title);
            //             $('#up_seo_description').val(data.seo_description);
            //             // Set image
            //             $('#imageShow').html('');
            //             $('#imageShow').append(`
            //              <a href="{{ asset("`+ data.thumb_image +`") }}" target="__blank">
            //                  <img src="{{ asset("`+ data.thumb_image +`") }}" alt="Product Image" style="width: 75px;"> 
            //               </a>
            //             `);
            //         },
            //         error: function (error) {
            //             console.log('error');
            //         }

            //     });
            // })


            // // Update 
            // $("#EditForm").submit(function (e) {
            //     e.preventDefault();

            //     let id = $('#id').val();
            //     let formData = new FormData(this);

            //     $.ajax({
            //         type: "POST",
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         url: "{{ url('admin/product') }}/" + id,
            //         data: formData,
            //         processData: false,  // Prevent jQuery from processing the data
            //         contentType: false,  // Prevent jQuery from setting contentType
            //         success: function (res) {

            //             swal.fire({
            //                 title: "Success",
            //                 text: "Product Edited",
            //                 icon: "success"
            //             })

            //             $('#editModal').modal('hide');
            //             $('#EditForm')[0].reset();
            //             datatables.ajax.reload();
            //         },
            //         error: function (err) {
            //             let error = err.responseJSON.errors;

            //             $('#up_name_validate').empty().html(error.name);
            //             $('#up_category_id_validate').empty().html(error.category_id);
            //             $('#up_price_validate').empty().html(error.price);
            //             $('#up_quantity_validate').empty().html(error.qty);
            //             $('#up_short_validate').empty().html(error.short_description);
            //             $('#up_long_validate').empty().html(error.long_description);

            //             swal.fire({
            //                 title: "Failed",
            //                 text: "Something Went Wrong !",
            //                 icon: "error"
            //             })
            //         }
            //     });
            // });


            // Delete
            $(document).on("click", "#deleteBtn", function () {
                let id = $(this).data('id')

                swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',

                            url: "{{ url('admin/product') }}/" + id,
                            data: {
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            },
                            success: function (res) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: `${res.message}`,
                                    icon: "success"
                                });

                                datatables.ajax.reload();
                            },
                            error: function (err) {
                                console.log('error')
                            }
                        })

                    } else {
                        swal.fire('Your Data is Safe');
                    }
                })
            })
        })


        // Filterable data
        $('.submitable').on('change', function(e){
            $('.datatables').DataTable().ajax.reload();
        })

    </script>
@endpush

