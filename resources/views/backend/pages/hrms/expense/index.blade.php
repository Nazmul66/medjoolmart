@extends('backend.layout.master')

@push('title')
    All Expense
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.css') }}">
@endpush


@php
    $invoice_id = App\Models\Expense::max('invoice_id'); 

    // Check if there is an invoice_id and get the numeric part after "inv-"
    if ($invoice_id) {
        $numeric_part = (int) substr($invoice_id, 4); // Remove "inv-" and convert to integer
        $inv = 'inv-' . ($numeric_part + 1); // Increment and format
    } else {
        $inv = 'inv-1001'; // Default value if no invoice exists
    }
@endphp

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Expenses List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Expense</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Expenses List</h4>

                @if(auth("admin")->user()->can("create.category"))
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
                            <th>Invoice Number</th>
                            <th>Item Name</th>
                            <th>Purchase By</th>
                            <th>Purhcase Date</th>
                            <th>Amount</th>
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
                        <h5 class="modal-title" id="myModalLabel">Create Expense</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="createForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="invoice_id" class="form-label">Invoice Number <span class="text-danger">*</span></label>
                                    <input class="form-control" id="invoice_id" type="text" name="invoice_id" readonly value="{{ $inv }}">
    
                                    <span id="invoice_id_validate" class="text-danger validation-error mt-1"></span>
                                </div>
    
                                <div class="col-lg-6 mb-3">
                                    <label for="item_name" class="form-label">Item Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="item_name" type="text" name="item_name">
    
                                    <span id="item_name_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="row">    
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Purchase By <span class="text-danger">*</span></label>
                                    <select class="form-select" name="user_id" id="purchase_by">
                                        @foreach ($admins as $row)
                                            <option value="{{ $row->id }}" 
                                                data-image-url="
                                                @if ( !empty($row->image) )
                                                    {{ asset($row->image) }}
                                                @else
                                                    {{ asset('public/backend/assets/images/no_Image_available.jpg') }}
                                                @endif
                                                ">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
    
                                    <span id="user_id_validate" class="text-danger mt-1"></span>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="purchase_date" class="form-label">Purchase Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="purchase_date" type="date" name="purchase_date">
    
                                    <span id="purchase_date_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="amount" class="form-label">Purchase Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="amount" type="number" name="amount">
    
                                    <span id="amount_validate" class="text-danger validation-error mt-1"></span>
                                </div>
    
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                        <option value="returned">Returned</option>
                                    </select>
    
                                    <span id="status_validate" class="text-danger mt-1"></span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3"
                                    data-bs-dismiss="modal">Close
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
        <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-scroll="true" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="myModalLabel">Update Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <form id="EditForm" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <input type="text" name="id" id="up_id" hidden>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="up_invoice_id" class="form-label">Invoice Number <span class="text-danger">*</span></label>
                                    <input class="form-control" id="up_invoice_id" type="text" name="invoice_id" disabled >
    
                                    <span id="up_invoice_id_validate" class="text-danger validation-error mt-1"></span>
                                </div>
    
                                <div class="col-lg-6 mb-3">
                                    <label for="up_item_name" class="form-label">Item Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="up_item_name" type="text" name="item_name">
    
                                    <span id="up_item_name_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="row">    
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label" for="up_purchase_by">Purchase By <span class="text-danger">*</span></label>
                                    <select class="form-select" name="user_id" id="up_purchase_by">
                                        @foreach ($admins as $row)
                                            <option value="{{ $row->id }}" 
                                                data-image-url="
                                                @if ( !empty($row->image) )
                                                    {{ asset($row->image) }}
                                                @else
                                                    {{ asset('public/backend/assets/images/no_Image_available.jpg') }}
                                                @endif
                                                ">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
    
                                    <span id="up_user_id_validate" class="text-danger mt-1"></span>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="up_purchase_date" class="form-label">Purchase Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="up_purchase_date" type="date" name="purchase_date">
    
                                    <span id="up_purchase_date_validate" class="text-danger validation-error mt-1"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="up_amount" class="form-label">Purchase Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" id="up_amount" type="number" name="amount">
    
                                    <span id="up_amount_validate" class="text-danger validation-error mt-1"></span>
                                </div>
    
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label" for="up_status">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status" id="up_status">
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                        <option value="returned">Returned</option>
                                    </select>
    
                                    <span id="up_status_validate" class="text-danger mt-1"></span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-danger waves-effect me-3"
                                        data-bs-dismiss="modal">Close
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
                        <h5 class="modal-title" id="myModalLabel">View Category List</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <div class="view_modal_content">
                            <label>Invoice Number: </label>
                            <span class="text-dark" id="view_invoice_number"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Item Name: </label>
                            <span class="text-dark" id="view_item_name"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Purchase By: </label>
                            <span id="view_purchase_by"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Purchase Amount: </label>
                            <span id="view_purchase_amount"></span>
                        </div>

                        <div class="view_modal_content">
                            <label>Purchase Date : </label>
                            <div id="view_purchase_date"></div>
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
    <script src="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            // Flatpicker Plugin
            $("#purchase_date").flatpickr({
                minDate: "today"
            });

            $("#up_purchase_date").flatpickr({
                minDate: "today"
            });

            //____ Category_id Select2 ____//
            $('#purchase_by').select2({
                dropdownParent: $('#createModal'),
                templateResult: formatState, // Only Text content when select, it will be shown 
                templateSelection: formatState,    // When select any option, it will be display image and text both
            });

            $('#up_purchase_by').select2({
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
                    '<span><img src="' + imageUrl + '" style="width: 30px; height: 30px; border-radius: 50px; margin-right: 8px;" /> ' + state.text + '</span>'
                );
                return $state;
            };

            // Show Data through Datatable
            let datatables = $('#datatables').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.hrms.expense-data') }}",
                // pageLength: 30,
                columns: [
                    { 
                        data: 'invoice_id', 
                    },
                    {
                        data: 'item_name',
                    },
                    {
                        data: 'purchase_by',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'purchase_date',
                    },
                    {
                        data: 'amount',
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
                    url: "{{ route('admin.category.status') }}",
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
                    url: "{{ route('admin.hrms.expense.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        console.log(res);
                        if (res.status === true) {
                            $('#createModal').modal('hide');
                            $('#createForm')[0].reset();
                            $('.validation-error').html('');
                            $('#invoice_id').val(res.invoice_id);
                            datatables.ajax.reload();

                            swal.fire({
                                title: "Success",
                                text: `${res.message}`,
                                icon: "success"
                            })
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        let error = err.responseJSON.errors;

                        $('#invoice_id_validate').empty().html(error.invoice_id);
                        $('#item_name_validate').empty().html(error.item_name);
                        $('#user_id_validate').empty().html(error.user_id);
                        $('#purchase_date_validate').empty().html(error.purchase_date);
                        $('#amount_validate').empty().html(error.amount);
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
                    url: "{{ url('admin/hrms/expense/') }}/" + id + "/edit",
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#up_id').val(data.id);
                        $('#up_invoice_id').val(data.invoice_id);
                        $('#up_purchase_by').val(data.user_id).trigger('change');
                        $('#up_item_name').val(data.item_name);
                        $('#up_amount').val(data.amount);
                        $('#up_purchase_date').val(data.purchase_date);
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
                    url: "{{ url('admin/hrms/expense') }}/" + id,
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {

                        swal.fire({
                            title: "Success",
                            text: "Expense Updated Successfully",
                            icon: "success"
                        })

                        $('#editModal').modal('hide');
                        $('#EditForm')[0].reset();
                        $('.validation-error').html('');
                        datatables.ajax.reload();
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;

                        $('#up_invoice_id_validate').empty().html(error.invoice_id);
                        $('#up_item_name_validate').empty().html(error.item_name);
                        $('#up_user_id_validate').empty().html(error.user_id);
                        $('#up_purchase_date_validate').empty().html(error.purchase_date);
                        $('#up_amount_validate').empty().html(error.amount);
                        $('#up_status_validate').empty().html(error.status);

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
                            url: "{{ url('admin/hrms/expense') }}/" + id,
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
                        swal.fire('Your Image is Safe');
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
                    url: "{{ url('admin/hrms/expense/view') }}/" + id,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#view_invoice_number').html(data.invoice_id);
                        $('#view_item_name').html(data.item_name);
                        $('#view_purchase_by').html(res.purchase_by);
                        $('#view_purchase_amount').html(res.purchase_amount);
                        $('#view_purchase_date').html(res.purchase_date);
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

