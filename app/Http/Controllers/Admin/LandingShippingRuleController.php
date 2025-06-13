<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LandingShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function landing_apply_shipping(Request $request)
    {
        // dd($request->all());

        $landingShippingCost = $request->input('shippingRule');

        Session::put('landingShippingCost', $landingShippingCost);

        $landingProduct = session('landing_product.default', collect());

        $totalAmountSum = 0;
        foreach($landingProduct as $item){
            $totalAmountSum += $item['price'] * $item['qty'];
        }

        if (Session::has('landingShippingCost')) {
            $shipping = Session::get('landingShippingCost');
        }
        $finalAmount = $totalAmountSum + $shipping;

        return response()->json([
            'status'              => true,
            'message'             => getSetting()->currency_symbol .' '. $landingShippingCost . ' ডেলিভারি চার্জ যুক্ত হয়েছে.',
            'landingShippingCost' => number_format($landingShippingCost, 2),
            'totalAmountSum'      => number_format($totalAmountSum, 2),
            'finalAmount'         => number_format($finalAmount, 2),
        ]);
    }
 
}
