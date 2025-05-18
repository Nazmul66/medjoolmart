<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function apply_coupon(Request $request)
    {
        // dd($request->all());
        if( $request->coupon_code === null){
            return response()->json(['status' => 'error', 'message' => 'Coupon field is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if( $coupon === null){
            return response()->json(['status' => 'error', 'message' => 'Invalid Coupon Code']);
        }
        else if( date('Y-m-d', strtotime($coupon->start_date)) > date('Y-m-d') ){
            return response()->json(['status' => 'error', 'message' => 'Coupon not exists']);
        }
        else if( date('Y-m-d', strtotime($coupon->end_date)) < date('Y-m-d') ){
            return response()->json(['status' => 'error', 'message' => 'Coupon is expired!']);
        } else if( $coupon->total_used >= $coupon->quantity ){
            return response()->json(['status' => 'error', 'message' => 'You can not apply this coupon']);
        }else if( getCartTotal() <= 1 ){
            return response()->json(['status' => 'error', 'message' => 'Coupon cannot be applied as the cart total is zero or insufficient.']);
        }

        if( $coupon->discount_type === "amount" ){
           Session::put('coupon', [
               'coupon_name'    => $coupon->name,
               'coupon_code'    => $coupon->code,
               'discount_type'  => "amount",
               'discount'       => $coupon->discount,
           ]);
        }
        else if( $coupon->discount_type === "percent" ){
            Session::put('coupon', [
                'coupon_name'   => $coupon->name,
                'coupon_code'   => $coupon->code,
                'discount_type' => "percent",
                'discount'      => $coupon->discount,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Coupon Applied successfully']);
    }


    public function coupon_calculation()
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
        
            if ($coupon['discount_type'] === "amount") {
                $total    = getCartTotal() - $coupon['discount'];
                $discount = $coupon['discount'];
                
            } elseif ($coupon['discount_type'] === "percent") {
                $discount = (getCartTotal() * $coupon['discount']) / 100;
                $total = getCartTotal() - $discount;
            }
        } else {
            $total = getCartTotal();
        }
        
        // Add shipping cost if available
        if (Session::has('shippingCost')) {
            $shippingCost = Session::get('shippingCost');
            $total += $shippingCost;
        } else {
            $shippingCost = 0;
        }
        
        // Return the updated values
        return response()->json([
            'status'           => 'success',
            'cart_total'       => $total,
            'discount'         => isset($discount) ? $discount : 0,
            'discount_type'    => isset($coupon['discount_type']) ? $coupon['discount_type'] : null,
            'discount_percent' => isset($coupon['discount']) ? $coupon['discount'] : null,
            'shipping_cost'    => $shippingCost,
        ]);
    }
}
