@extends('backend.layout.master')

@push('title')
    List Product
@endpush

@push('add-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/backend/assets/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.min.css">
@endpush

@php
    $admin = Auth::guard('admin')->user();
    $adminRole = App\Models\Admin::where('email', $admin->email)->first();
@endphp

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Profile Update</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile Update</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 card card-info card-outline card_shadow">
                    <div class="card-body box-profile position-relative">
                        <a href="{{ route('admin.profile-update') }}" class="position-absolute" style="right: 0; top: 5px; font-size: 28px;" title="Edit">
                            <i class="bx bx-edit-alt"></i>
                        </a>
                        <div class="text-center">
                            @if ( !empty($admin->image) )
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset($admin->image) }}" alt="Super Admin">
                            @else
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/backend/assets/images/user.jpg') }}" alt="Super Admin">
                            @endif
                        </div>

                        <ul class="list-group list-group-unbordered mb-3 mt-3">
                            <li class="list-group-item border-top-0">
                                <b>Name</b> <a class="float-right">{{ $admin->name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a href="mailto: {{ $admin->email }}" class="float-right">{{ $admin->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a href="mailto: {{ $admin->phone }}" class="float-right">{{ $admin->phone }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Role</b> <a href="javascript:void();" class="float-right">{{ $adminRole->getRoleNames()[0] }}</a>
                            </li>
                             <li class="list-group-item">
                                <b>Created At</b> <a class="float-right">{{ date("F d, Y", strtotime($admin->created_at)) }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('add-script')


@endpush