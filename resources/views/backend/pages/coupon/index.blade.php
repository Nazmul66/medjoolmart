@extends('backend.layout.master')


@push('title')
    List Coupon
@endpush


@push('add-css')

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.css') }}">

@endpush


@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Coupon List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Coupon</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">

        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Coupons List</h4>

                @if(auth("admin")->user()->can("create.coupon"))
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_Modal">
                        Add New
                    </button>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <table class="table table-bordered mb-0" id="dataTables">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>#SL.</th>
                        <th>Info</th>
                        <th>Discount Type</th>
                        <th>Discount</th>
                        <th>End Date</th>
                        <th>Start Date</th>
                        <th>Used</th>
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
        <div id="create_Modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-scroll="true"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">Create Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="createForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="name">Coupon Name <span class="text-danger">*</span></label>
                                    <input class="form-control"  value="{{ old('name') }}" id="name" type="text" name="name" placeholder="Coupon Name">
    
                                    <span id="name_validate" class="text-danger validation-error mt-1"></span>
                                </div>
    
                                <div class="col mb-3">
                                    <label class="form-label" for="code">Coupon Code <span class="text-danger">*</span></label>
                                    <input class="form-control"  value="{{ old('code') }}" id="code" type="text" name="code" placeholder="Coupon Code">
    
                                    <span id="code_validate" class="text-danger validation-error mt-1"></span>
                                </div>
    
                                <div class="col mb-3">
                                    <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span></label>
                                    <input class="form-control"  value="{{ old('quantity') }}" id="quantity" min="0" type="number" name="quantity" placeholder="quantity">
    
                                    <span id="quantity_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="max_used">Max Used <span class="text-danger">*</span></label>
                                    <input class="form-control" id="max_used" value="{{ old('max_used') }}" min="0" type="number" name="max_used" placeholder="Max Coupon Used">
    
                                    <span id="max_used_validate" class="text-danger validation-error mt-1"></span>
                                </div>

                                <div class="col mb-3">
                                    <label for="discount_type" for="discount_type" class="form-label">Discount Type <span class="text-danger">*</span></label>
                                    <select class="form-select" name="discount_type" id="discount_type">
                                        <option value="percent" selected>Percentage (%)</option>
                                        <option value="amount">Amount {{  getSetting()->currency_symbol }}</option>
                                    </select>
                                </div>

                                <div class=" col mb-3">
                                    <label for="discount" class="form-label">Discount <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" value="{{ old('discount') }}" name="discount" id="discount" placeholder="Discount">

                                    <span id="discount_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="start_date">Offer Start Date <span class="text-danger">*</span></label>
                                    <input class="form-control start_date"  value="{{ old('start_date') }}" type="date" id="start_date" name="start_date" placeholder="Select a date....">

                                    <span id="start_date_validate" class="text-danger validation-error mt-1"></span>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label" for="end_date">Offer End Date <span class="text-danger">*</span></label>
                                    <input class="form-control end_date" value="{{ old('end_date') }}" type="date" id="end_date" name="end_date"  placeholder="Select a date....">

                                    <span id="end_date_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3"
                                  data-bs-dismiss="modal">Close </button>

                                <button type="submit" id="btn-store" class="btn btn-primary waves-effect waves-light"> Save changes </button>
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
                <div class="modal-content ">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">Update Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="EditCoupon" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <input type="text" name="id" id="id" hidden>

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="up_name">Coupon Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="up_name" type="text" name="name" placeholder="Coupon Name">
    
                                    <span id="up_name_validate" class="text-danger validation-error mt-1"></span>
                                </div>
    
                                <div class="col mb-3">
                                    <label class="form-label" for="up_code">Coupon Code <span class="text-danger">*</span></label>
                                    <input class="form-control" id="up_code" type="text" name="code" placeholder="Coupon Code">
    
                                    <span id="up_code_validate" class="text-danger validation-error mt-1"></span>
                                </div>
    
                                <div class="col mb-3">
                                    <label class="form-label" for="up_quantity">Quantity <span class="text-danger">*</span></label>
                                    <input class="form-control" id="up_quantity" min="0" type="number" name="quantity" placeholder="Quantity">
    
                                    <span id="up_quantity_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="up_max_used">Max Used <span class="text-danger">*</span></label>
                                    <input class="form-control" id="up_max_used" min="0" type="number" name="max_used" placeholder="Max Coupon Used">
    
                                    <span id="up_max_used_validate" class="text-danger validation-error mt-1"></span>
                                </div>

                                <div class="col mb-3">
                                    <label for="up_discount_type" class="form-label">Discount Type <span class="text-danger">*</span></label>
                                    <select class="form-select" name="discount_type" id="up_discount_type">
                                        <option value="percent" selected>Percentage (%)</option>
                                        <option value="amount">Amount {{  getSetting()->currency_symbol }}</option>
                                    </select>
                                </div>

                                <div class=" col mb-3">
                                    <label for="up_discount" class="form-label">Discount <span class="text-danger">*</span></label>
                                    <input min="0" type="number" class="form-control" name="discount" id="up_discount" placeholder="Discount">

                                    <span id="up_discount_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label" for="up_start_date">Offer Start Date <span class="text-danger">*</span></label>
                                    <input class="form-control up_start_date" type="date" id="up_start_date" name="start_date" placeholder="Select a date....">

                                    <span id="up_start_date_validate" class="text-danger validation-error mt-1"></span>
                                </div>

                                <div class="col mb-3">
                                    <label class="form-label" for="up_end_date">Offer End Date <span class="text-danger">*</span></label>
                                    <input class="form-control up_end_date" type="date" id="up_end_date" name="end_date"  placeholder="Select a date....">

                                    <span id="up_end_date_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" id="up_status" name="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3"
                                        data-bs-dismiss="modal">Close</button>

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
                        <h5 class="modal-title" id="myModalLabel">View Coupon List</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <div class="view_modal_content">
                            <label>Coupon Name : </label>
                            <span class="text-dark" id="view_coupon_name"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Coupon Code : </label>
                            <span class="text-dark" id="view_coupon_code"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Quantity : </label>
                            <span class="text-dark" id="view_coupon_quantity"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Max Used : </label>
                            <span class="text-dark" id="view_coupon_max_used"></span>
                        </div>
                        
                        <div class="view_modal_content">
                            <label>Discount Type : </label>
                            <span class="text-info" id="view_coupon_discount_type"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Discount : </label>
                            <span class="text-dark" id="view_coupon_discount"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Start Coupon Date : </label>
                            <span class="text-dark" id="view_coupon_start_date"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Expire Coupon Date : </label>
                            <span class="text-dark" id="view_coupon_end_date"></span>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
    <script src="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        // Flatpicker Plugin
        $(".start_date").flatpickr({
            minDate: "today"
        });

        $(".end_date").flatpickr({
            minDate: "today",
        });

        $(".up_start_date").flatpickr({
            minDate: "today"
        });

        $(".up_end_date").flatpickr({
            minDate: "today",
        });


        $(document).ready(function () {
            // Show Data through Datatable
            let dataTabless = $('#dataTables').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,

                ajax: "{{ route('admin.coupon-data') }}",
                // pageLength: 30,

                columns: [
                    { 
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false 
                    },
                    {
                        data: 'info',
                    },
                    {
                        data: 'discount_type',
                    },
                    {
                        data: 'discount',
                    },
                    {
                        data: 'start_date',
                    },
                    {
                        data: 'end_date',
                    },
                    {
                        data: 'used',
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
                    url: "{{ route('admin.coupon.status') }}",
                    data: {
                        // '_token': token,
                        id: id,
                        status: status
                    },
                    success: function (res) {
                        dataTabless.ajax.reload();

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
                    url: "{{ route('admin.coupons.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        console.log(res);
                        if (res.status === true) {
                            $('#create_Modal').modal('hide');
                            $('#createForm')[0].reset();
                            dataTabless.ajax.reload();

                            swal.fire({
                                title: "Success",
                                text: `${res.message}`,
                                icon: "success"
                            })

                            $('.validation-error').html('');
                        }
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;

                        $('#name_validate').empty().html(error.name);
                        $('#code_validate').empty().html(error.code);
                        $('#quantity_validate').empty().html(error.quantity);
                        $('#max_used_validate').empty().html(error.max_used);
                        $('#discount_validate').empty().html(error.discount);
                        $('#start_date_validate').empty().html(error.start_date);
                        $('#end_date_validate').empty().html(error.end_date);

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
                    url: "{{ url('admin/coupons/') }}/" + id + "/edit",
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;
                        // console.log(res)
                        
                        $('#id').val(data.id);
                        $('#up_name').val(data.name);
                        $('#up_code').val(data.code);
                        $('#up_quantity').val(data.quantity);
                        $('#up_max_used').val(data.max_used);
                        $('#up_discount_type').val(data.discount_type);
                        $('#up_discount').val(data.discount);
                        $('#up_start_date').val(data.start_date);
                        $('#up_end_date').val(data.end_date);
                        $('#up_status').val(data.status);
                    },
                    error: function (error) {
                        console.log('error');
                    }
                });
            })


            // Update Data
            $("#EditCoupon").submit(function (e) {
                e.preventDefault();

                let id = $('#id').val();
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('admin/coupons') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {

                        swal.fire({
                            title: "Success",
                            text: "Coupon Updated Successfully",
                            icon: "success"
                        })

                        $('#editModal').modal('hide');
                        $('#EditCoupon')[0].reset();
                        $('.validation-error').html('');
                        dataTabless.ajax.reload();
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;

                        $('#up_name_validate').empty().html(error.name);
                        $('#up_code_validate').empty().html(error.code);
                        $('#up_quantity_validate').empty().html(error.quantity);
                        $('#up_max_used_validate').empty().html(error.max_used);
                        $('#up_discount_validate').empty().html(error.discount);
                        $('#up_start_date_validate').empty().html(error.start_date);
                        $('#up_end_date_validate').empty().html(error.end_date);

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

                            url: "{{ url('admin/coupons/') }}/" + id,
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

                                dataTabless.ajax.reload();
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
                    url: "{{ url('admin/coupons/view') }}/" + id,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#view_coupon_name').html(data.name);
                        $('#view_coupon_code').html(data.code);
                        $('#view_coupon_quantity').html(data.quantity);
                        $('#view_coupon_max_used').html(data.max_used);
                        $('#view_coupon_discount_type').html(data.discount_type);
                        if( data.discount_type === "amount" ){
                            $('#view_coupon_discount').html(data.discount + 'TK');
                        }
                        else{
                            $('#view_coupon_discount').html(data.discount + '%');
                        }
                        $('#view_coupon_start_date').html(res.start_date);
                        $('#view_coupon_end_date').html(res.end_date);
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

