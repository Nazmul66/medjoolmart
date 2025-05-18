@extends('frontend.layout.master')

@push('add-meta')
    <title>Sazao || About-us Template</title>
@endpush

@push('add-css')

@endpush


@section('body-content')

<!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>complete order</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">complete order</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        INVOICE PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__invoice_area">
                <div class="wsus__invoice_header">
                    <div class="wsus__invoice_content">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single">
                                    <h5>Invoice To</h5>
                                    <h6>Carls Jhons</h6>
                                    <p>Acme Inc</p>
                                    <p>Est St, 77 - Central Park, NYC</p>
                                    <p>Est St, 77 - Central Park, NYC</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                <div class="wsus__invoice_single text-md-center">
                                    <h5>shipping information</h5>
                                    <h6>Name: John Doe</h6>
                                    <p>VAT: 1425782</p>
                                    <p>VAT ID: 10253642</p>
                                    <p>Payment Type: Root</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="wsus__invoice_single text-md-end">
                                    <h5>Payment Details</h5>
                                    <h6>Name: John Doe</h6>
                                    <p>VAT: 1425782</p>
                                    <p>VAT ID: 10253642</p>
                                    <p>Payment Type: Root</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wsus__invoice_description">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th class="images">
                                        images
                                    </th>

                                    <th class="name">
                                        product
                                    </th>

                                    <th class="amount">
                                        amount
                                    </th>

                                    <th class="quentity">
                                        quentity
                                    </th>
                                    <th class="total">
                                        total
                                    </th>
                                </tr>
                                <tr>
                                    <td class="images">
                                        <img src="{{ asset('public/frontend/images/pro9.jpg') }}" alt="bag" class="img-fluid w-100">
                                    </td>

                                    <td class="name">
                                        <p>men's fashion sholder bag</p>
                                        <span>color : yellow</span>
                                        <span>size : XL</span>
                                    </td>
                                    <td class="amount">
                                        $55
                                    </td>

                                    <td class="quentity">
                                        2
                                    </td>
                                    <td class="total">
                                        $110
                                    </td>
                                </tr>
                                <tr>
                                    <td class="images">
                                        <img src="{{ asset('public/frontend/images/pro9.jpg') }}" alt="bag" class="img-fluid w-100">
                                    </td>

                                    <td class="name">
                                        <p>men's fashion sholder bag</p>
                                        <span>color : yellow</span>
                                        <span>size : XL</span>
                                    </td>
                                    <td class="amount">
                                        $55
                                    </td>

                                    <td class="quentity">
                                        2
                                    </td>
                                    <td class="total">
                                        $110
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="wsus__invoice_footer">
                    <p><span>Shipping fee:</span> $0.00</p>
                    <p><span>Tax:</span> $110.90</p>
                    <p><span>Discount: </span> $0.00</p>
                    <p><span>Total Amount:</span> $3,437.90 </p>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        INVOICE PAGE END
    ==============================-->

@endsection

@push('add-js')
    
@endpush