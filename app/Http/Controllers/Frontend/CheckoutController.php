<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\ShippingRule;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function checkout()
    {
        // if( Cart::content()->count() < 1 ){
        //     Toastr::error('At least 1 product item must added', 'Error', ["positionClass" => "toast-top-right"]);
        //     return redirect()->route('home');
        // }

        // if (!Auth::guard('web')->check()) {
        //     session(['custom_redirect_url' => url()->full()]);
        //     return redirect()->route('login');
        // }
        
        // Session::forget('custom_redirect_url');

        $data['cartItems']        =  Cart::content();
        $data['coupons']          =  Coupon::where('status', 1)->get();
        $data['shipping_rules']   =  ShippingRule::where('status', 1)->get();
        
        return view('frontend.pages.product_pages.checkout', $data);
    }


}
