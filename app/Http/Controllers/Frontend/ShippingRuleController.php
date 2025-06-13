<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function apply_shipping(Request $request)
    {
        // dd($request->all());
        $cartTotal = getCartTotal();

        if( getCartTotal() > 0 ){
            $shippingCost = $request->input('shippingRule');

            Session::put('shippingCost', $shippingCost);

            // Apply coupon discount if available
            if (Session::has('coupon')) {
                $coupon = Session::get('coupon');
      
                if ($coupon['discount_type'] === "amount") {
                    $cartTotal -= $coupon['discount'];
                } elseif ($coupon['discount_type'] === "percent") {
                    $discount = ($cartTotal * $coupon['discount']) / 100;
                    $cartTotal -= $discount;
                }
            }
      
            // Add shipping cost if available
            if (Session::has('shippingCost')) {
                $cartTotal += Session::get('shippingCost');
            }
            // return $cartTotal;
    
            return response()->json([
                'status'       => true,
                'message'      => '$' . $shippingCost . 'Delivery charge applied.',
                'shippingCost' => $shippingCost,
                'cartTotal'    => $cartTotal,
            ]);
        }
        else{
            return response()->json([
                'status'       => false,
                'message'      => 'Please provide cart items',
                'shippingCost' => 0,
                'cartTotal'    => $cartTotal,
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function shipping_rules_calculation()
    {
        //
    }

 
}
