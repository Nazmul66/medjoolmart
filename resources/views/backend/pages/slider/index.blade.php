@extends('backend.layout.master')

@push('title')
    Create Category
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Sliders List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Sliders List</h4>

                @if(auth("admin")->user()->can("create.slider"))
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
                            <th>SL</th>
                            <th>Slider Image</th>
                            {{-- <th>Slider Type</th> --}}
                            <th>Slider Title</th>
                            <th>Price</th>
                            {{-- <th>Url</th>
                            <th>Serial</th> --}}
                            <th>Status</th>
                            <th>Actions</th>
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
                        <h5 class="modal-title" id="myModalLabel">Create Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="createForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="slider_image" class="form-label">Slider Image <sup class="text-danger" style="font-size: 12px;">* resolution(1920 x 1080)</sup></label>
                                    <input type="file" class="form-control" name="slider_image" id="slider_image" accept=".png, .jpeg, .jpg, .webp" onchange="previewImage(event)">

                                    <span id="image_validate" class="text-danger validation-error mt-1"></span>

                                    <div id="image_preview" class="mt-3">
                                        <img src="{{ asset('public/backend/assets/images/no_Image_available.jpg') }}" width="100" height="100">
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <label for="title" class="form-label">Slider Title</label>
                                    <input class="form-control" id="title" type="text" name="title" placeholder="Write here">

                                    <span id="title_validate" placeholder="Write Here" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="type" class="form-label">Slider Type</label>
                                    <input class="form-control" placeholder="Write Here" id="type" type="text" name="type" >
                                </div>

                                <div class="col mb-3">
                                    <label for="starting_price" class="form-label">Price</label>
                                    <input class="form-control" id="starting_price" type="number" name="starting_price" placeholder="Price">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="btn_url" class="form-label">Button Url</label>
                                    <input class="form-control" id="btn_url" type="url" name="btn_url" placeholder="Link here">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
    
                                    <span id="status_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light"> Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>


        <!-- Edit Modal -->
        <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-scroll="true"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">Update Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="EditForm" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <input type="text" name="id" id="up_id" hidden>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="slider_image" class="form-label">Slider Image <sup class="text-danger" style="font-size: 12px;">* resolution(1920 x 1080)</sup></label>
                                    <input type="file" class="form-control" name="slider_image" id="slider_image" accept=".png, .jpeg, .jpg, .webp" onchange="imageShow(event)">

                                    <div id="imageShow" class="mt-3"></div>
                                </div>

                                <div class="col mb-3">
                                    <label for="up_title" class="form-label">Slider Title</label>
                                    <input class="form-control" id="up_title" type="text" name="title" placeholder="Write here">

                                    <span id="up_title_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="up_type" class="form-label">Slider Type</label>
                                    <input class="form-control" id="up_type" type="text" name="type" placeholder="Write here">
                                </div>

                                <div class="col mb-3">
                                    <label for="up_starting_price" class="form-label">Price</label>
                                    <input class="form-control" id="up_starting_price" type="number" name="starting_price" placeholder="Price">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="up_btn_url" class="form-label">Button Url</label>
                                    <input class="form-control" id="up_btn_url" type="url" name="btn_url" placeholder="Link here">
                                </div>

                                <div class="col mb-3">
                                    <label for="up_serial" class="form-label">Serial</label>
                                    <input class="form-control" id="up_serial" type="text" name="serial" readonly>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3"
                                    data-bs-dismiss="modal">Close</button>

                                <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light">Update</button>
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
                        <h5 class="modal-title" id="myModalLabel">View Slider List</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <div class="view_modal_content">
                            <label>Image : </label>
                            <div id="viewImageShow"></div>
                        </div>

                        <div class="view_modal_content">
                            <label>Title : </label>
                            <span class="text-dark" id="view_slider_title"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Type : </label>
                            <span class="text-dark" id="view_slider_type"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Price : </label>
                            <span class="text-dark" id="view_slider_price"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Url : </label>
                            <span class="text-dark" id="view_slider_url"></span>
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

            // Show Data through Datatable
            let datatables = $('#datatables').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,

                ajax: "{{ route('admin.slider-data') }}",
                // pageLength: 30,

                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'slider_image',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'title',
                    },
                    {
                        data: 'starting_price',
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

            //  status updates
            $(document).on('click', '#status', function () {
                var id = $(this).data('id');
                var status = $(this).data('status');

                // console.log(id, status);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.slider.status') }}",
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
                    url: "{{ route('admin.slider.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        // console.log(res);
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

                        $('#title_validate').empty().html(error.title);
                        $('#image_validate').empty().html(error.slider_image);

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
                    url: "{{ url('admin/slider') }}/" + id + "/edit",
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#up_id').val(data.id);
                        $('#up_title').val(data.title);
                        $('#up_type').val(data.type);
                        $('#up_starting_price').val(data.starting_price);
                        $('#up_btn_url').val(data.btn_url);
                        $('#up_serial').val(data.serial);
                        $('#imageShow').html('');
                        $('#imageShow').append(`
                            <a href={{ asset("`+ data.slider_image +`") }} target="__blank">
                                <img src={{ asset("`+ data.slider_image +`") }} alt="" style="width: 75px;">
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
                    url: "{{ url('admin/slider') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {

                        swal.fire({
                            title: "Success",
                            text: "Slider Edited",
                            icon: "success"
                        })

                        $('#editModal').modal('hide');
                        $('#EditForm')[0].reset();
                        $('.validation-error').html('');
                        datatables.ajax.reload();
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;

                        $('#up_title_validate').empty().html(error.title);

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

                            url: "{{ url('admin/slider') }}/" + id,
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
                    url: "{{ url('admin/slider/view') }}/" + id,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#view_slider_title').html(data.title);
                        $('#view_slider_type').html(data.type);
                        $('#view_slider_price').html(data.starting_price);
                        $('#view_slider_url').html(data.btn_url);
                        $('#viewImageShow').html('');
                        $('#viewImageShow').append(`
                          <a href="{{ asset("`+ data.slider_image +`") }}" target="__blank">
                            <img src={{ asset("`+ data.slider_image +`") }} alt="" style="width: 75px;">    
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

