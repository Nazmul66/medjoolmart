@extends('backend.layout.master')

@push('meta-title')
        Dashboard | General Settings
@endpush

@push('add-css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
@endpush

@section('body-content')

 <div class="row">

    @if ( !empty( $setting ) )
      <form method="POST" action="{{ route('admin.settings.update', $setting->id ) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    @else
      <form method="POST" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
        @csrf
    @endif

        <div class="card">
            {{-- Global setting --}}
            <div class="mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>General Settings</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="Logo" class="form-label">Website Logo <span class="text-danger"> *</span></label>
                            <input class="form-control" type="file" name="logo" id="Logo">

                            @if ( !empty( $setting ) )
                                <img src="{{ asset($setting->logo) }}" alt="" style="width: 50px;">
                            @endif
                        </div>

                        <div class="col mb-3">
                            <label for="favicon" class="form-label">Favicon</label>
                            <input class="form-control" type="file" name="favicon" id="favicon">

                            @if ( !empty( $setting ) )
                                <img src="{{ asset($setting->favicon) }}" alt="" style="width: 50px;">
                            @endif
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="site_name">Site Name </label>
                            <input type="text" class="form-control"
                                id="site_name"
                                name="site_name"
                                placeholder="Write Here...."
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->site_name }}"
                                @else
                                   value="{{ old('site_name') }}"
                                @endif
                                >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label" for="	whatsapp">Whatsapp Number</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                placeholder="Whatsapp Number..."
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->whatsapp }}"
                                @else
                                    value="{{ old('whatsapp')}}"
                                @endif
                                
                            >
                        </div>

                        <div class="col mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Write Phone"
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->phone }}"
                                @else
                                    value="{{ old('phone')}}"
                                @endif
                                
                            >
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="phone_optional">Support Number</label>
                            <input type="text" class="form-control" id="phone_optional" name="phone_optional"
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->phone_optional }}"
                                @else
                                    value="{{ old('phone_optional')}}"                                    
                                @endif
                                placeholder="Write Phone ( Optional )"
                                >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email Address <span class="text-danger"> *</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->email }}"
                                @else
                                    value="{{ old('email')}}"  
                                @endif
                                placeholder="Write Email Address"
                                >
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="email_optional">Email Address ( Optional )</label>
                            <input type="email" class="form-control" id="email_optional" name="email_optional"
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->email_optional }}"
                                @else
                                    value="{{ old('email_optional')}}"  
                                @endif
                                placeholder="Write Email Address ( Optional )">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label" for="address">Address <span class="text-danger"> *</span></label>
                                <textarea id="address" class="form-control" name="address" placeholder="Write Address" > @if( !empty( $setting ) ) {{ $setting->address }} @else {{ old('address') }}  @endif
                                </textarea>
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="address_optional">Address ( Optional )</label>
                                <textarea id="address_optional" class="form-control" name="address_optional" placeholder="Write Address"> @if( !empty( $setting ) ) {{ $setting->address_optional }}  @else {{ old('address_optional')}} @endif
                                </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label" for="inside_city">Inside City</label>
                            <input type="number" class="form-control" id="inside_city" name="inside_city" placeholder="Delivery Cost..."
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->inside_city }}"
                                @else
                                    value="{{ old('inside_city')}}"
                                @endif>
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="outside_city">Outside Dhaka</label>
                            <input type="number" class="form-control" id="outside_city" name="outside_city" placeholder="Delivery Cost..."
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->outside_city }}"
                                @else
                                    value="{{ old('outside_city')}}"
                                @endif>
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="tax">Tax (%)</label>
                            <input type="number" class="form-control" id="tax" name="tax" placeholder="Government Tax..."
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->tax }}"
                                @else
                                    value="{{ old('tax')}}"
                                @endif>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Breadcrumb Banner Image --}}
            <div class="mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Breadcrumb Banner Image</h5>
                </div>

                <div class="card-body">
                    <div class="multiple-image">
                        <label class="file_div" for="fileUploader" id="image_preview" style="padding: 20px;">
                            @if ( !empty($setting->banner_breadcrumb_img) )
                                <img src="{{ asset($setting->banner_breadcrumb_img) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">    
                            @else
                                <img src="{{ asset('public/backend/images/Upload_icon.png') }}" alt="" class="img_upload" />
                                <h3>Upload Files or <span>Browse</span></h3>
                                <p>Supported formates: JPEG, PNG, JPG</p>
                                <figcaption class="file_name d-none" ></figcaption>
                            @endif
                        </label>
                        <input type="file" class="d-none" id="fileUploader" accept=".jpg, .png, .jpeg, .webp" name="banner_breadcrumb_img" >
                    </div>
                </div>
            </div>


            {{-- Social Links --}}
            <div class="mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Social Links</h5>
                </div>

                <div class="card-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="url" class="form-control" id="facebook" name="facebook"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->facebook }}"
                                    @else
                                        value="{{ old('facebook')}}"  
                                    @endif
                                    placeholder="Facebook Link Here....">
                            </div>

                            <div class="col mb-3">
                                <label for="linkedin" class="form-label">Linkedin</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->linkedin }}"
                                    @else
                                        value="{{ old('linkedin')}}"  
                                    @endif
                                    placeholder="Linkedin Link Here....">
                            </div>

                            <div class="col mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="url" class="form-control" id="instagram" name="instagram"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->instagram }}"
                                    @else
                                        value="{{ old('instagram')}}"  
                                    @endif
                                    placeholder="Instagram Link Here....">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="url" class="form-control" id="twitter" name="twitter"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->twitter }}"
                                    @else
                                        value="{{ old('twitter')}}"  
                                    @endif
                                    placeholder="Twitter Link Here....">
                            </div>

                            <div class="col mb-3">
                                <label for="pinterest" class="form-label">Pinterest</label>
                                <input type="url" class="form-control" id="pinterest" name="pinterest"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->pinterest }}"
                                    @else
                                        value="{{ old('pinterest')}}"  
                                    @endif
                                    placeholder="Pinterest Link Here....">
                            </div>

                            <div class="col mb-3">
                                <label for="youtube" class="form-label">Youtube</label>
                                <input type="url" class="form-control" id="youtube" name="youtube"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->youtube }}"
                                    @else
                                        value="{{ old('youtube')}}" 
                                    @endif
                                    placeholder="Youtube Link Here....">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col mb-3">
                                <label for="reddit" class="form-label">Reddit</label>
                                <input type="url" class="form-control" id="reddit" name="reddit"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->reddit }}"
                                    @else
                                        value="{{ old('reddit')}}" 
                                    @endif
                                    placeholder="Reddit Link Here....">
                            </div>

                            <div class="col mb-3">
                                <label for="quora" class="form-label">Quora</label>
                                <input type="url" class="form-control" id="quora" name="quora"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->quora }}"
                                    @else
                                        value="{{ old('quora')}}"
                                    @endif
                                    placeholder="Quora Link Here....">
                            </div>

                            <div class="col mb-3">
                                <label for="thread" class="form-label">Thread</label>
                                <input type="url" class="form-control" id="thread" name="thread"
                                    @if ( !empty( $setting ) )
                                        value="{{ $setting->thread }}"
                                    @else
                                        value="{{ old('thread')}}"
                                    @endif
                                    placeholder="Thread Link Here....">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label" for="facebook_pixel">Facebook Pixel</label>
                                 <textarea id="facebook_pixel" class="form-control" name="facebook_pixel" placeholder="Link paste here...." rows="8">{{ old('facebook_pixel', $setting->facebook_pixel)}}</textarea>
                             </div>

                             <div class="col mb-3">
                                <label class="form-label" for="google_analytics">Google Analytics</label>
                                 <textarea id="google_analytics" class="form-control" name="google_analytics" placeholder="Link paste here...." rows="8">{{ old('google_analytics', $setting->google_analytics)}}</textarea>
                             </div>

                            <div class="col-12 mb-3">
                                <label class="form-label" for="google_map">Google Map </label>
                                 <textarea id="google_map" class="form-control" name="google_map" placeholder="Embeded link paste here...." rows="8">{{ old('google_map', $setting->google_map)}} </textarea>
                             </div>
                        </div>
                </div>
            </div>


            {{-- Environment Setup --}}
            <div class="mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Environment Setup</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        
                        <div class="col mb-3">
                            <label for="currency_symbol" class="form-label">Currency Symbol</label>
                            <select name="currency_symbol" id="currency_symbol" class="form-control" id="currency">
                                @foreach (config('setting.currencySymbols') as $key => $symbol)
                                    <option value="{{ $symbol }}"
                                        @if (!empty($setting) && $setting->currency_symbol == $symbol)
                                            selected
                                        @elseif (old('currency_symbol') == $symbol)
                                            selected
                                        @endif>
                                        {{ $symbol }} ({{ $key }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="currency_name" class="form-label">Currency Name</label>

                            <select class="form-select" id="currency_name" name="currency_name" value="{{ old('currency_name') }}">
                                <option value="" selected disabled>Select</option>
                                @foreach (config('setting.currency_list') as $key => $item)
                                    <option value="{{ $item }}" @if(!empty($setting->currency_name)) @selected($item == $setting->currency_name) @endif>{{ $item }} ({{ $key }})</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col mb-3">
                            <label for="timeZone" class="form-label">Time Zone</label>

                            <select class="form-select" id="timeZone" name="timeZone" {{ old('timeZone') }}>
                                <option value="" selected disabled>Select</option>
                                @foreach (config('setting.time_zone') as $key => $item)
                                    <option value="{{ $key }}" @if(!empty($setting->timeZone)) @selected($key == $setting->timeZone) @endif>{{ $key }} {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Footer & Meta Data --}}
            <div class="mb-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Footer & Meta Data</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="footer_logo" class="form-label">Footer Logo</label>
                            <input class="form-control" type="file" name="footer_logo" id="footer_logo">

                            @if ( !empty( $setting ) )
                                <img src="{{ asset($setting->footer_logo) }}" alt="" style="width: 50px;">
                            @endif
                        </div>

                        <div class="col mb-3">
                            <label for="footer_text" class="form-label">Footer Text</label>
                            <input type="text" class="form-control" id="footer_text" name="footer_text"
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->footer_text }}"
                                @else
                                    value="{{ old('footer_text')}}"
                                @endif
                                placeholder="Footer Text Here....">
                        </div>

                        <div class="col mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->meta_title }}"
                                @else
                                    value="{{ old('meta_title')}}"
                                @endif
                                placeholder="Meta Title Here....">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control meta-keywords" id="meta_keywords" name="meta_keywords"
                                @if ( !empty( $setting ) )
                                    value="{{ $setting->meta_keywords }}"
                                @else
                                    value="{{ old('meta_keywords')}}"
                                @endif
                                placeholder="Meta keywords Here....">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="meta_description">Meta Description</label>
                                <textarea id="meta_description" class="form-control" name="meta_description" placeholder="Write Meta Description....." rows="8"> @if( !empty( $setting ) ) {{ $setting->meta_description }}  @else {{ old('meta_description')}} @endif
                                </textarea>
                        </div>
                    </div>
                </div>
            </div>


            @if ( !empty( $setting ) )
                <button type="submit" class="btn btn-primary">Update</button>
            @else
                <button type="submit" class="btn btn-primary">Save Changes</button>
            @endif
        </div>

    </form>
 </div>

@endsection


@push('add-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>    

    <script>
        document.getElementById('fileUploader').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('image_preview');
            const files = event.target.files;

            if (files.length > 0) {
                // Clear existing content
                imagePreview.innerHTML = '';

                // Loop through selected files and display previews
                Array.from(files).forEach(file => {
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.width = '100%';
                            img.style.height = '240px';
                            // img.style.objectFit = 'cover';
                            imagePreview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });

        const meta_keywords = new Choices('.meta-keywords',{
            removeItems: true,
            duplicateItemsAllowed: false,
            removeItemButton: true,
            delimiter: ',',
        });

        //____ Currency Name Select2 ____//
        $('#currency_name').select2();

        //____ Currency Symbol Select2 ____//
        $('#currency_symbol').select2();

        //____ timeZone Select2 ____//
        $('#timeZone').select2();
    </script>
@endpush



