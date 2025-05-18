<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Marquee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class MarqueeController extends Controller
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
        return view('backend.pages.marquee.index');
    }

    public function getData()
    {
        // get all data
        $marquees= Marquee::all();

        return DataTables::of($marquees)
            ->addIndexColumn()
            ->addColumn('status', function ($marquee) {
                if(auth("admin")->user()->can("status.marquee"))
                    if ($marquee->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$marquee->id.'" data-status="'.$marquee->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$marquee->id.'" data-status="'.$marquee->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($marquee) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$marquee->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.category"))
                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$marquee->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("delete.category"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$marquee->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['marquee' => $marquee]);
                return $actionHtml;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function changeMarqueeStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.marquee')) {
            throw UnauthorizedException::forPermissions(['status.marquee']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Marquee::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->user || !$this->user->can('create.marquee')) {
            throw UnauthorizedException::forPermissions(['create.marquee']);
        }

        $request->validate([
            'name' => ['required', 'string', 'unique:marquees,name']
        ]);

        DB::beginTransaction();
        try {
            $marquee    = new Marquee();
            $marquee->name         = $request->name;
            $marquee->status       = $request->status;
            $marquee->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Marquee Created!", 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marquee $marquee)
    {
        if (!$this->user || !$this->user->can('update.marquee')) {
            throw UnauthorizedException::forPermissions(['update.marquee']);
        }

        return response()->json(['success' => $marquee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!$this->user || !$this->user->can('update.marquee')) {
            throw UnauthorizedException::forPermissions(['update.marquee']);
        }

        $request->validate([
            'name' => ['required', 'string', 'unique:marquees,name,'. $id]
        ]);

        $marquee  = Marquee::find($id);

        DB::beginTransaction();
        try {
            // Handle image with ImageUploadTraits function
            $marquee->name          = $request->name;
            $marquee->status        = $request->status;
            $marquee->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
        return response()->json(['message'=> "success"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marquee $marquee)
    {
        if (!$this->user || !$this->user->can('delete.marquee')) {
            throw UnauthorizedException::forPermissions(['delete.marquee']);
        }

        $marquee->delete();
        return response()->json(['message' => 'Marquee has been deleted.'], 200);
    }

    public function marqueeView($id)
    {
        $marquee  = Marquee::find($id);
        // dd($marquee);

        $statusHtml = '';
        if ($marquee->status === 1) {
            $statusHtml = '<span class="text-success">Active</span>';
        } else {
            $statusHtml = '<span class="text-danger">Inactive</span>';
        }

        $created_date = date('d F, Y H:i:s A', strtotime($marquee->created_at));
        $updated_date = date('d F, Y H:i:s A', strtotime($marquee->updated_at));

        return response()->json([
            'success'           => $marquee,
            'statusHtml'        => $statusHtml,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }
}
