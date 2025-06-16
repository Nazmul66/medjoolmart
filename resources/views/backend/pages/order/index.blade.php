@extends('backend.layout.master')

@push('title')
    All Orders List
@endpush

@push('add-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Orders</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


        <!-- Content part Start -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Orders List</h4>
                </div>
            </div>
            
            <div class="row px-3 pt-3">
                <div class="col-lg-3">
                    <label for="">Order Status</label>
                    <select class="form-select submitable order_status" name="order_status">
                            <option value="" @if($status === "all") selected @endif>All</option>
                        @foreach (config('order_status_data.order_status') as $key => $statusOption)
                            <option value="{{ $key }}" @if($key === $status) selected @endif>{{ ucfirst($statusOption['status']) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3">
                    <label for="">Payment Status</label>
                    <select class="form-select submitable payment_status" name="payment_status">
                        <option value="" selected>All</option>
                        <option value="0">Pending</option>
                        <option value="1">Paid</option>
                        <option value="2">Due</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <label for="">Date Range Filter</label>
                    <input type="date" class="form-select submitable date_range" name="date_range" >
                </div>
            </div>

            <div class="row px-3 pt-5">
                <div class="col-lg-4">
                    <div class="d-flex gap-3">
                        <select class="form-select" name="bulk_action">
                            <option value="" selected>Bulk Actions</option>
                            <option value="">Send Steadfast</option>
                        </select>
    
                        <button class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </div>
    
            <div class="card-body">
                <div class="">
                    <table class="table table-bordered mb-0 datatables" id="datatables">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th style="background: white;">
                                    <input class="form-check-input" type="checkbox" id="formCheck1">
                                </th>
                                <th>Order Id</th>
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Product Quantity</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Date</th>
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
    <script src="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function () {

            // Flatpicker Plugin
            $(".date_range").flatpickr({
                dateFormat: "Y-m-d",
                mode: "range",
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        // Only trigger when both start and end dates are selected
                        var start_date = selectedDates[0].toISOString().split('T')[0]; // Format to YYYY-MM-DD
                        var end_date = selectedDates[1].toISOString().split('T')[0];   // Format to YYYY-MM-DD
                        
                        console.log("Start Date: " + start_date);
                        console.log("End Date: " + end_date);
                    }
                }
            });

            // Show Data through Datatable
            let datatables = $('.datatables').DataTable({
                "order": [
                    [0, 'desc']
                ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url" : "{{ route('admin.order-data') }}",
                    "data": function(e){
                        e.order_status   = $('.order_status').val();
                        e.payment_status = $('.payment_status').val();
                        e.date_range     = $('.date_range').val();
                    }
                },
                // pageLength: 30,

                columns: [
                    { 
                        data: 'checkbox', 
                        orderable: false, 
                        searchable: false 
                    },
                    {
                        data: 'order_id',
                    },
                    {
                        data: 'cus_name',
                    },
                    {
                        data: 'cus_phone',
                    },
                    {
                        data: 'product_qty',
                    },
                    {
                        data: 'total_amount',
                    },
                    {
                        data: 'payment_method',
                    },
                    {
                        data: 'payment_status',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'order_status',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'order_date',
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

            // Payment status updates
            $(document).on('change', '#payment_status', function () {
                var id     = $(this).data('id');
                var status = $(this).val();

                // console.log(id, status);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.change.payment.status') }}",
                    data: {
                        // '_token': token,
                        id: id,
                        status: status
                    },
                    success: function (res) {
                        datatables.ajax.reload();

                        // Display a success message
                        if (res.status == 0) {
                            Swal.fire({
                                title: 'Payment status ( Pending ) updated successfully!',
                                icon: 'success'
                            });
                        } else if (res.status == 1) {
                            Swal.fire({
                                title: 'Payment status ( Paid ) updated successfully!',
                                icon: 'success'
                            });
                        } else {
                            Swal.fire({
                                title: 'Payment status ( Due ) updated successfully!',
                                icon: 'success'
                            });
                        }
                    },
                    error: function (err) {
                        console.error(err);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update payment status.',
                            icon: 'error'
                        });
                    }
                })
            })

            // Order status updates
            $(document).on('change', '#order_status', function () {
                var id     = $(this).data('id');
                var status = $(this).val();

                // console.log(id, status);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.change.order.status') }}",
                    data: {
                        // '_token': token,
                        id: id,
                        status: status
                    },
                    success: function (res) {
                        datatables.ajax.reload();

                        // Display a success message
                        if (res.status === "pending") {
                            Swal.fire({
                                title: 'Order status ( Pending ) updated successfully!',
                                icon: 'success'
                            });
                        } 
                        else if (res.status === "processed_and_ready_to_ship") {
                            Swal.fire({
                                title: 'Order status ( processed_and_ready_to_ship ) updated successfully!',
                                icon: 'success'
                            });
                        }
                        else if (res.status === "dropped_off") {
                                Swal.fire({
                                    title: 'Order status ( dropped_off ) updated successfully!',
                                    icon: 'success'
                                });
                            }
                        else if (res.status === "shipped") {
                            Swal.fire({
                                title: 'Order status ( shipped ) updated successfully!',
                                icon: 'success'
                            });
                        }
                        else if (res.status === "out_for_delivery") {
                            Swal.fire({
                                title: 'Order status ( out_for_delivery ) updated successfully!',
                                icon: 'success'
                            });
                        } 
                        else {
                            Swal.fire({
                                title: 'Order status ( delivered ) updated successfully!',
                                icon: 'success'
                            });
                        }
                    },
                    error: function (err) {
                        console.error(err);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update payment status.',
                            icon: 'error'
                        });
                    }
                })
            })

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
                            url: "{{ url('admin/order/destroy') }}/" + id,
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

            // Filterable data
            $('.submitable').on('change', function(e){
                $('.datatables').DataTable().ajax.reload();
            })
            
        })
    </script>

    {{-- Pusher Js Start --}}
    {{-- <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('29983ad499efd408200f', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data.message));
            console.log(JSON.stringify(data));
            if( data ){
                $('.datatables').DataTable().ajax.reload(null, false);
                toastr.success(data.message);
            }
            else{
                toastr.error("there is something wrong");
            }
        });
    </script> --}}
    {{-- Pusher Js End --}}
@endpush