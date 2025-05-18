@extends('backend.layout.master')

@push('title')
    All Transactions List
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Transactions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transaction</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Transactions List</h4>
            </div>
        </div>

        <div class="card-body">
            <div class="">
                <table class="table table-bordered mb-0 datatables" id="datatables">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#SL.</th>
                            <th>Invoice Id</th>
                            <th>Transaction Id</th>
                            <th>Customer Name</th>
                            <th>Currency Name</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
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


    <!-- View Modal -->
    <div id="viewModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-scroll="true"
    style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="myModalLabel">View Transaction List</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>

                <div class="modal-body">
                    <div class="view_modal_content">
                        <label>Invoice Id : </label>
                        <span class="text-dark" id="view_invoice_id"></span>
                    </div>

                    <div class="view_modal_content">
                        <label>Transaction Id : </label>
                        <span class="text-dark" id="view_transaction_id"></span>
                    </div>

                    <div class="view_modal_content">
                        <label>Customer Name : </label>
                        <span class="text-dark" id="view_customer_name"></span>
                    </div>

                    <div class="view_modal_content">
                        <label>Currency Name : </label>
                        <span class="text-dark" id="view_currency_name"></span>
                    </div>
                    
                    <div class="view_modal_content">
                        <label>Total Amount : </label>
                        <span class="text-info" id="view_Total_amount"></span>
                    </div>

                    <div class="view_modal_content">
                        <label>Payment Method : </label>
                        <span class="text-dark" id="view_payment_method"></span>
                    </div>

                    <div class="view_modal_content">
                        <label>Created Date : </label>
                        <div id="created_date"></div>
                    </div>

                    <div class="view_modal_content">
                        <label>Updated Date : </label>
                        <div id="updated_date"></div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection

@push('add-script')
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function () {

            // Show Data through Datatable
            let datatables = $('.datatables').DataTable({
                "order": [
                    [0, 'desc']
                ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url" : "{{ route('admin.transaction-data') }}"
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
                        data: 'invoice_id',
                    },
                    {
                        data: 'transaction_id',
                    },
                    {
                        data: 'cus_name',
                    },
                    {
                        data: 'currency_name',
                    },
                    {
                        data: 'total_amount',
                    },
                    {
                        data: 'payment_method',
                    },
                    {
                        data: 'date',
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


            // View Data
            $(document).on("click", '#viewButton', function (e) {
                let id = $(this).attr('data-id');
                // alert(id);

                $.ajax({
                    type: 'GET',
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    url: "{{ url('admin/transaction/view') }}/" + id,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        let data = res.success;

                        $('#view_invoice_id').html(data.invoice_id);
                        $('#view_transaction_id').html(data.transaction_id);
                        $('#view_customer_name').html(data.cus_name);
                        $('#view_currency_name').html(data.currency_name);
                        $('#view_Total_amount').html(data.amount);
                        $('#view_payment_method').html(data.payment_method);
                        $('#created_date').html(res.created_date);
                        $('#updated_date').html(res.updated_date);
                    },
                    error: function (error) {
                        console.log('error');
                    }

                });
            })
        })
    </script>
@endpush