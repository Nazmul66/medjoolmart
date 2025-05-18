@extends('backend.layout.master')

@push('title')
    List Attribute
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Attribute List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attribute</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Attribute Values List</h4>

                @if(auth("admin")->user()->can("create.attribute"))
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
                            <th>Attribute</th>
                            <th>Name</th>
                            <th>Color Value</th>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">Create Attribute</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="createForm" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="attribute" class="form-label">Attribute <span class="text-danger">*</span></label>
                                <select class="form-select" name="attribute" id="attribute">
                                    <option value="color">Color</option>
                                    <option value="size">Size</option>
                                    <option value="weight">Weight</option>
                                    <option value="tag">Tag</option>
                                </select>

                                <span id="attribute_validate" class="text-danger error-validate mt-1"></span>
                            </div>

                            <div class="mb-3 color_val">
                                <label for="color_value" class="form-label">Color Name</label>
                                <input type="color" class="form-control" id="color_value" name="color_value" style="height: 36px;" value="#5d61e1">

                                <span id="color_value_validate" class="text-danger error-validate mt-1"></span>
                            </div>

                            <div class="mb-3">
                                <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="value" name="value" >

                                <span id="value_validate" class="text-danger error-validate mt-1"></span>
                            </div>


                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3"
                                    data-bs-dismiss="modal">Close </button>

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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">Update Attribute</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="EditForm" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <input type="text" name="id" id="id" hidden>

                            <div class="mb-3">
                                <label for="up_attribute" class="form-label">Attribute <span class="text-danger">*</span></label>
                                <select class="form-select" name="attribute" id="up_attribute">
                                    <option value="color">Color</option>
                                    <option value="size">Size</option>
                                    <option value="weight">Weight</option>
                                    <option value="tag">Tag</option>
                                </select>

                                <span id="up_attribute_validate" class="text-danger error-validate mt-1"></span>
                            </div>

                            <div class="mb-3 color_val d-none">
                                <label for="up_color_value" class="form-label">Color Name</label>
                                <input type="color" class="form-control" id="up_color_value" name="color_value" style="height: 36px;">

                                <span id="up_color_value_validate" class="text-danger error-validate mt-1"></span>
                            </div>

                            <div class="mb-3">
                                <label for="up_value" class="form-label">Value <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="up_value" name="value" >

                                <span id="up_value_validate" class="text-danger error-validate mt-1"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3" data-bs-dismiss="modal">Close</button>

                                <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light"> Update </button>
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
                        <h5 class="modal-title" id="myModalLabel">View Attribute List</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <div class="view_modal_content">
                            <label>Attribute : </label>
                            <span class="text-dark" >
                                <button class="btn btn-dark" id="view_attribute"></button>
                            </span>
                        </div>

                        <div class="view_modal_content">
                            <label>Color Value : </label>
                            <span class="text-dark" id="view_color_value"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Value : </label>
                            <span class="text-dark">
                                 <button class="btn btn-secondary" id="view_value"></button>
                            </span>
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
        // yajra datatables
        $(document).ready(function () {

            function toggleColorVal() {
                const selectedValue = $('#attribute').val();
                const colorInput = $('#color_value');
                
                if (selectedValue === 'color') {
                    $('.color_val').removeClass('d-none'); 
                    colorInput.prop('disabled', false);  
                } else {
                    $('.color_val').addClass('d-none');  
                    colorInput.prop('disabled', true);   
                    colorInput.val('');                  
                }
            }

            // Call the function initially to handle default selection
            toggleColorVal();
            $('#attribute').on('change', toggleColorVal);


            function toggleUpColorVal() {
                const selectedValue = $('#up_attribute').val();
                const colorInput = $('#up_color_value');
                
                if (selectedValue === 'color') {
                    $('.color_val').removeClass('d-none');
                    colorInput.prop('disabled', false);   
                } else {
                    $('.color_val').addClass('d-none');  
                    colorInput.prop('disabled', true);    
                    colorInput.val('');                  
                }
            }

            // Call the function initially to handle default selection
            toggleUpColorVal();
            $('#up_attribute').on('change', toggleUpColorVal);


            // Show Data through Datatable
            let datatables = $('#datatables').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.attribute-value.data') }}",
                columns: [
                    { 
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false 
                    },
                    {
                        data: 'attribute',
                    },
                    {
                        data: 'value',
                    },
                    {
                        data: 'color_value',
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
                    url: "{{ route('admin.attribute-value.status') }}",
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
                    url: "{{ route('admin.attribute.value.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        console.log(res);
                        if (res.status === true) {
                            $('#createModal').modal('hide');
                            $('#createForm')[0].reset();
                            $('.error-validate').html('');
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

                        $('#attribute_validate').empty().html(error.attribute);
                        $('#color_value_validate').empty().html(error.color_value);
                        $('#value_validate').empty().html(error.value);

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
                    url: "{{ url('admin/attribute-value') }}/" + id + "/edit",
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;
                        console.log(data);

                        $('#id').val(data.id);
                        $('#up_attribute').val(data.attribute);
                        $('#up_color_value').val(data.color_value);
                        $('#up_value').val(data.value);
                    },
                    error: function (error) {
                        console.log('error');
                    }
                });
            })


            // Update
            $("#EditForm").submit(function (e) {
                e.preventDefault();

                let id = $('#id').val();
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/attribute-value') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        swal.fire({
                            title: "Success",
                            text: "Attribute Value Edited",
                            icon: "success"
                        })

                        $('#editModal').modal('hide');
                        $('#EditForm')[0].reset();
                        $('.error-validate').html('');
                        datatables.ajax.reload();
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;
                        console.log(error);

                        $('#up_attribute_validate').empty().html(error.attribute);
                        $('#up_color_value_validate').empty().html(error.color_value);
                        $('#up_value_validate').empty().html(error.value);

                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                    }
                });

            });


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

                            url: "{{ url('admin/attribute-value') }}/" + id,
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
                    url: "{{ url('admin/attribute-value/view') }}/" + id,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#view_attribute').html(data.attribute);
                        $('#view_color_value').html(res.colorValue); 
                        $('#view_value').html(data.value);
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

