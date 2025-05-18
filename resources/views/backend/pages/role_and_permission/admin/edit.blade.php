@extends('backend.layout.master')

@push('title')
    Update Admin User
@endpush

@push('add-css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css"> --}}
@endpush

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Update Admin</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Update Admin</h4>
                <a href="{{ route('admin.admin-role.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.admin-role.update', $admin->id) }}"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-8 ">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" value="{{ old('name', $admin->name) }}" name="name" id="name" placeholder="Write Your Name.....">

                            @error('name')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="email" value="{{ $admin->email }}" name="email" id="email" readonly placeholder="Write Your Email.....">

                            @error('email')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone..." value="{{ old('phone', $admin->phone) }}" pattern="[0-9]{11,15}" oninput="validatePhone(this)"> 

                            @error('phone')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="****************">

                            @error('password')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="role">Roles</label>
                            <select class="form-select" id="role" name="roles[]" multiple>
                                @foreach ($roles as $role)
                                   <option 
                                        value="{{ $role }}"
                                        {{ in_array($role, $userRoles) ? "selected" : "" }}
                                        >{{ $role }}</option>
                                @endforeach
                            </select>

                            @error('roles')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection


@push('add-script')
    <script>
        function validatePhone(input) {
            const phone = input.value; // Get the input value

            // Check if the phone number length is within the valid range
            if (phone.length >= 11 && phone.length <= 19) {
                input.classList.remove('is-invalid'); // Remove error styling
                input.classList.add('is-valid'); // Add success styling (optional)
            } else {
                input.classList.add('is-invalid'); // Add error styling
                input.classList.remove('is-valid'); // Remove success styling (optional)
            }
        }
    </script>
@endpush

