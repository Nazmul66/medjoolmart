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
    <div class="card">
        {{-- Global setting --}}
        <div class="mb-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Email Configuration</h5>
            </div>

            <div class="card-body">
                <form action="{{ route("admin.email.setting.update") }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger"> *</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $email_setting->email }}">
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="mail_host">Mail Host <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="{{ $email_setting->host }}" id="mail_host" name="host">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="username" class="form-label">Smtp username <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="{{ $email_setting->username }}" id="username" name="username">
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="password">Smtp password <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="{{ $email_setting->password }}" id="password" name="password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="mail_port" class="form-label">Mail Port <span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="{{ $email_setting->port }}" id="mail_port" name="port">
                        </div>

                        <div class="col mb-3">
                            <label class="form-label" for="mail_encryption">Mail Encryption <span class="text-danger"> *</span></label>
                            <select name="encryption" class="form-control" id="mail_encryption">
                                <option value="tls" @if( $email_setting->encryption === 'tls' ) selected @endif>TLS</option>
                                <option value="ssl" @if( $email_setting->encryption === 'ssl' ) selected @endif>SSL</option>
                            </select>
                        </div>
                    </div>

                    @if(auth("admin")->user()->can("create.email.config.setting"))
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    @endif
                </form>
            </div>
        </div>

    </div>
 </div>

@endsection


@push('add-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>    

    <script>
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



