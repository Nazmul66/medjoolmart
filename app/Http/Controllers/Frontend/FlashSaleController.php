<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;

class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sliders'] = Slider::where('status', 1)->orderBy('serial', 'desc')->get();
        $data['flashSaleDate'] = FlashSale::first();
        $data['flashSaleItems'] = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();

        return view('frontend.pages.frontend_pages.flash_sale', $data);
    }
    
}
