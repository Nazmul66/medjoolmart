<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SslCommerzPaymentController extends Controller
{

    public function index(CheckoutRequest $request)
    {
        // dd($request->all(), "hello");

        if( Cart::content()->count() < 1 ){
            Toastr::error('At least 1 product item must added', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        $payment_method = $request->input('payment-method');
        $order_address_data = [
            'full_name' => $request->input('full_name'),
            'email'     => $request->input('email') ?? 'unknown@gmail.com',
            'phone'     => $request->input('phone'),
            'city'      => $request->input('city') ?? 'Unknown',
            'address'   => $request->input('address'),
        ];

        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount']     = getMainCartTotal(); # You cant not pay less than 10
        $post_data['currency']         = getSetting()->currency_name;
        $post_data['tran_id']          = 'TXN-' . str_replace('.', '', microtime(true)); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name']         = $request->input('full_name');
        $post_data['cus_email']        = $request->input('email') ?? 'unknown@gmail.com';
        $post_data['cus_add1']         = $request->input('address');
        $post_data['cus_add2']         = "";
        $post_data['cus_city']         = $request->input('city') ?? 'Unknown';
        $post_data['cus_state']        = "";
        $post_data['cus_postcode']     = "";
        $post_data['cus_country']      = "Bangladesh";
        $post_data['cus_phone']        = $request->input('phone');
        $post_data['cus_fax']          = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name']        = "Store Test";
        $post_data['ship_add1']        = "Dhaka";
        $post_data['ship_add2']        = "Dhaka";
        $post_data['ship_city']        = "Dhaka";
        $post_data['ship_state']       = "Dhaka";
        $post_data['ship_postcode']    = "1000";
        $post_data['ship_phone']       = "";
        $post_data['ship_country']     = "Bangladesh";

        $post_data['shipping_method']  = "NO";
        $post_data['product_name']     = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile']  = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        if( Auth::Check() ){
            $user             = User::find(Auth::user()->id);
        
            $user->name       = $request->input('full_name');
            // Update email if it is different
            if ($user->email !== $request->input('email')) {
                $user->email = $request->input('email');
            }
            // Update phone if it is different
            if ($user->phone !== $request->input('phone')) {
                $user->phone = $request->input('phone');
            }
            $user->city       = $request->input('city');
            $user->address    = $request->input('address');
            $user->update();
        }

        //__ Store all data __//
        $this->storeOrder($post_data['tran_id'], $order_address_data, $payment_method, 1);

        //__ clear session __//
        $this->clearSession();  

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        $tran_id      =  $request->input('tran_id');
        $total_amount =  $request->input('total_amount');

        $sslc = new SslCommerzNotification();
        #Check order status in order table against the transaction id or order id.

        $order_details = DB::table('orders')
                    ->leftJoin('transactions', 'transactions.order_id', 'orders.order_id')
                    ->where('transactions.transaction_id', $tran_id)
                    ->select('orders.*', 'transactions.transaction_id')
                    ->first();

        $order_products = OrderProduct::where('order_id', $order_details->order_id)->get();

        return view('frontend.pages.frontend_pages.order-success', compact('order_details', 'order_products'));
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    /**
     * Store order data.
     */
    public function storeOrder($tran_id, $order_address_data, $payment_method, $payment_status)
    {
        $order = new Order();

        $maxOrderId               = Order::max('order_id');
        $order->tracking_number   = 'TRK' . rand(1000, 99999) . now()->format('Ymd') ;
        $order->order_id          = $maxOrderId ? $maxOrderId + 1 : 14529937801;
        $order->invoice_id        = 'INV-1737' . rand(100000000, 9999999999);
        $order->user_id           = Auth::check() ? Auth::user()->id : null;
        $order->subtotal          = getCartTotal();
        $order->total_amount      = getMainCartTotal();
        $order->currency_name     = getSetting()->currency_name;
        $order->currency_symbol   = getSetting()->currency_symbol;
        $order->product_qty       = Cart::content()->count();
        $order->payment_method    = $payment_method;
        $order->payment_status    = $payment_status;
        $order->delivery_charge   = Session::get('shippingCost') ?: null;
        $order->coupon            = json_encode(Session::get('coupon')) ?: null;
        $order->order_address     = json_encode($order_address_data);
        $order->order_status      = 'pending';
        // dd($order);
        $order->save();

        //__ store order products __//
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);

            $orderProduct   = new OrderProduct();
            $orderProduct->order_id       = $order->order_id;
            $orderProduct->product_id     = $product->id;
            $orderProduct->vendor_id      = 0;
            $orderProduct->product_name   = $product->name;
            $orderProduct->variants       = json_encode($item->options);
            $orderProduct->variant_total  = $item->options->variants_total;
            $orderProduct->unit_price     = $item->price;
            $orderProduct->qty            = $item->qty;
            $orderProduct->units          = $product->units;
            $orderProduct->save();
        }

        //__ store transaction details __//
        $transaction = new Transaction();
        $transaction->order_id            = $order->order_id;
        $transaction->transaction_id      = $tran_id;
        $transaction->payment_method      = $payment_method;
        $transaction->amount              = getMainCartTotal();
        $transaction->save();
    }

    /**
     * Clear All Session
     */
    public function clearSession()
    {
        Cart::destroy();
        Session::forget('coupon');
        Session::forget('shippingCost');
    }

}
