<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SteadFast\SteadFastCourierLaravelPackage\Facades\SteadfastCourier;

class CODController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CheckoutRequest $request)
    {
        // dd($request->all());

       if( Cart::content()->count() > 0 ){
        
            $order_address_data = [
                'full_name' => $request->input('full_name'),
                'email'     => $request->input('email') ?? 'unknown@gmail.com',
                'phone'     => $request->input('phone'),
                'city'      => $request->input('city') ?? 'Unknown',
                'address'   => $request->input('address'),
            ];

            if( Auth::check() ){
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
            $order->payment_method    = $request->input('payment-method');
            $order->payment_status    = 0;
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
            $transaction->transaction_id      = 'TXN-' . str_replace('.', '', microtime(true));
            $transaction->payment_method      = $request->input('payment-method');
            $transaction->amount              = getMainCartTotal();
            $transaction->save();

            // Steadfast Courier APi Work
            // $orderData = [
            //     'invoice' => $order->invoice_id,
            //     'recipient_name' => $order_address_data['full_name'],
            //     'recipient_phone' => $order_address_data['phone'],
            //     'recipient_address' => $order_address_data['address'],
            //     'cod_amount' => $order->total_amount,
            //     'note' => '' ?? null,
            // ];
            
            // $response = SteadfastCourier::placeOrder($orderData);

            $this->clearSession();  // clear session
            session()->put("order_confirmed_$order->order_id", true);

            //Event
            broadcast(new OrderEvent('New Order Placed'));

            Toastr::success('Order Successfully done', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('payment.success', ['order_id' => $order->order_id]);
       }
       else{
            Toastr::error('At least 1 product item must added', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
       }
    }

    public function success_payment($order_id)
    {
        // Check if the session has the confirmation for this order
        if (!session()->has("order_confirmed_$order_id")) {
            return redirect()->route('home'); // Redirect to the home page
        }

        $order_details = DB::table('orders')
                    ->leftJoin('transactions', 'transactions.order_id', 'orders.order_id')
                    ->where('orders.order_id', $order_id)
                    ->select('orders.*', 'transactions.transaction_id')
                    ->first();

        $order_products = OrderProduct::where('order_id', $order_details->order_id)->get();

        // Clear the session to prevent revisiting
        session()->forget("order_confirmed_$order_id");

        return view('frontend.pages.frontend_pages.order-success', compact('order_details', 'order_products'));
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
