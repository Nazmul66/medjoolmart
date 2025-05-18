<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCouponRequest;
use App\Http\Requests\Admin\UpdateCouponRequest;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CouponController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
        if (!$this->user) {
            abort(403, 'Unauthorized access');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.coupon.index');
    }

    public function getData()
    {
        $coupons= Coupon::all();
        return DataTables::of($coupons)
            ->addIndexColumn()
            ->addColumn('info', function ($coupon) {
                $name = $coupon->name ?? 'N/A';
                $code = $coupon->code ?? 'N/A';

                return '<div class="">
                       <h6 style="white-space: wrap;">Coupon Name: <span class="badge bg-success">'. $name .'</span></h6> 
                       <h6 style="white-space: wrap;">Coupon Code : <span class="badge bg-success">'. $code .'</span></h6>
                </div>';
            })
            ->addColumn('discount', function ($coupon) {
                if( $coupon->discount_type === 'percent' ){
                    return '<span class="badge bg-primary">'. $coupon->discount . '%' .'</span>';
                }
                else if ( $coupon->discount_type === 'amount' ){
                    return '<span class="badge bg-info">'. $coupon->discount .' Tk</span>';
                }
            })
            ->addColumn('discount_type', function ($coupon) {
                return '<span class="badge bg-primary">'. $coupon->discount_type .'</span>';
            })
            ->addColumn('start_date', function ($coupon) {
                return '<span class="text-secondary">'. date('Y-m-d', strtotime($coupon->start_date)) .'</span>';
            })
            ->addColumn('end_date', function ($coupon) {
                return '<span class="text-secondary">'. date('Y-m-d', strtotime($coupon->end_date)) .'</span>';
            })
            ->addColumn('used', function ($coupon) {
                $quantity = $coupon->quantity ?? 'N/A';
                $max_used = $coupon->max_used ?? 'N/A';

                return '<div class="">
                       <h6 style="white-space: wrap;">Quantity : <span class="badge bg-success">'. $quantity .'</span></h6> 
                       <h6 style="white-space: wrap;">Max Used : <span class="badge bg-success">'. $max_used .'</span></h6> 
                       <h6 style="white-space: wrap;">Total Used : <span class="badge bg-success">'. $coupon->total_used .'</span></h6>
                </div>';
            })
            ->addColumn('status', function ($coupon) {
                if(auth("admin")->user()->can("status.coupon"))
                    if ($coupon->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$coupon->id.'" data-status="'.$coupon->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$coupon->id.'" data-status="'.$coupon->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($coupon) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$coupon->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.coupon"))
                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$coupon->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("delete.coupon"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$coupon->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['coupon' => $coupon]);
                return $actionHtml;
            })
            ->rawColumns(['info', 'discount_type', 'discount', 'start_date', 'end_date', 'used', 'status', 'action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCouponRequest $request)
    {
        if (!$this->user || !$this->user->can('create.coupon')) {
            throw UnauthorizedException::forPermissions(['create.coupon']);
        }
        // dd($request->all());
        DB::beginTransaction();
        try {
            $coupon = new Coupon();

            $coupon->name            = $request->name;
            $coupon->code            = Str::lower($request->code);
            $coupon->quantity        = $request->quantity;
            $coupon->max_used        = $request->max_used;
            $coupon->discount_type   = $request->discount_type;
            $coupon->discount        = $request->discount;
            $coupon->start_date      = $request->start_date;
            $coupon->end_date        = $request->end_date;
            $coupon->status          = $request->status;
            $coupon->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();        
        return response()->json(['message'=> "Successfully Coupon Created!", 'status' => true]);
    }

    public function changeCouponStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.coupon')) {
            throw UnauthorizedException::forPermissions(['status.coupon']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Coupon::findOrFail($id);
        $page->status = $status;
        $page->save();
        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        if (!$this->user || !$this->user->can('update.coupon')) {
            throw UnauthorizedException::forPermissions(['update.coupon']);
        }
        // dd($coupon);
        return response()->json(['success' => $coupon]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, $id)
    {
        if (!$this->user || !$this->user->can('update.coupon')) {
            throw UnauthorizedException::forPermissions(['update.coupon']);
        }

        $coupon = Coupon::findOrFail($id);

        DB::beginTransaction();
        try {
            // Updating coupon details
            $coupon->name = $request->name;
            $coupon->code = Str::lower($request->code);
            $coupon->quantity = $request->quantity;
            $coupon->max_used = $request->max_used;
            $coupon->discount_type = $request->discount_type;
            $coupon->discount = $request->discount;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->status = $request->status;

            $coupon->save();
        } catch (\Exception $ex) {
            // Rollback if there is an error
            DB::rollBack();
    
            // Return error response
            return response()->json(['message' => "Failed to update coupon!", 'error' => $ex->getMessage()], 500);
        }

        DB::commit();
        return response()->json(['message' => "Successfully Coupon Updated!", 'status' => true], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        if (!$this->user || !$this->user->can('delete.coupon')) {
            throw UnauthorizedException::forPermissions(['delete.coupon']);
        }

        $coupon->delete();  
        return response()->json(['message' => 'Coupon has been deleted.'], 200);
    }
    

    public function couponView($id)
    {
        $coupon  = Coupon::find($id);
        // dd($coupon);

        $statusHtml = '';
        if ($coupon->status === 1) {
            $statusHtml = '<span class="text-success">Active</span>';
        } else {
            $statusHtml = '<span class="text-danger">Inactive</span>';
        }

        $created_date   = date('d F, Y', strtotime($coupon->created_at));
        $updated_date   = date('d F, Y', strtotime($coupon->updated_at));
        $start_date     = date('d F, Y', strtotime($coupon->start_date));
        $end_date       = date('d F, Y', strtotime($coupon->end_date));

        return response()->json([
            'success'           => $coupon,
            'statusHtml'        => $statusHtml,
            'start_date'        => $start_date,
            'end_date'          => $end_date,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }
}
