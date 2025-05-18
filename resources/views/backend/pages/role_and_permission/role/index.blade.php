@extends('backend.layout.master')

@push('title')
    Create Role
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Role List</h4>

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
                <h4 class="card-title">Role List</h4>

                @if(auth("admin")->user()->can("create.role"))
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary">
                        Create Role
                    </a>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0" id="roleTable">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#SL.</th>
                            <th>Role Name</th>
                            <th>Guard Name</th>
                            <th style="width: 600px;">Permission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($roles as $row => $role)
                            <tr>
                                <td>{{ $row + 1 }}</td>
                                <td><span class="badge bg-info" style="font-size: 14px;
                                    padding: 10px 10px;">{{ $role->name }}</span></td>
                                <td>
                                    <span class="badge bg-info" style="font-size: 14px;
                                    padding: 10px 10px;">{{ $role->guard_name }}</span>
                                </td>
                                <td style="width: 600px;">
                                    @foreach ($role->permissions as $item)
                                         <span class="badge bg-success mb-2" style="font-size: 14px; padding: 10px 10px;">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        @if(auth("admin")->user()->can("update.role"))
                                            <a class="btn btn-sm btn-info" href="{{ route('admin.role.edit', $role->id) }}"><i class='bx bx-lock'></i></i></a>
                                        @endif

                                        @if(auth("admin")->user()->can("delete.role"))
                                            <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')

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
            let table = new DataTable('#roleTable');
        })

    </script>
@endpush

