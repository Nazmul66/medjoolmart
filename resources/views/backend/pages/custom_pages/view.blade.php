@extends('backend.layout.master')

@push('title')
    Create Category
@endpush

@push('add-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
@endpush

@section('custom_page', 'mm-active')

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Custom Pages List</h4>

                <div class="page-title-right">
                    <a class="btn btn-primary" href="{{ route('admin.customPage.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table">
                    <tbody><tr>
                        <td style="width:10%;"><strong>Page Name :</strong></td>
                        <td>{{ $singleView->title }}</td>
                    </tr>
                    <tr>
                        <td><strong>Page Slug :</strong></td>
                        <td>{{ $singleView->slug }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status :</strong></td>
                        <td>
                            @if ( $singleView->status == 1 )
                                <span class="text-success">Active</span>
                            @else
                                <span class="text-danger">Deactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong class="mb-3 d-block" style="font-size: 20px;">Description :</strong>
                            <br>

                            <div class="">
                                {!! $singleView->content !!}
                            </div>
                        </td>
                    </tr>
                </tbody></table>

            </div>
        </div>
    </div>

@endsection

@push('add-script')

@endpush