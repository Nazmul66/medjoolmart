<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QRCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use SimpleSoftwareIO\QrCode\Facades\QrCode as FacadesQrCode;
use Spatie\Permission\Exceptions\UnauthorizedException;

class QRCodeController extends Controller
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
        return view('backend.pages.generate_print.qrcode.index');
    }

    public function getData()
    {
        // get all data
        $qrcodes = QRCode::all();

        return DataTables::of($qrcodes)
            ->addIndexColumn()
            ->addColumn('link_name', function ($qrcode) {
                return '
                    <a class="" id="status" href="'. $qrcode->qrcode .'" target="_blank" style="text-decoration: underline !important; font-weight: 600;">
                        '. $qrcode->qrcode .'
                    </a>';
            })
            ->addColumn('qrcode_link', function ($qrcode) {
                return FacadesQrCode::size(100)->generate($qrcode->qrcode);
            })
            ->addColumn('status', function ($qrcode) {
                // if(auth("admin")->user()->can("status.category"))
                    if ($qrcode->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$qrcode->id.'" data-status="'.$qrcode->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$qrcode->id.'" data-status="'.$qrcode->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                // else{
                //     return '<span class="badge bg-info">N/A</span>'; 
                // }
            })
            ->addColumn('action', function ($qrcode) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$qrcode->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>


                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$qrcode->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>



                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$qrcode->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                           
                        </div>
                    </div>
                ', ['qrcode' => $qrcode]);
                return $actionHtml;
            })
            ->rawColumns(['link_name', 'qrcode_link', 'status', 'action'])
            ->make(true);
    }

    public function changeQrcodeStatus(Request $request)
    {
        // if (!$this->user || !$this->user->can('status.category')) {
        //     throw UnauthorizedException::forPermissions(['status.category']);
        // }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = QRCode::findOrFail($id);
        $page->status = $status;
        $page->save();

        //Debugged this code --> return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (!$this->user || !$this->user->can('create.category')) {
        //     throw UnauthorizedException::forPermissions(['create.category']);
        // }

        $request->validate([
            'qrcode' => 'required|url|max:255|unique:q_r_codes,qrcode',
        ]);

        DB::beginTransaction();
        try {
            $qrcode = new QRCode();
            $qrcode->qrcode          = $request->qrcode;
            $qrcode->status          = $request->status;
            $qrcode->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return response()->json(['message'=> "Successfully QRCode Created!", 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QRCode $qrcode)
    {
        // if (!$this->user || !$this->user->can('update.category')) {
        //     throw UnauthorizedException::forPermissions(['update.category']);
        // }

        // dd($qrcode);
        return response()->json(['success' => $qrcode]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // if (!$this->user || !$this->user->can('update.category')) {
        //     throw UnauthorizedException::forPermissions(['update.category']);
        // }

        $request->validate([
            'qrcode' => 'required|url|max:255|unique:q_r_codes,qrcode,' . $id,
        ]);

        $qrcode  = QRCode::find($id);

        DB::beginTransaction();
        try {
            $qrcode->qrcode          = $request->qrcode;
            $qrcode->status          = $request->status;
            $qrcode->update();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return response()->json(['message'=> "success"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QRCode $qrcode)
    {
        // if (!$this->user || !$this->user->can('delete.category')) {
        //     throw UnauthorizedException::forPermissions(['delete.category']);
        // }

        $qrcode->delete();

        return response()->json(['message' => 'QRCode has been deleted.'], 200);
    }

    public function qrcodeView($id)
    {
        $qrcode  = QRCode::find($id);
        // dd($qrcode);

        $statusHtml = '';
        if ($qrcode->status === 1) {
            $statusHtml = '<span class="text-success">Active</span>';
        } else {
            $statusHtml = '<span class="text-danger">Inactive</span>';
        }

        $created_date = date('d F, Y H:i:s A', strtotime($qrcode->created_at));
        $updated_date = date('d F, Y H:i:s A', strtotime($qrcode->updated_at));

        return response()->json([
            'success'           => $qrcode,
            'statusHtml'        => $statusHtml,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }
}
