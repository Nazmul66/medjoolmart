@extends('backend.layout.master')

@push('title')
   Essential Setting
@endpush

@push('add-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@php
    $time_schedule    = json_decode($time_schedule->value, true);
    $website_rules    = json_decode($website_rules->value, true);
    // dd($website_rules);
@endphp

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Essential Setting</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Essential Setting</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- Tab Part --}}
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active mb-2" id="v-time-schedule-tab" data-bs-toggle="pill" href="#v-time-schedule" role="tab" aria-controls="v-time-schedule" aria-selected="false">Time Schedule</a>

                    <a class="nav-link mb-2" id="v-website-rules-tab" data-bs-toggle="pill" href="#v-website-rules" role="tab" aria-controls="v-website-rules" aria-selected="false">Website Rules</a>
                    </div>
                </div><!-- end col -->

                {{-- Body Part --}}
                <div class="col-md-9">
                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-time-schedule" role="tabpanel" aria-labelledby="v-time-schedule-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.time.schedule') }}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="mb-4">
                                                    <label for="day_name" class="form-label">Day</label>
                                                    <input class="form-control" type="text" value="{{ $time_schedule[0]['day'] }}" id="day_name" placeholder="Day" name="day[]">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="start_time" class="form-label">Start Time</label>
                                                   <input class="form-control" type="time" value="{{ $time_schedule[0]['start_time'] }}" id="start_time" name="start_time[]">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="end_time" class="form-label">End Time</label>
                                                   <input class="form-control" type="time" value="{{ $time_schedule[0]['end_time'] }}" id="end_time" name="end_time[]">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="mb-4">
                                                    <label for="day_name" class="form-label">Day</label>
                                                    <input class="form-control" type="text" value="{{ $time_schedule[1]['day'] }}" id="day_name" placeholder="Day" name="day[]">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="start_time" class="form-label">Start Time</label>
                                                   <input class="form-control" type="time" value="{{ $time_schedule[1]['start_time'] }}" id="start_time" name="start_time[]">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="end_time" class="form-label">End Time</label>
                                                   <input class="form-control" type="time" value="{{ $time_schedule[1]['end_time'] }}" id="end_time" name="end_time[]">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="mt-4 btn btn-primary waves-effect waves-light">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="v-website-rules" role="tabpanel" aria-labelledby="v-website-rules-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.website-rules') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <h4 class="mb-2">Content 1</h4>
                                        <div class="row mb-4">
                                            <div class="col-lg-4">
                                                <div class="mb-4">
                                                    <label for="image" class="form-label">Image <sup class="text-danger" style="font-size: 12px;">* Resolution(60 x 60)</sup></label>

                                                    <input type="file" class="form-control" name="image[]" id="image"  accept=".png, .jpeg, .jpg, .webp" onchange="previewImage(event)">

                                                    <div class="image_preview mt-3">
                                                        @if( !empty($website_rules[0]['image']) )
                                                            <img src="{{ asset($website_rules[0]['image']) }}" width="80" height="80">
                                                        @else
                                                            <img src="{{ asset('public/backend/assets/images/no_Image_available.jpg') }}" width="80" height="80">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                   <input class="form-control" type="text" value="{{ $website_rules[0]['title'] ?? '' }}" id="title" placeholder="e.g: title" name="title[]">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Content</label>
                                                   <input class="form-control" type="text" placeholder="e.g: content" value="{{ $website_rules[0]['content'] ?? '' }}" id="content" name="content[]">
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="mb-2">Content 2</h4>
                                        <div class="row mb-4">
                                            <div class="col-lg-4">
                                                <div class="mb-4">
                                                    <label for="image" class="form-label">Image <sup class="text-danger" style="font-size: 12px;">* Resolution(60 x 60)</sup></label>

                                                    <input type="file" class="form-control" name="image[]" id="image"  accept=".png, .jpeg, .jpg, .webp" onchange="previewImage(event)">

                                                    <div class="image_preview mt-3">
                                                        @if( !empty($website_rules[1]['image']) )
                                                            <img src="{{ asset($website_rules[1]['image']) }}" width="80" height="80">
                                                        @else
                                                            <img src="{{ asset('public/backend/assets/images/no_Image_available.jpg') }}" width="80" height="80">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                   <input class="form-control" type="text" value="{{ $website_rules[1]['title'] ?? '' }}" id="title" placeholder="e.g: title" name="title[]">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Content</label>
                                                   <input class="form-control" type="text" placeholder="e.g: content" value="{{ $website_rules[1]['content'] ?? '' }}" id="content" name="content[]">
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="mb-2">Content 3</h4>
                                        <div class="row mb-4">
                                            <div class="col-lg-4">
                                                <div class="mb-4">
                                                    <label for="image" class="form-label">Image <sup class="text-danger" style="font-size: 12px;">* Resolution(60 x 60)</sup></label>

                                                    <input type="file" class="form-control" name="image[]" id="image"  accept=".png, .jpeg, .jpg, .webp" onchange="previewImage(event)">

                                                    <div class="image_preview mt-3">
                                                        @if( !empty($website_rules[2]['image']) )
                                                            <img src="{{ asset($website_rules[2]['image']) }}" width="80" height="80">
                                                        @else
                                                            <img src="{{ asset('public/backend/assets/images/no_Image_available.jpg') }}" width="80" height="80">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                   <input class="form-control" type="text" value="{{ $website_rules[2]['title'] ?? '' }}" id="title" placeholder="e.g: title" name="title[]">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Content</label>
                                                   <input class="form-control" type="text" placeholder="e.g: content" value="{{ $website_rules[2]['content'] ?? '' }}" id="content" name="content[]">
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="mb-2">Content 4</h4>
                                        <div class="row mb-4">
                                            <div class="col-lg-4">
                                                <div class="mb-4">
                                                    <label for="image" class="form-label">Image <sup class="text-danger" style="font-size: 12px;">* Resolution(60 x 60)</sup></label>

                                                    <input type="file" class="form-control" name="image[]" id="image"  accept=".png, .jpeg, .jpg, .webp" onchange="previewImage(event)">

                                                    <div class="image_preview mt-3">
                                                        @if( !empty($website_rules[3]['image']) )
                                                            <img src="{{ asset($website_rules[3]['image']) }}" width="80" height="80">
                                                        @else
                                                            <img src="{{ asset('public/backend/assets/images/no_Image_available.jpg') }}" width="80" height="80">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                   <input class="form-control" type="text" value="{{ $website_rules[3]['title'] ?? '' }}" id="title" placeholder="e.g: title" name="title[]">
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="content" class="form-label">Content</label>
                                                   <input class="form-control" type="text" placeholder="e.g: content" value="{{ $website_rules[3]['content'] ?? '' }}" id="content" name="content[]">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="mt-4 btn btn-primary waves-effect waves-light">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--  end col -->
            </div><!-- end row -->
        </div>
    </div>

