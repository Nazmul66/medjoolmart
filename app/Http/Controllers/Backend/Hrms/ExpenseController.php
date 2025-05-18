<?php

namespace App\Http\Controllers\Backend\Hrms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hrms\CreateExpenseRequest;
use App\Http\Requests\Hrms\UpdateExpenseRequest;
use App\Models\Admin;
use App\Traits\ImageUploadTraits;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ExpenseController extends Controller
{
    use ImageUploadTraits;

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
        $data['admins'] = Admin::all(); 
        return view('backend.pages.hrms.expense.index', $data);
    }

    public function getData()
    {
        // get all data
        $expenses = Expense::leftJoin('admins', 'admins.id', 'expenses.user_id')
                    ->select('expenses.*', 'admins.name', 'admins.image')
                    ->get();

        return DataTables::of($expenses)
            ->addColumn('purchase_by', function ($expense) {
                return '<div class="d-flex align-items-center gap-2">
                    <a href="'. asset($expense->image) .'" target="_blank">
                        <img src="'. asset($expense->image) .'" width="50px" height="50px">
                    </a>
                    <span class="text-dark" style="font-weight: 600;">'. $expense->name .'</span>
                </div>';
            })
            ->addColumn('amount', function ($expense) {
                return "<span class='text-dark'>". getSetting()->currency_symbol . $expense->amount ."</span>";
            })
            ->addColumn('purchase_date', function ($expense) {
                return "<span class='text-dark'>". date('F d Y', strtotime($expense->purchase_date)) ."</span>";
            })
            ->addColumn('status', function ($expense) {
                if(auth("admin")->user()->can("status.category"))
                    if ($expense->status === "paid") {
                        return '<span class="badge bg-success">Paid</span>';
                    } elseif($expense->status === "unpaid") {
                        return '<span class="badge bg-info">Unpaid</span>';
                    }
                    else{
                        return '<span class="badge bg-danger">Returned</span>';
                    }
                else{
                    return '<span class="badge bg-dark">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($expense) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$expense->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.category"))
                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$expense->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("delete.category"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$expense->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['expense' => $expense]);
                return $actionHtml;
            })
            ->rawColumns(['purchase_by', 'purchase_date', 'amount', 'status', 'action'])
            ->make(true);
    }

    public function changeExpenseStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.category')) {
            throw UnauthorizedException::forPermissions(['status.category']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Expense::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExpenseRequest $request)
    {
        // dd($request->all());
        if (!$this->user || !$this->user->can('create.category')) {
            throw UnauthorizedException::forPermissions(['create.category']);
        }

        DB::beginTransaction();
        try {
            $expense           =   new Expense();

            $expense->invoice_id          = $request->invoice_id;
            $expense->user_id             = $request->user_id;
            $expense->item_name           = $request->item_name;
            $expense->amount              = $request->amount;
            $expense->purchase_date       = $request->purchase_date;
            $expense->status              = $request->status;
            $expense->save();

            // Generate the next invoice number
            $numeric_part = (int) substr(Expense::max('invoice_id'), 4);
            $new_invoice = 'inv-' . ($numeric_part + 1);
        }
        catch(\Exception $ex){
            DB::rollBack();
            // throw $ex;
            return response()->json(['message' => 'Failed to create expense. Error: ' . $ex->getMessage(), 'status' => false]);
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Expense Created!", 'status' => true, 'invoice_id' => $new_invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        if (!$this->user || !$this->user->can('update.category')) {
            throw UnauthorizedException::forPermissions(['update.category']);
        }

        // dd($expense);
        return response()->json(['success' => $expense]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, $id)
    {
        if (!$this->user || !$this->user->can('update.category')) {
            throw UnauthorizedException::forPermissions(['update.category']);
        }

        $expense  = Expense::find($id);

        DB::beginTransaction();
        try {
            $expense->user_id             = $request->user_id;
            $expense->item_name           = $request->item_name;
            $expense->amount              = $request->amount;
            $expense->purchase_date       = $request->purchase_date;
            $expense->status              = $request->status;

            $expense->save();
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
    public function destroy(Expense $expense)
    {
        if (!$this->user || !$this->user->can('delete.category')) {
            throw UnauthorizedException::forPermissions(['delete.category']);
        }

        $expense->delete();
        return response()->json(['message' => 'Expense has been deleted.'], 200);
    }

    public function expenseView($id)
    {
        $expense = Expense::leftJoin('admins', 'admins.id', 'expenses.user_id')
                    ->select('expenses.*', 'admins.name', 'admins.image')
                    ->where('expenses.id', $id)
                    ->first();
        // dd($expense);

        $statusHtml = '';
        if ($expense->status === "paid") {
            $statusHtml = '<span class="text-success">Paid</span>';
        } elseif ( $expense->status === "unpaid" ) {
            $statusHtml = '<span class="text-info">Unpaid</span>';
        } else {
            $statusHtml = '<span class="text-danger">Returned</span>';
        }

        $purchase_amount = getSetting()->currency_symbol . $expense->amount;
        $purchase_date = date('F d, Y', strtotime($expense->purchase_date));
        $purchase_by = '
                <div class="d-flex flex-column">
                    <a href="' . asset($expense->image) . '" target="_blank">
                        <img src="' . asset($expense->image) . '" width="70px" height="70px">
                    </a>
                    <span class="text-dark mt-3" style="font-weight: 600;">' . $expense->name . '</span>
                </div>
            ';


        return response()->json([
            'success'            => $expense,
            'statusHtml'         => $statusHtml,
            'purchase_by'        => $purchase_by,
            'purchase_amount'    => $purchase_amount,
            'purchase_date'      => $purchase_date,
        ]);
    }
}
