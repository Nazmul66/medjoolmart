@extends('backend.layout.master')

@push('title')
    Create Child-Category
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Child Categories List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Child Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Child Categories List</h4>

                @if( auth("admin")->user()->can("create.childcategory") )
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Add New
                    </button>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <table class="table table-bordered mb-0" id="datatables">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>#SL.</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Subcategory Name</th>
                        <th>Childcategory Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Modal -->
        <div id="createModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-scroll="true"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">Create Child-Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="createForm" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                <select class="form-select category_id" name="category_id" id="category_id">
                                    <option value="" disabled selected>Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" data-image-url="{{ asset($category->category_img) }}">{{ $category->category_name }}</option>
                                        @endforeach
                                </select>

                                <span id="cat_name_validate" class="text-danger validation-error mt-1"></span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">SubCategory Name <span class="text-danger">*</span></label>
                                <select class="form-select subCategory_id" name="subCategory_id" id="subCategory_id">
                                    <option value="" disabled selected>Select </option>
                                        @foreach ($subCategories as $subCat)
                                            <option value="{{ $subCat->id }}" data-image-url="{{ asset($subCat->subcategory_img) }}">{{ $subCat->subcategory_name }}</option>
                                        @endforeach
                                </select>

                                <span id="subCat_name_validate" class="text-danger validation-error mt-1"></span>
                            </div>

                            <div class="mb-3">
                                <label for="childCategory_name" class="form-label">ChildCategory Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="childCategory_name" type="text" name="name" placeholder="ChildCategory Name">

                                <span id="childCat_name_validate" class="text-danger validation-error mt-1"></span>
                            </div>

                            <div class="mb-3">
                                <label for="childCategory_img" class="form-label">Image <sup class="text-danger" style="font-size: 12px;">* resolution(100 x 100)</sup></label>
                                <input type="file" class="form-control" name="img" id="childCategory_img" accept=".png, .jpeg, .jpg, .webp" onchange="previewImage(event)">

                                <span id="image_validate" class="text-danger validation-error mt-1"></span>

                                <div id="image_preview" class="mt-3">
                                    <img src="{{ asset('public/backend/assets/images/no_Image_available.jpg') }}" width="100" height="100">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" name="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                                <span id="status_validate" class="text-danger validation-error mt-1"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3" data-bs-dismiss="modal">Close
                                </button>

                                <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>


        <!-- Edit Modal -->
        <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-scroll="true"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">Update Child Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="EditForm" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <input type="text" name="id" id="up_id" hidden>

                            <div class="mb-3">
                                <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                <select class="form-select category_id" name="category_id" id="up_category_id">
                                    <option value="" disabled selected>Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" data-image-url="{{ asset($category->category_img) }}">{{ $category->category_name }}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">SubCategory Name <span class="text-danger">*</span></label>
                                <select class="form-select subCategory_id" name="subCategory_id" id="up_subCategory_id">
                                    <option value="" disabled selected>Select</option>
                                        @foreach ($subCategories as $subCat)
                                            <option value="{{ $subCat->id }}" data-image-url="{{ asset($subCat->subcategory_img) }}">{{ $subCat->subcategory_name }}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="childCategory_name" class="form-label">ChildCategory Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="up_childCategory_name" type="text" name="name" placeholder="ChildCategory Name">

                                <span id="up_childCat_name_validate" class="text-danger validation-error mt-1"></span>
                            </div>

                            <div class="mb-3">
                                <label for="childCategory_img" class="form-label">Category Image  <sup class="text-danger" style="font-size: 12px;">* resolution(100 x 100)</sup></label>
                                <input type="file" class="form-control" name="img" id="childCategory_img" accept=".png, .jpeg, .jpg, .webp" onchange="imageShow(event)">

                                <div id="imageShow" class="mt-3"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="up_status" name="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3" data-bs-dismiss="modal">Close
                                </button>

                                <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>


        <!-- View Modal -->
        <div id="viewModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-scroll="true"
        style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">View ChildSubCategory List</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <div class="view_modal_content">
                            <label>Category Name : </label>
                            <span class="text-dark" id="view_category_name"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>SubCategory Name : </label>
                            <span class="text-dark" id="view_subCategory_name"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>ChildCategory Name : </label>
                            <span class="text-dark" id="view_childCategory_name"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Image : </label>
                            <div id="viewImageShow"></div>
                        </div>

                        <div class="view_modal_content">
                            <label>Created Date : </label>
                            <div id="created_date"></div>
                        </div>

                        <div class="view_modal_content">
                            <label>Updated Date : </label>
                            <div id="updated_date"></div>
                        </div>

                        <div class="view_modal_content">
                            <label>Status : </label>
                            <div id="view_status"></div>
                        </div>
                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>

@endsection

