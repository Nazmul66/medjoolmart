@extends('users.layout.master')

@push('add-meta')
    
@endpush

@push('add-css')
    
@endpush


@section('body-content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
      <div class="dashboard_content mt-2 mt-md-0">
        <h3><i class="far fa-star"></i> reviews</h3>
        <div class="wsus__dashboard_review">
          <div class="row">
            <div class="col-xl-6">
              <div class="wsus__dashboard_review_item">
                <div class="wsus__dash_rev_img">
                  <img src="{{ asset('public/frontend/images/tab_1.jpg') }}" alt="product" class="img-fluid w-100">
                </div>
                <div class="wsus__dash_rev_text">
                  <h5>apple ipad 7 serise <span>06-11-2021</span></h5>
                  <p class="wsus__dash_review">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur temporibus cum
                    excepturi.</p>
                  <ul>
                    <li><a href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"><i
                          class="fal fa-edit"></i> edit</a></li>
                    <li><a href="#"><i class="far fa-minus-circle"></i> delete</a></li>
                  </ul>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <div id="flush-collapseOne" class="accordion-collapse collapse"
                        aria-labelledby="flush-collapseOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <form>
                            <div class="wsus__riv_edit_single">
                              <i class="fas fa-star"></i>
                              <select class="select_2" name="state">
                                <option value="AL">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                              </select>
                            </div>
                            <div class="wsus__riv_edit_single text_area">
                              <i class="far fa-edit"></i>
                              <textarea cols="3" rows="3" placeholder="Your Text"></textarea>
                            </div>
                            <button type="submit" class="common_btn">submit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="wsus__dashboard_review_item">
                <div class="wsus__dash_rev_img">
                  <img src="{{ asset('public/frontend/images/mobile_2.jpg') }}" alt="product" class="img-fluid w-100">
                </div>
                <div class="wsus__dash_rev_text">
                  <h5>redmi note 8 (2020) <span>06-11-2021</span></h5>
                  <p class="wsus__dash_review">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur amet temporibus cum.</p>
                  <ul>
                    <li><a href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapsetwo"><i
                          class="fal fa-edit"></i> edit</a></li>
                    <li><a href="#"><i class="far fa-minus-circle"></i> delete</a></li>
                  </ul>
                  <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <div class="accordion-item">
                      <div id="flush-collapsetwo" class="accordion-collapse collapse"
                        aria-labelledby="flush-collapsetwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <form>
                            <div class="wsus__riv_edit_single">
                              <i class="fas fa-star"></i>
                              <select class="select_2" name="state">
                                <option value="AL">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                              </select>
                            </div>
                            <div class="wsus__riv_edit_single text_area">
                              <i class="far fa-edit"></i>
                              <textarea cols="3" rows="3" placeholder="Your Text"></textarea>
                            </div>
                            <button type="submit" class="common_btn">submit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="wsus__dashboard_review_item mb-xl-0 mb-xxl-0">
                <div class="wsus__dash_rev_img">
                  <img src="{{ asset('public/frontend/images/headphone_1.jpg') }}" alt="product" class="img-fluid w-100">
                </div>
                <div class="wsus__dash_rev_text">
                  <h5>bluetooth headphone <span>06-11-2021</span></h5>
                  <p class="wsus__dash_review">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur temporibus cum
                    excepturi.</p>
                  <ul>
                    <li><a href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapsethree"><i
                          class="fal fa-edit"></i> edit</a></li>
                    <li><a href="#"><i class="far fa-minus-circle"></i> delete</a></li>
                  </ul>
                  <div class="accordion accordion-flush" id="accordionFlushExample3">
                    <div class="accordion-item">
                      <div id="flush-collapsethree" class="accordion-collapse collapse"
                        aria-labelledby="flush-collapsethree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <form>
                            <div class="wsus__riv_edit_single">
                              <i class="fas fa-star"></i>
                              <select class="select_2" name="state">
                                <option value="AL">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                              </select>
                            </div>
                            <div class="wsus__riv_edit_single text_area">
                              <i class="far fa-edit"></i>
                              <textarea cols="3" rows="3" placeholder="Your Text"></textarea>
                            </div>
                            <button type="submit" class="common_btn">submit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="wsus__dashboard_review_item for_mar">
                <div class="wsus__dash_rev_img">
                  <img src="{{ asset('public/frontend/images/headphone_1.jpg') }}" alt="product" class="img-fluid w-100">
                </div>
                <div class="wsus__dash_rev_text">
                  <h5>bluetooth headphone <span>06-11-2021</span></h5>
                  <p class="wsus__dash_review">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur temporibus cum
                    excepturi.</p>
                  <ul>
                    <li><a href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour"><i
                          class="fal fa-edit"></i> edit</a></li>
                    <li><a href="#"><i class="far fa-minus-circle"></i> delete</a></li>
                  </ul>
                  <div class="accordion accordion-flush" id="accordionFlushExample4">
                    <div class="accordion-item">
                      <div id="flush-collapsefour" class="accordion-collapse collapse"
                        aria-labelledby="flush-collapsefour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <form>
                            <div class="wsus__riv_edit_single">
                              <i class="fas fa-star"></i>
                              <select class="select_2" name="state">
                                <option value="AL">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                              </select>
                            </div>
                            <div class="wsus__riv_edit_single text_area">
                              <i class="far fa-edit"></i>
                              <textarea cols="3" rows="3" placeholder="Your Text"></textarea>
                            </div>
                            <button type="submit" class="common_btn">submit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('add-js')
    
@endpush