<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.review.index');
    }

    public function getData()
    {
       $reviews   = DB::table('product_reviews')
                  ->leftJoin('users', 'users.id' ,'product_reviews.user_id')
                  ->leftJoin('products', 'products.id', 'product_reviews.product_id')
                  ->select('product_reviews.*', 'products.name as product_name','users.name as user_name') 
                  ->get();
        
        return DataTables::of($reviews)
            ->addIndexColumn()
            ->addColumn('status', function ($review) {
                if ($review->status == 1) {
                    return ' <a class="status" id="status" href="javascript:void(0)"
                        data-id="'.$review->id.'" data-status="'.$review->status.'"> <i
                            class="fa-solid fa-toggle-on fa-2x"></i>
                    </a>';
                } else {
                    return '<a class="status" id="status" href="javascript:void(0)"
                        data-id="'.$review->id.'" data-status="'.$review->status.'"> <i
                            class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                    </a>';
                }
            })
            ->addColumn('action', function ($review) {
                return '<div class="d-flex gap-3"> 
                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-id="'.$review->id.'" id="deleteBtn"> <i class="fas fa-trash"></i></a>
                </div>';
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }


    public function changeReviewStatus(Request $request)
    {
        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = ProductReview::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductReview $review)
    {
        $review->delete();
        return response()->json(['message' => 'Review has been deleted.'], 200);
    }
}
