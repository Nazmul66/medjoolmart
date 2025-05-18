@extends('users.layout.master')

@push('add-meta')
    
@endpush

@push('add-css')
    
@endpush


@section('body-content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-heart"></i> wishlist</h3>
            <div class="wsus__dashboard_wishlist">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__cart_list wishlist">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr class="d-flex">
                                            <th class="wsus__pro_img">
                                                product item
                                            </th>

                                            <th class="wsus__pro_name">
                                                product details
                                            </th>

                                            <th class="wsus__pro_status">
                                                status
                                            </th>

                                            <th class="wsus__pro_select">
                                                quantity
                                            </th>

                                            <th class="wsus__pro_tk">
                                                price
                                            </th>

                                            <th class="wsus__pro_icon">
                                                action
                                            </th>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset('public/frontend/images/pro9_9.jpg') }}"
                                                    alt="product" class="img-fluid w-100">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>men's fashion sholder leather bag</p>
                                            </td>

                                            <td class="wsus__pro_status">
                                                <p>in stock</p>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <form class="select_number">
                                                    <input class="number_area" type="text" min="1" max="100"
                                                        value="1" />
                                                </form>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>$180,00</h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a class="common_btn" href="#">add to cart</a>
                                            </td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img">
                                                <img src="{{ asset('public/frontend/images/pro4.jpg') }}" alt="product"
                                                    class="img-fluid w-100">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>mean's casula fashion watch</p>
                                            </td>

                                            <td class="wsus__pro_status">
                                                <p>in stock</p>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <form class="select_number">
                                                    <input class="number_area" type="text" min="1" max="100"
                                                        value="1" />
                                                </form>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>$140,00</h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a class="common_btn" href="#">add to cart</a>
                                            </td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img">
                                                <img src="{{ asset('public/frontend/images/blazer_1.jpg') }}" alt="product"
                                                    class="img-fluid w-100">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>product name and details</p>
                                            </td>

                                            <td class="wsus__pro_status">
                                                <span> out of stock</span>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <form class="select_number">
                                                    <input class="number_area" type="text" min="1" max="100"
                                                        value="1" />
                                                </form>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>$220,00</h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a class="common_btn" href="#">add to cart</a>
                                            </td>
                                        </tr>
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img">
                                                <img src="{{ asset('public/frontend/images/pro2.jpg') }}" alt="product"
                                                    class="img-fluid w-100">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </td>
                                            <td class="wsus__pro_name">
                                                <p>product name and details</p>
                                            </td>

                                            <td class="wsus__pro_status">
                                                <p>in stock</p>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <form class="select_number">
                                                    <input class="number_area" type="text" min="1" max="100"
                                                        value="1" />
                                                </form>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>$180.00</h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a class="common_btn" href="#">add to cart</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="pagination">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link page_active" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
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