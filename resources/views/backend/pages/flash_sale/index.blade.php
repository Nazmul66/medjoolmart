@extends('backend.layout.master')

@push('title')
    Create Category
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
                <h3 class="mb-sm-0 font-size-18">Flash-Sale List</h3>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Flash-Sale</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Flash Sale date setup -->
    <div class="card">
        <h6 class="card-header bg-primary border-bottom text-white">Flash Sale End Date</h6>
        <div class="card-body">
            <div class="col-lg-6">
                <form id="flash_sale" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Sale End Date <span class="text-danger"> *</span></label>
                        <input class="form-control" id="end_date" type="date" value="{{ $flashSale->end_date ?? '' }}" name="end_date" placeholder="YYYY/MM/DD">
        
                        <span id="end_date_validate" class="text-danger mt-1"></span>
                    </div>
        
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Flash Sale Products -->
    @if ( !empty($flashSale->end_date) )
        <div class="card">
            <h6 class="card-header bg-primary border-bottom text-white">Add Flash Sale Products</h6>
            <div class="card-body">
                <div class="col-lg-6">
                    <form id="createForm" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="product_id">Add Products <span class="text-danger"> *</span></label>
                            <select class="form-select" id="product_id" name="product_id">
                                <option value="" disabled selected>Select</option>

                                @foreach ($products as $row)
                                    <option value="{{ $row->id }}" data-image-url="{{ asset($row->thumb_image) }}">{{ $row->name }}</option>
                                @endforeach
                            </select>

                            <span id="product_id_validate" class="text-danger validation-error mt-1"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    @endif


    <!-- Content part Start -->
    @if ( !empty($flashSale->end_date) )
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0" id="dataTables">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>#SL.</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>End Date</th>
                                <th>Show at home</th>
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
    @endif

@endsection

@push('add-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>

    <script>

        // Flatpicker Plugin
        $("#end_date").flatpickr({
            minDate: "today",
            enableTime: true,
            dateFormat: "Y-m-d",
        });

        //____ product_id Select2 ____//
        $('#product_id').select2({
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


        //____ Yajra Datables ____//
        $(document).ready(function () {

            // Show Data through Datatable
            let datatables = $('#dataTables').DataTable({
                order: [
                    [0, 'desc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.flashSale.item-data') }}",
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
                        data: 'product_name',
                    },
                    {
                        data: 'end_date'
                    },
                    {
                        data: 'show_at_home',
                        orderable: false,
                        searchable: false,
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


            // Flash Sale End date
            $('#flash_sale').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.flashSale.index') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        // console.log(res);
                        if (res.status === true) {
                            $('#flash_sale')[0].reset();

                            // Add delay to ensure proper reload
                            datatables.ajax.reload();

                            swal.fire({
                                title: "Success",
                                text: `${res.message}`,
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload(); 
                                }
                            });
                        }
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;

                        $('#end_date_validate').empty().html(error.end_date);

                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                    }
                });
            })


            // status updates
            $(document).on('click', '#status', function () {
                var id = $(this).data('id');
                var status = $(this).data('status');

                // console.log(id, status);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.flashSale.item.status') }}",
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

            // show_at_home updates
            $(document).on('click', '#show_at_home', function () {
                var id = $(this).data('id');
                var status = $(this).data('status');
                // console.log(id, status);

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.flashSale.item.show') }}",
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
                                    title: 'Show At Home Changed to Active',
                                    icon: 'success'
                                })
                        } else {
                            swal.fire(
                                {
                                    title: 'Show At Home Changed to Inactive',
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
            $('#createForm').submit(function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.flashSale.item.store') }}",
                    data: formData,
                    processData: false,  // Prevent jQuery from processing the data
                    contentType: false,  // Prevent jQuery from setting contentType
                    success: function (res) {
                        console.log(res);
                        if (res.status === true) {
                            $('#createForm')[0].reset();
                            $('.validation-error').html('');
                            datatables.ajax.reload();

                            // Disable already selected options
                            @foreach ($products as $item)
                                var selectedId = "{{ $item->id }}";
                                var option = $('#product_id').find('option[value="' + selectedId + '"]');
                                option.prop('disabled', true);
                            @endforeach

                             //____ product_id Select2 ____//
                            $('#product_id').select2({
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

                            swal.fire({
                                title: "Success",
                                text: `${res.message}`,
                                icon: "success"
                            })
                        }
                    },
                    error: function (err) {
                        let error = err.responseJSON.errors;

                        $('#product_id_validate').empty().html(error.product_id);

                        swal.fire({
                            title: "Failed",
                            text: "Something Went Wrong !",
                            icon: "error"
                        })
                    }
                });
            })


            // // Edit Category
            // $(document).on("click", '#editButton', function (e) {
            //     let categoryId = $(this).attr('data-id');
            //     // alert(categoryId);

            //     $.ajax({
            //         type: 'GET',
            //         // headers: {
            //         //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         // },
            //         url: "{{ url('admin/categories') }}/" + categoryId + "/edit",
            //         processData: false,  // Prevent jQuery from processing the data
            //         contentType: false,  // Prevent jQuery from setting contentType
            //         success: function (res) {
            //             let data = res.success;

            //             $('#id').val(data.id);
            //             $('#up_category_name').val(data.category_name);
            //             $('#imageShow').html('');
            //             $('#imageShow').append(`
            //               <a href="{{ asset("`+ data.category_img +`") }}" target="__blank">
            //                 <img src={{ asset("`+ data.category_img +`") }} alt="" style="width: 75px;">    
            //               </a>
            //         `);
            //             $('#up_status').val(data.status);
            //         },
            //         error: function (error) {
            //             console.log('error');
            //         }

            //     });
            // })


            // // Update Category
            // $("#EditForm").submit(function (e) {
            //     e.preventDefault();

            //     let id = $('#id').val();
            //     let formData = new FormData(this);

            //     $.ajax({
            //         type: "POST",
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         url: "{{ url('admin/categories') }}/" + id,
            //         data: formData,
            //         processData: false,  // Prevent jQuery from processing the data
            //         contentType: false,  // Prevent jQuery from setting contentType
            //         success: function (res) {

            //             swal.fire({
            //                 title: "Success",
            //                 text: "Category Edited",
            //                 icon: "success"
            //             })

            //             $('#editModal').modal('hide');
            //             $('#EditForm')[0].reset();
            //             datatables.ajax.reload();
            //         },
            //         error: function (err) {
            //             let error = err.responseJSON.errors;

            //             $('#up_name_validate').empty().html(error.category_name);

            //             swal.fire({
            //                 title: "Failed",
            //                 text: "Something Went Wrong !",
            //                 icon: "error"
            //             })
            //         }
            //     });

            // });


            // Delete Category
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

                            url: "{{ url('admin/flash-sale-item') }}/" + id,
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


    </script>
@endpush

