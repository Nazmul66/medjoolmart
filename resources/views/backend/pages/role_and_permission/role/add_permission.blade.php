@extends('backend.layout.master')

@push('title')
    Create 
@endpush

@push('add-css')

@endpush

@section('body-content')

    <!-- Content part Start -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Role: <span class="badge bg-success">{{ $role->name }}</span></h4>
                <a href="{{ route('admin.role.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.give-permission', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    @foreach ($permission as $row)
                        <div class="col-lg-2">
                            <label for="">
                                    <input 
                                        type="checkbox" 
                                        name="permission[]"
                                        value="{{ $row->name }}"
                                        
                                        {{ in_array($row->id , $role_has_permissions) ? "checked" : "" }} 
                                    />
                                    {{ $row->name }}
                            </label>
                        </div>   
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary waves-effect waves-light mt-5">Update</button>
            </form>
        </div>
    </div>

@endsection

@push('add-script')

@endpush