@endsection

@push('add-script')
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function previewImage(event) {
            const input = event.target;
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    // Find the closest preview div related to this input
                    const previewDiv = input.closest('.mb-4').querySelector('.image_preview');
                    previewDiv.innerHTML = `<img src="${e.target.result}" width="80" height="80">`;
                };
                reader.readAsDataURL(file);
            }
        }

         //____ Category_id Select2 ____//
         $('.main-category').select2({
            templateResult: formatState, 
            templateSelection: formatState,    
        });

        //____ subCategory_id Select2 ____//
        $('.sub-category').select2({
            templateResult: formatState, 
            templateSelection: formatState,    
        });

        //____ ChildCategory_id Select2 ____//
        $('.child-category').select2({
            templateResult: formatState, 
            templateSelection: formatState,    
        });

        //____ Ajax subCategory ____//
        $('body').on('change', '.main-category', function(e){
            e.preventDefault();
            let id = $(this).val();
            let row = $(this).closest('.row');

            $.ajax({
                method: 'GET',
                url: "{{ route('admin.get.subCategory.data') }}",
                data: {id: id},
                success: function(res){
                    console.log(res.data);
                    let selector = row.find('.sub-category'); // Only update the sub-category in the same row
                    selector.html('<option value="" selected>Select</option>');

                    $.each(res.data, function(i, item){
                        selector.append(`<option value="${item.id}" data-image-url="${item.image_url}">${item.subcategory_name}</option>`);
                    })

                    // Reinitialize Select2 with custom template function
                    selector.select2({
                        templateResult: formatState, // Format options to show image
                        templateSelection: formatState, // Show image in selected option
                        width: '100%'
                    });
                },
                error: function(err){

                },
            })
        })

        //____ Ajax childCategory ____//
        $('body').on('change', '.sub-category', function(e){
            e.preventDefault();
            let id = $(this).val();
            let row = $(this).closest('.row');

            $.ajax({
                method: 'GET',
                url: "{{ route('admin.get.childCategory.data') }}",
                data: {id: id},
                success: function(res){
                    console.log(res.data);
                    let selector = row.find('.child-category'); // Only update the child-category in the same row
                    selector.html('<option value="" selected>Select</option>');

                    $.each(res.data, function(i, item){
                        selector.append(`<option value="${item.id}" data-image-url="${item.image_url}">${item.name}</option>`);
                    })

                    // Reinitialize Select2 with custom template function
                    selector.select2({
                        templateResult: formatState, // Format options to show image
                        templateSelection: formatState, // Show image in selected option
                    });
                },
                error: function(err){

                },
            })
        })


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
    </script>
@endpush