@extends('backend.layout.master')

@push('title')
    Create Role
@endpush

@push('add-css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css"> --}}
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Roles</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0">Admin Create Role</h5>
                <span class="float-right">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-primary"> Back </a>
                </span>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.role.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Role Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>

                <div class="mb-3 alignment_margin">
                    <div class="row">
                        <div class="col-3">
                            <div class="custom-control custom-checkbox">
                                <input class="form-check-input" type="checkbox" id="permission_all">
                                <label for="permission_all" class="custom-control-label text-capitalize">All Permission</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mb-3 alignment_margin">
                    @php $i = 1; @endphp
                    @foreach ($permission_groups as $row)
                        <div class="row">
                            <!-- Parent Checkbox -->
                            <div class="col-3">
                                <div class="custom-control custom-checkbox">
                                    <input 
                                        id="management-{{ $i }}" 
                                        class="form-check-input group-checkbox" 
                                        type="checkbox" 
                                        data-group-id="{{ $i }}">
                                    <label 
                                        for="management-{{ $i }}" 
                                        class="custom-control-label text-capitalize">
                                        {{ $row->name }}
                                    </label>
                                </div>
                            </div>
                
                            <!-- Child Checkboxes -->
                            <div class="col-9 group-{{ $i }}">
                                @php
                                    $permissionss = App\Models\Admin::getPermissionsByGroupName($row->name);
                                @endphp
                
                                @foreach ($permissionss as $item)
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input 
                                            name="permissions[]" 
                                            class="form-check-input child-checkbox group-{{ $i }}-checkbox" 
                                            type="checkbox" 
                                            id="permission_checkbox_{{ $item->id }}" 
                                            value="{{ $item->name }}" 
                                            data-group-id="{{ $i }}">
                                        <label 
                                            for="permission_checkbox_{{ $item->id }}" 
                                            class="custom-control-label">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                    <hr>  
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection


@push('add-script')
    <script>
        $(document).ready(function() {
            // All input checkbox inputs are checked
            $('#permission_all').click(function() {
                console.log($(this).is(':checked'));
                if ($(this).is(':checked')) {
                    $('input[type=checkbox]').prop('checked', true);
                } else {
                    $('input[type=checkbox]').prop('checked', false);
                }
            })

            // Handle parent checkbox controlling child checkboxes
            $('.group-checkbox').on('change', function () {
                const groupId = $(this).data('group-id'); // Get the group ID from the parent checkbox
                const $childCheckboxes = $(`.group-${groupId}-checkbox`);
                
                // Check/uncheck all child checkboxes based on the parent checkbox status
                $childCheckboxes.prop('checked', $(this).prop('checked'));
            });


            // Handle child checkboxes affecting the parent checkbox
            $('.child-checkbox').on('change', function () {
                const groupId = $(this).data('group-id'); // Get the group ID from the child checkbox
                const $childCheckboxes = $(`.group-${groupId}-checkbox`);
                const $groupCheckbox = $(`#management-${groupId}`);

                // If all child checkboxes are checked, check the parent checkbox; otherwise, uncheck it
                const allChecked = $childCheckboxes.length === $childCheckboxes.filter(':checked').length;
                $groupCheckbox.prop('checked', allChecked);
            });

        });
    </script>
@endpush


