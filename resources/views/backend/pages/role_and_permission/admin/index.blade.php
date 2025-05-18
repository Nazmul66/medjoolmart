@extends('backend.layout.master')

@section('admin-role', 'active')

@push('title')
    Create Admin Role
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">All Admins</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Admin List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">All Admins</h4>

                @if(auth("admin")->user()->can("create.admin-role"))
                    <a href="{{ route('admin.admin-role.create') }}" class="btn btn-primary">
                        Add Admin
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" id="adminRoleTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#SL.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="width: 600px;">Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><span class="badge bg-info" style="font-size: 14px; padding: 10px 10px;">SuperAdmin</span></td>
                            <td>
                                <a href="javascript:void();" class="badge bg-danger" style="font-size: 14px; padding: 10px 10px;">N/A</a>
                            </td>
                            <td>
                                <a href="javascript:void();" class="badge bg-danger" style="font-size: 14px; padding: 10px 10px;">N/A</a>
                            </td>
                            <td style="width: 600px;">
                                <span class="badge bg-success" style="font-size: 14px; padding: 10px 10px;">SuperAdmin</span>
                            </td>
                            <td>
                                
                            </td>
                        </tr>

                        @foreach ($admins as $row => $admin )
                            <tr>
                                <td>{{ $row + 1 }}</td>
                                <td><span class="badge bg-info" style="font-size: 14px; padding: 10px 10px;">{{ $admin->name }}</span></td>
                                <td>
                                    <a href="mailto: {{ $admin->email }}" class="badge bg-info" style="font-size: 14px; padding: 10px 10px;">{{ $admin->email }}</a>
                                </td>
                                <td>
                                    @if ( !empty( $admin->phone ) )
                                        <a href="tel: {{ $admin->phone }}" class="badge bg-info" style="font-size: 14px; padding: 10px 10px;">{{ $admin->phone }}</a>
                                    @else
                                        <a href="javascript:void();" class="badge bg-danger" style="font-size: 14px; padding: 10px 10px;">N/A</a>
                                    @endif

                                </td>
                                <td style="width: 600px;">
                                    @foreach ($admin->getRoleNames() as $role)
                                         <span class="badge bg-success" style="font-size: 14px; padding: 10px 10px;">{{ $role }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        @if(auth("admin")->user()->can("update.admin-role"))
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.admin-role.edit', $admin->id) }}">
                                            <i class='bx bx-lock'></i></a>
                                        @endif

                                        @if(auth("admin")->user()->can("delete.admin-role"))
                                            <form action="{{ route('admin.admin-role.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
            let table = new DataTable('#adminRoleTable');
        })

    </script>
@endpush