@push('add-script')
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

        function imageShow(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => document.getElementById('imageShow').innerHTML = `
                <img src="${e.target.result}" width="100" height="100">`;
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        $(document).ready(function () {

            //____ Category_id Select2 ____//
            $('#category_id').select2({
                dropdownParent: $('#createModal'),
                templateResult: formatState, // Only Text content when select, it will be shown 
                templateSelection: formatState,    // When select any option, it will be display image and text both
            });

            //____ subCategory_id Select2 ____//
            $('#subCategory_id').select2({
                dropdownParent: $('#createModal'),
                templateResult: formatState, // Only Text content when select, it will be shown 
                templateSelection: formatState,    // When select any option, it will be display image and text both
            });

            //____ up_category_id Select2 ____//
            $('#up_category_id').select2({
                dropdownParent: $('#editModal'),
                templateResult: formatState, // Only Text content when select, it will be shown 
                templateSelection: formatState,    // When select any option, it will be display image and text both
            });

            //____ up_subCategory_id Select2 ____//
            $('#up_subCategory_id').select2({
                dropdownParent: $('#editModal'),
                templateResult: formatState, // Only Text content when select, it will be shown 
                templateSelection: formatState,    // When select any option, it will be display image and text both
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

            // Fetching subcategory information
            $(document).on('input', '.category_id', function(){
                var category_id = $(this).val();
                // console.log(category_id);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.childCategory.subCategory.data') }}",
                    data: {
                        id: category_id
                    },
                    success: function (res) {
                        // console.log(res.data);
                        if (res.status) {
                            // Clear any previous subcategory options
                            $('.subCategory_id').empty();
                            // Add default "Select" option
                            $('.subCategory_id').append('<option value="" disabled selected>Select</option>');

                            // const baseUrl = ``;
                            // Append new subcategories
                            $.each(res.data, function (key, subCategory) {
                                const imageUrl = '{{ asset('') }}' + subCategory.subcategory_img;

                                $('.subCategory_id').append(
                                    '<option value="' + subCategory.id + '" data-image-url="' + imageUrl + '">' + 
                                    subCategory.subcategory_name + 
                                    '</option>'
                                );
                            });
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }

                })
            })

            // Show Data through Datatable
            let datatables = $('#datatables').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,

                ajax: "{{ route('admin.childCategory-data') }}",
                // pageLength: 30,

                columns: [
                    { 
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false 
                    },
                    {
                        data: 'childCategoryImg',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'category_name',
                    },
                    {
                        data: 'subcategory_name',
                    },
                    {
                        data: 'name',
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
                    url: "{{ route('admin.childCategory.status') }}",
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

            // Create Data
            $('#createForm').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.childCategory.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        console.log(res);
                        if (res.status === true) {
                            $('#createModal').modal('hide');
                            $('#createForm')[0].reset();
                            $('.validation-error').html('');
                            datatables.ajax.reload();

                            swal.fire({
                                title: "Success",
                                text: `${res.message}`,
                                icon: "success"
                            })
                        }
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;

                        $('#cat_name_validate').empty().html(error.category_id);
                        $('#subCat_name_validate').empty().html(error.subCategory_id);
                        $('#childCat_name_validate').empty().html(error.name);
                        $('#image_validate').empty().html(error.img);
                        $('#status_validate').empty().html(error.status);

                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                    }
                });
            })


            // Edit Data
            $(document).on("click", '#editButton', function (e) {
                let id = $(this).attr('data-id');
                // alert(id);

                $.ajax({
                    type: 'GET',
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    url: "{{ url('admin/childCategories') }}/" + id + "/edit",
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#up_id').val(data.id);
                        $('#up_category_id').val(data.category_id).trigger('change');
                        $('#up_subCategory_id').val(data.subCategory_id).trigger('change');
                        $('#up_childCategory_name').val(data.name);
                        $('#imageShow').html('');
                        $('#imageShow').append(`
                          <a href={{ asset("`+ data.img +`") }} target="__blank">
                            <img src={{ asset("`+ data.img +`") }} alt="" style="width: 75px;">  
                          </a>
                        `);
                        $('#up_status').val(data.status);
                    },
                    error: function (error) {
                        console.log('error');
                    }

                });
            })


            // Update Data
            $("#EditForm").submit(function (e) {
                e.preventDefault();

                let id = $('#up_id').val();
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/childCategories') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {

                        swal.fire({
                            title: "Success",
                            text: "Child-Category Updated Successfully",
                            icon: "success"
                        })

                        $('#editModal').modal('hide');
                        $('#EditForm')[0].reset();
                        $('.validation-error').html('');
                        datatables.ajax.reload();
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;

                        $('#up_childCat_name_validate').empty().html(error.name);

                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                    }
                });

            });


            // Delete Data
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

                            url: "{{ url('admin/childCategories') }}/" + id,
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


            // View Data
            $(document).on("click", '#viewButton', function (e) {
                let id = $(this).attr('data-id');
                // alert(id);

                $.ajax({
                    type: 'GET',
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    url: "{{ url('admin/childCategories/view') }}/" + id,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#view_category_name').html(data.category_name);
                        $('#view_subCategory_name').html(data.subcategory_name);
                        $('#view_childCategory_name').html(data.name);
                        $('#viewImageShow').html('');
                        $('#viewImageShow').append(`
                          <a href="{{ asset("`+ data.img +`") }}" target="__blank">
                            <img src={{ asset("`+ data.img +`") }} alt="" style="width: 75px;">    
                          </a>
                       `);
                        $('#created_date').html(res.created_date);
                        $('#updated_date').html(res.updated_date);
                        $('#view_status').html(res.statusHtml);

                    },
                    error: function (error) {
                        console.log('error');
                    }

                });
            })
    })
    </script>
@endpush

