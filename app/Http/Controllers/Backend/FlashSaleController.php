<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FlashSaleController extends Controller
{

    public function flashSale_index(Request $request)
    {
        $request->validate(
            [
                'end_date' => ['required'],
            ],
            [
                'end_date.required' => 'End Date is required',
            ]
        );

        DB::beginTransaction();
        try {
            FlashSale::updateOrCreate(
                ['id' => 1],
                ["end_date" => $request->end_date]
            );
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Flash-Sale updated!", 'status' => true]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flashSale = FlashSale::first();
        $products = Product::where('status', 1)->get();
        return view('backend.pages.flash_sale.index', compact('products', 'flashSale'));
    }

    public function getData()
    {
        // get all data
        $flashSaleItems = FlashSaleItem::leftJoin('products', 'products.id', 'flash_sale_items.product_id')
            ->leftJoin('flash_sales', 'flash_sales.id', 'flash_sale_items.flash_sale_id')
            ->select('flash_sale_items.*','products.name', 'products.slug', 'products.thumb_image', 'flash_sales.end_date')
            ->get();

        return DataTables::of($flashSaleItems)
            ->addIndexColumn()
            ->addColumn('product_img', function ($flashSaleItem) {
                return '<a href="'.asset( $flashSaleItem->thumb_image ).'" target="__target">
                     <img src="'.asset( $flashSaleItem->thumb_image ).'" width="50px" height="50px">
                </a>';
            })
            ->addColumn('product_name', function ($flashSaleItem) {
                return '<span class="text-dark"><strong>'. $flashSaleItem->name .'</strong></span>';
            })
            ->addColumn('end_date', function ($flashSaleItem) {
                return '<span class="btn btn-info"><strong>'. $flashSaleItem->end_date .'</strong></span>';
            })
            ->addColumn('show_at_home', function ($flashSaleItem) {
                if ($flashSaleItem->show_at_home == 1) {
                    return ' <a class="show_at_home" id="show_at_home" href="javascript:void(0)"
                        data-id="'.$flashSaleItem->id.'" data-status="'.$flashSaleItem->show_at_home.'"> <i
                            class="fa-solid fa-toggle-on fa-2x"></i>
                    </a>';
                } else {
                    return '<a class="show_at_home" id="show_at_home" href="javascript:void(0)"
                        data-id="'.$flashSaleItem->id.'" data-status="'.$flashSaleItem->show_at_home.'"> <i
                            class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                    </a>';
                }
            })
            ->addColumn('status', function ($flashSaleItem) {
                if ($flashSaleItem->status == 1) {
                    return ' <a class="status" id="status" href="javascript:void(0)"
                        data-id="'.$flashSaleItem->id.'" data-status="'.$flashSaleItem->status.'"> <i
                            class="fa-solid fa-toggle-on fa-2x"></i>
                    </a>';
                } else {
                    return '<a class="status" id="status" href="javascript:void(0)"
                        data-id="'.$flashSaleItem->id.'" data-status="'.$flashSaleItem->status.'"> <i
                            class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                    </a>';
                }
            })

            ->addColumn('action', function ($flashSaleItem) {
                return '<div class="d-flex gap-3">
                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-id="'.$flashSaleItem->id.'" id="deleteBtn"> <i class="fas fa-trash"></i></a>
                </div>';
            })

            ->rawColumns(['product_img', 'show_at_home', 'end_date', 'product_name', 'status', 'action'])
            ->make(true);
    }

    public function changeFlashSaleItemStatus(Request $request)
    {
        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = FlashSaleItem::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    public function showFlashSaleItem(Request $request)
    {
        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = FlashSaleItem::findOrFail($id);
        $page->show_at_home = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'product_id' => ['required', 'unique:flash_sale_items,product_id'],
            ],
            [
                'product_id.required' => 'Please fill up flash sale items',
                'product_id.unique' => 'The product has already in flash sale, add another product',
            ]
        );

        DB::beginTransaction();
        try {

            $flashSale = FlashSale::first();

            $flashSaleItem = new FlashSaleItem();

            $flashSaleItem->flash_sale_id       = $flashSale->id;
            $flashSaleItem->product_id          = $request->product_id;
            $flashSaleItem->show_at_home        = 0;
            $flashSaleItem->status              = 1;
            $flashSaleItem->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Flash Sale Item Created!", 'status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlashSaleItem $flashSaleItem)
    {
        $flashSaleItem->delete();
        return response()->json(['message' => 'Flash Sale Item has been deleted.'], 200);
    }
}
