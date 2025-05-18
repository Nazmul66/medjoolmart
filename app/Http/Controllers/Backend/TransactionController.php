<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class TransactionController extends Controller
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
        if (!$this->user || !$this->user->can('index.transaction')) {
            throw UnauthorizedException::forPermissions(['status.faq']);
        }

        return view('backend.pages.transaction.index');
    }

    public function getData()
    {
        // get all data
        $transactions = Transaction::leftJoin('orders', 'orders.order_id', 'transactions.order_id')
                    ->leftJoin('users', 'users.id','orders.user_id')
                    ->select('orders.*', 'users.name as cus_name', 'transactions.transaction_id', 'transactions.amount', 'transactions.id as trans_id')
                    ->get();

        return DataTables::of($transactions)
            ->addIndexColumn()
            ->addColumn('date', function ($transaction) {
                $date = date('F d, Y', strtotime($transaction->created_at));
                return $date;
            })
            ->addColumn('total_amount', function ($transaction) {
                $amount = getSetting()->currency_symbol . $transaction->amount;
                return $amount;
            })
            ->addColumn('action', function ($transaction) {
                 return '
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                    </button>

                    <div class="dropdown-menu dropdownmenu-primary" style="">
                        <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$transaction->trans_id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </div>
                    
                </div>';
            })
            ->rawColumns(['date','total_amount', 'payment_status', 'action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function transactionView($id)
    {
        $transaction  = Transaction::leftJoin('orders', 'orders.order_id', 'transactions.order_id')
                ->leftJoin('users', 'users.id','orders.user_id')
                ->select('orders.*', 'users.name as cus_name', 'transactions.transaction_id', 'transactions.amount', 'transactions.payment_method','transactions.created_at','transactions.updated_at' )
                ->where('transactions.id', $id)
                ->first();

        $created_date   = date('d F, Y', strtotime($transaction->created_at));
        $updated_date   = date('d F, Y', strtotime($transaction->updated_at));

        return response()->json([
            'success'           => $transaction,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }

}
