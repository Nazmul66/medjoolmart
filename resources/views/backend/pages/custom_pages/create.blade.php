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
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Custom Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Custom Pages List</h4>
                <a href="{{ route('admin.customPage.index') }}" class="btn btn-primary">
                    Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form action="{{ route('admin.customPage.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="page_name" class="form-label">Page Name <span class="text-danger">*</span></label>
                            <input class="form-control" id="page_name" type="text" name="title" placeholder="Page Name" value="{{ old('title') }}">
    
                            <span id="page_validate" class="text-danger validation-error mt-1"></span>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="statuss">
                                <option value="1" {{ old('status', $status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
    
                            <span id="status_validate" class="text-danger validation-error mt-1"></span>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="content" class="form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="content" id="description" placeholder="Write here...." rows="8">{{ old('content') }}</textarea>
    
                            <span id="content_validate" class="text-danger validation-error mt-1"></span>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="meta_img" class="form-label">Meta Image <sup class="text-danger" style="font-size: 12px;">* resolution(160px x 160px)</sup></label>
                                <input type="file" class="form-control" name="meta_image" id="meta_img" accept=".png, .jpeg, .jpg, .webp" onchange="showImagePreview(event)">
        
                                <span id="meta_image_validate" class="text-danger validation-error mt-1"></span>
        
                                <div id="image_preview" class="mt-3">
                                    <img src="{{ asset('public/backend/assets/images/no_Image_available.jpg') }}" width="100" height="100">
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="meta_title" id="meta_title" placeholder="Meta Title...."
                                    class="form-control" value="{{ old('meta_title') }}">
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords <span
                                    class="text-danger">*</span></label>
                            <input name="meta_keyword" id="meta_keywords" type="text"
                                class="form-control meta_keyword" value="{{ old('meta_keywords') }}"
                                placeholder="Meta Keywords....">
                        </div>
                    </div>
    
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description...."
                                rows="6">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
    
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light w-md">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('add-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>

    <script>
        // Image on change
        function showImagePreview(event) {
            const input = event.target;
            const previewDiv = document.getElementById('image_preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewDiv.innerHTML = `<img src="${e.target.result}" width="100" height="100" alt="Preview Image">`;
                };

                reader.readAsDataURL(input.files[0]); // Read the selected file
            }
        }

        $(document).ready(function() {
            // Choice.js plugin
            const product_tags = new Choices('.meta_keyword', {
                removeItems: true,
                duplicateItemsAllowed: false,
                removeItemButton: true,
                delimiter: ',',
            });

            // Ckeditor 5 plugin
            let jReq;
            ClassicEditor
                .create(document.querySelector('#description'))
                .then(newEditor => {
                    jReq = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush