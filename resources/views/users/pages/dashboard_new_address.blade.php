@extends('users.layout.master')

@push('add-meta')
    
@endpush

@push('add-css')
    <link rel="stylesheet" href="{{ asset('public/frontend/css/select2.min.css') }}">
@endpush


@section('body-content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="fal fa-gift-card"></i>create address</h3>
        <div class="wsus__dashboard_add wsus__add_address">
          <form>
            <div class="row">
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>name <b>*</b></label>
                  <input type="text" placeholder="Name">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>email</label>
                  <input type="email" placeholder="Email">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>phone <b>*</b></label>
                  <input type="text" placeholder="Phone">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>countery <b>*</b></label>
                  <div class="wsus__topbar_select">
                    <select class="select_2" name="state">
                      <option>Country</option>
                      <option>bangladesh</option>
                      <option>japan</option>
                      <option>korea</option>
                      <option>malayshia</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>state <b>*</b></label>
                  <div class="wsus__topbar_select">
                    <select class="select_2" name="state">
                      <option>state</option>
                      <option>bangladesh</option>
                      <option>japan</option>
                      <option>korea</option>
                      <option>malayshia</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>city <b>*</b></label>
                  <div class="wsus__topbar_select">
                    <select class="select_2" name="state">
                      <option>city</option>
                      <option>bangladesh</option>
                      <option>japan</option>
                      <option>korea</option>
                      <option>malayshia</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>zip code <b>*</b></label>
                  <input type="text" placeholder="Zip Code">
                </div>
              </div>
              <div class="col-xl-6 col-md-6">
                <div class="wsus__add_address_single">
                  <label>address type <b>*</b></label>
                  <input type="text" placeholder="Home / Office / others">
                </div>
              </div>
              <div class="col-xl-12">
                <div class="wsus__add_address_single">
                  <label>type comment</label>
                  <textarea cols="3" rows="5" placeholder="Type Your Comment"></textarea>
                </div>
              </div>
              <div class="col-xl-6">
                <button type="submit" class="common_btn">update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('add-js')
    <script src="{{ asset('public/frontend/js/select2.min.js') }}"></script>

    <script>
        //=======SELECT2====== 
        $(document).ready(function () {
            $('.select_2').select2();
        });
    </script>
@endpush