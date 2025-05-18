<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateShippingRuleRequest;
use App\Http\Requests\Admin\UpdateShippingRuleRequest;
use Illuminate\Http\Request;
use App\Models\ShippingRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ShippingRuleController extends Controller
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
        return view('backend.pages.shipping-rule.index');
    }

    public function getData()
    {
        $shippingRules= ShippingRule::all();
        
        return DataTables::of($shippingRules)
            ->addIndexColumn()
            ->addColumn('name', function ($shippingRule) {
                return '<span class="badge bg-primary">'. $shippingRule->name .'</span>';
            })
            ->addColumn('type', function ($shippingRule) {
                return '<h6 style="white-space: wrap;"><span class="badge bg-success">'. $shippingRule->type .'</span></h6>';
            })
            ->addColumn('min_cost', function ($shippingRule) {
                return '<h6 style="white-space: wrap;">Min Cost: <span class="badge bg-success">'. $shippingRule->min_cost .' Tk</span></h6>';
            })
            ->addColumn('cost', function ($shippingRule) {
                return '<h6 style="white-space: wrap;">Cost: <span class="badge bg-success">'. $shippingRule->cost .' Tk</span></h6>';
            })
            ->addColumn('status', function ($shippingRule) {
                if(auth("admin")->user()->can("status.shipping"))
                    if ($shippingRule->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$shippingRule->id.'" data-status="'.$shippingRule->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$shippingRule->id.'" data-status="'.$shippingRule->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($shippingRule) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$shippingRule->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.shipping"))
                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$shippingRule->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("delete.shipping"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$shippingRule->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['shippingRule' => $shippingRule]);
                return $actionHtml;
            })
            ->rawColumns(['name', 'type', 'min_cost', 'cost', 'status', 'action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateShippingRuleRequest $request)
    {
        if (!$this->user || !$this->user->can('create.shipping')) {
            throw UnauthorizedException::forPermissions(['create.shipping']);
        }

        $shippingRule = new ShippingRule();

        DB::beginTransaction();
        try {
            $shippingRule->name            = $request->name;
            $shippingRule->type            = $request->type;
            $shippingRule->min_cost        = $request->min_cost ?? 0;
            $shippingRule->cost            = $request->cost;
            $shippingRule->status          = $request->status;
            
            $shippingRule->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        DB::commit();        
        return response()->json(['message'=> "Successfully Shipping Rule Created!", 'status' => true]);
    }

    public function changeShippingRuleStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.shipping')) {
            throw UnauthorizedException::forPermissions(['status.shipping']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = ShippingRule::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingRule $shippingRule)
    {
        if (!$this->user || !$this->user->can('update.shipping')) {
            throw UnauthorizedException::forPermissions(['update.shipping']);
        }

        return response()->json(['success' => $shippingRule]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingRuleRequest $request, $id)
    {
        if (!$this->user || !$this->user->can('update.shipping')) {
            throw UnauthorizedException::forPermissions(['update.shipping']);
        }

        $shippingRule = ShippingRule::findOrFail($id);
    
        DB::beginTransaction();
        try {
            $shippingRule->name            = $request->name;
            $shippingRule->type            = $request->type;
            if( !empty($request->type === "flat_cost") ){
                $shippingRule->min_cost    = 0;
            }
            else{
                $shippingRule->min_cost    = $request->min_cost;
            }
            $shippingRule->cost            = $request->cost;
            $shippingRule->status          = $request->status;
            
            $shippingRule->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }
        DB::commit();        
        return response()->json(['message'=> "Successfully Shipping Rule Updated!", 'status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingRule $shippingRule)
    {
        if (!$this->user || !$this->user->can('delete.shipping')) {
            throw UnauthorizedException::forPermissions(['delete.shipping']);
        }

        $shippingRule->delete();
        return response()->json(['message' => 'Shipping Rule has been deleted.'], 200);
    }
    

    public function shippingRuleView($id)
    {
        $shippingRule  = ShippingRule::find($id);

        $statusHtml = '';
        if ($shippingRule->status === 1) {
            $statusHtml = '<span class="text-success">Active</span>';
        } else {
            $statusHtml = '<span class="text-danger">Inactive</span>';
        }

        $created_date = date('d F, Y H:i:s A', strtotime($shippingRule->created_at));
        $updated_date = date('d F, Y H:i:s A', strtotime($shippingRule->updated_at));

        return response()->json([
            'success'           => $shippingRule,
            'statusHtml'        => $statusHtml,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }
}
