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
                <h4 class="mb-sm-0 font-size-18">Subscribers List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Subscriber</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        @if( auth("admin")->user()->can("send.email.subscription") )
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                   {{-- <h4 class="card-title">Subscribers List</h4> --}}
                    <div class="col-lg-8 offset-lg-2">
                        <h3 class="font-size-18 mb-4">Send Email to all subscribers</h3>

                        <div class="row">
                            <form action="">
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input class="form-control" type="text" name="subject" id="subject" placeholder="write subject....">
                                </div>
            
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea name="message" id="message" class="form-control" cols="30" rows="6" placeholder="write Message...."></textarea>
                                </div>

                                <button type="button" class="btn btn-primary waves-effect waves-light">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="card-body">
            <div class="">
                <table class="table table-bordered mb-0" id="datatables">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#SL.</th>
                            <th>Email</th>
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
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            var canDeleteSubscription = @json(auth('admin')->user()->can('delete.subscription'));
            
            // Show Data through Datatable
            let datatables = $('#datatables').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,

                ajax: "{{ route('admin.subscription-data') }}",
                // pageLength: 30,

                columns: [
                    { 
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false,
                        render: function(data, type, row, meta) {
                            let index = meta.row + meta.settings._iDisplayStart + 1;
                            let newLabel = row.view 
                                ? `<input type="hidden" value="${row.sub_id}"> <span class="badge bg-success new-label ms-3">New</span>` 
                                : '';
                            return index + ' ' + newLabel;
                        }
                    },
                    {
                        data: 'email',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'is_verify',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        createdCell: function(td, cellData, rowData, row, col) {
                            // Hide empty action column
                            if (cellData.trim() === '') {
                                $(td).closest('tr').find('td:eq(' + col + ')').hide();
                            }
                        }
                    },
                ]
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

                            url: "{{ url('admin/subscription') }}/" + id,
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

            // Remove "New" text format
            $('#datatables tbody').on('click', 'tr', function () {
                let $row = $(this);
                let subId = $row.find('input[type="hidden"]').val();

                // If already viewed or no ID, do nothing
                if (!subId || !$row.find('.new-label').length) return;

                // Remove the "New" label from the DOM dd
                $row.find('.new-label').remove();

                // Send AJAX request to update view status
                $.ajax({
                    url: "{{ route('admin.subscription-view') }}",
                    method: "GET",
                    data: {
                        id: subId
                    },
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function(xhr) {
                        console.error("AJAX error:", xhr.responseText);
                    }
                });
            });
        })

    </script>


    {{-- Pusher Js Start --}}
        <script>

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
                    $('#datatables').DataTable().ajax.reload(null, false);
                    toastr.success(data.message);
                }
                else{
                    toastr.error("there is something wrong");
                }
            });
        </script>
    {{-- Pusher Js End --}}
@endpush

