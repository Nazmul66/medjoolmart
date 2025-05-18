<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BkashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CheckoutRequest $request)
    {
       // dd($request->all());

       if( Cart::content()->count() > 0 ){
            $payment_method = $request->input('payment-method');
            $order_address_data = [
                'full_name' => $request->input('full_name'),
                'email'     => $request->input('email') ?? 'unknown@gmail.com',
                'phone'     => $request->input('phone'),
                'city'      => $request->input('city') ?? 'Unknown',
                'address'   => $request->input('address'),
            ];

            // Store all data
            $this->storeOrder($order_address_data, $payment_method, 1);

            // clear session
            $this->clearSession();
              
            Toastr::success('Order Successfully done', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('order-success');
        }
        else{
            Toastr::error('Please purchase any product', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Store order data.
     */
    public function storeOrder($order_address_data, $payment_method, $payment_status)
    {
        $order = new Order();

        $order->invoice_id        = 'INV-' . str_replace('.', '', microtime(true)) . '-' . date('Ymd');
        $order->user_id           = 0;
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
        $order->order_status      = 0;
        // dd($order);
        $order->save();

        //__ store order products __//
        foreach (Cart::content() as $item) {
            $product = Product::find($item->id);

            $orderProduct   = new OrderProduct();
            $orderProduct->order_id       = $order->id;
            $orderProduct->product_id     = $product->id;
            $orderProduct->vendor_id      = 0;
            $orderProduct->product_name   = $product->name;
            $orderProduct->variants       = json_encode($item->options);
            $orderProduct->variant_total  = $item->options->variants_total;
            $orderProduct->unit_price     = $item->price;
            $orderProduct->qty            = $item->qty;
            $orderProduct->save();
        }

        //__ store transaction details __//
        $transaction = new Transaction();
        $transaction->order_id            = $order->id;
        $transaction->transaction_id      = 'TXN-' . str_replace('.', '', microtime(true)) . '-' . date('YmdHis');
        $transaction->payment_method      = $payment_method;
        $transaction->amount              = getMainCartTotal();
        $transaction->save();
    }

    /**
     * Clear Sessions
    */
    public function clearSession()
    {
        Cart::destroy();
        Session::forget('coupon');
        Session::forget('shippingCost');
    }

}
