<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function review_store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_id' => ['required', 'integer'],
            'ratings'    => ['required', 'integer'],
            'review'     => ['required', 'string', 'max: 400'],
        ]);

        $reviewExist = ProductReview::where(['product_id' => $request->product_id, 'user_id' => Auth::user()->id])->first();

        if( !empty($reviewExist) ){
            Toastr::error('You already added review in this product', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $review = new ProductReview();
            $review->product_id   = $request->product_id;
            $review->user_id      = Auth::user()->id;
            $review->review       = $request->review;
            $review->ratings      = $request->ratings;
            $review->status       = 0;
            $review->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            // throw $ex;
            Toastr::error('Review error problem', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        DB::commit();
        Toastr::success('Review added successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();

    }

}
