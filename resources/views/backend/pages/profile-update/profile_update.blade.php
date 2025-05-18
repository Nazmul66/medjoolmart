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

@section('body-content')

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">
                   <a href="{{ route('admin.profiles') }}">
                        <i class='bx bx-arrow-back' ></i>
                   </a>
                    <span>Profile Update</span>
                </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboards') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile Update</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Body Content -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Profile Update</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.change-profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label mb-4 d-block "><strong>Profile Image Upload</strong></label>

                            @if ( !empty($admin->image) )
                                <div class="image_bg" style="background-image: url('{{ asset($admin->image) }}') ;">
                                    <label for="images"> <i class='bx bxs-edit-alt'></i> </label>
                                </div>
                            @else
                                <div class="image_bg" style="background-image: url('{{ asset('public/backend/assets/images/bg-1.jpg') }}') ;">
                                    <label for="images"> <i class='bx bxs-edit-alt'></i> </label>
                                </div>
                            @endif

                            <input type="file" name="image" id="images" hidden>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name', $admin->name) }}" id="name" placeholder="Write Your Name.....">

                            @error('name')
                                <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email </label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" readonly >

                            @error('email')
                                <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input class="form-control" type="number" name="phone" id="phone" placeholder="Phone..." pattern="[0-9]{11,15}" value="{{ old('phone', $admin->phone) }}" oninput="validatePhone(this)"> 

                             @error('phone')
                                <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary waves-effect waves-light mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.change-password') }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <div class="input-group input-group-flat">
                                <input class="form-control current_password" type="password" name="current_password" id="current_password" placeholder="*******************">
                                <span class="input-group-text px-3">
                                    <a href="javascript:void(0)" class="bg-transparent border-0 p-0 link-secondary  fa fa-fw fa-eye field-icon toggle-current-password" toggle="#password-field">
                                    </a>
                                </span>
                            </div>

                            <div id="current_pass_error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>

                            <div class="input-group input-group-flat">
                                <input class="form-control new_password" type="password" name="new_password" id="new_password" placeholder="*******************">
                                <span class="input-group-text px-3">
                                    <a href="javascript:void(0)" class="bg-transparent border-0 p-0 link-secondary  fa fa-fw fa-eye field-icon toggle-password" toggle="#password-field">
                                    </a>
                                </span>
                            </div>

                            @error('new_password')
                                <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password <span class="text-danger">*</span></label>

                            <div class="input-group input-group-flat">
                                <input class="form-control confirm_password" type="password" name="confirm_password" id="confirm_password" placeholder="*******************">
                                <span class="input-group-text px-3">
                                    <a href="javascript:void(0)" class="bg-transparent border-0 p-0 link-secondary  fa fa-fw fa-eye field-icon confirm-toggle-password" toggle="#password-field">
                                    </a>
                                </span>
                            </div>

                            @error('confirm_password')
                                <span id="phone-error" class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary waves-effect waves-light mt-3">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.change-profile') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-6 offset-lg-3">

                        <div class="mb-3">
                            <label class="form-label mb-4 d-block "><strong>Profile Image Upload</strong></label>

                            @if ( !empty($admin->image) )
                                <div class="image_bg" style="background-image: url('{{ asset($admin->image) }}') ;">
                                    <label for="images"> <i class='bx bxs-edit-alt'></i> </label>
                                </div>
                            @else
                                <div class="image_bg" style="background-image: url('{{ asset('public/backend/assets/images/bg-1.jpg') }}') ;">
                                    <label for="images"> <i class='bx bxs-edit-alt'></i> </label>
                                </div>
                            @endif

                            <input type="file" name="image" id="images" hidden>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ $admin->name }}" id="name" placeholder="Write Your Name.....">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email </label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ $admin->email }}" disabled >
                        </div>

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="current_password" id="current_password" placeholder="Write Your Password.....">

                            <div id="current_pass_error"></div>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="new_password" id="new_password" placeholder="Write Your New Password.....">
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Write Your Confirm New Password.....">
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>

            </form>
        </div>
    </div> --}}

@endsection


@push('add-script')

    <script>
       $(document).ready(function(){
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

            $('#images').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.image_bg').css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(this.files[0]);
            });

            // password show hide
            $(".toggle-current-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $('.current_password');
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $('.new_password');
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $(".confirm-toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $('.confirm_password');
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $('#current_password').on('input', function(e){
                var currentPassword = $(this).val();
                // console.log($(this).val());

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.current-password') }}",
                    data: { current_password: currentPassword },
                    success: function (res) {
                        console.log(res);
                        if (res.match === true) {
                          $('#current_pass_error').html(`
                               <span class="text-success"><strong>Current Password is Correct</strong><i class='bx bx-check'></i></span> 
                          `);
                        }
                        else{
                            $('#current_pass_error').html(`
                               <span class="text-danger"><strong>Current Password is Incorrect</strong><i class='bx bx-x'></i></span> 
                          `); 
                        }
                    },
                    error: function (err) {
                        console.log(err)
                    }
                });
            });
        });
    </script>

@endpush