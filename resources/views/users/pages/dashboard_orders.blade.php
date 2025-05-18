@extends('users.layout.master')

@push('add-meta')
    
@endpush

@push('add-css')
    
@endpush


@section('body-content')

<div class="row">
    <div class="col-xl-9 col-xxl-10 col-lg-9  ms-auto">
      <div class="dashboard_content">
        <h3><i class="fas fa-list-ul"></i> order</h3>
        <div class="wsus__dashboard_order">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="package">Package</th>
                  <th class="p_date">Purchase Date</th>
                  <th class="e_date">Expired Date</th>
                  <th class="price">Price</th>
                  <th class="method">Payment Method</th>
                  <th class="tr_id">Transaction Id</th>
                  <th class="status">status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="package"><span class="badge bg-success">standard</span></td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$300</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Unlimited </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$200</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">custom </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$500</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Premium </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$300</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Unlimited </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$200</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">custom </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$500</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Premium </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$300</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Unlimited </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$200</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">custom </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$500</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Premium </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$300</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Unlimited </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$200</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">custom </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$500</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Premium </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$300</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">Unlimited </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$200</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
                <tr>
                  <td class="package">custom </td>
                  <td class="p_date">2021-10-16</td>
                  <td class="e_date">2023-03-20</td>
                  <td class="price">$500</td>
                  <td class="method">Paypal</td>
                  <td class="tr_id">PAYID-MFVHBWA7RR11097LB1292304</td>
                  <td class="status"><a href="dsahboard_order_invoice.html">view</a></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div id="pagination">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                  </a>
                </li>
                <li class="page-item"><a class="page-link page_active" href="#">1</a></li>
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

@endsection


@push('add-js')
    
@endpush