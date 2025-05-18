<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CustomerController extends Controller
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
        if (!$this->user || !$this->user->can('index.user')) {
            throw UnauthorizedException::forPermissions(['index.user']);
        }

        return view('backend.pages.customer.index');
    }

    public function getData()
    {
        // get all data
        $customers = User::all();
        return DataTables::of($customers)
            ->addIndexColumn()
            ->addColumn('image', function ($customer) {
                if( !empty($customer->image) ){
                   $image = ' <a href="'.asset( $customer->image ).'" target="__blank">
                   <img src="'.asset( $customer->image ).'" width="100px" height="100px">
                   </a>';
                }
                else{
                    $image = ' <a href="'.asset('public/backend/assets/images/user.jpg').'" target="__blank">
                    <img src="'.asset('public/backend/assets/images/user.jpg').'" width="100px" height="100px">
                    </a>';
                }
                return $image;
            })
            ->addColumn('email', function ($customer) {
                if( !empty($customer->email) ){
                    $email = '<a href="mailto:'. $customer->email .'" target="_blank" style="text-decoration: underline !important; color: green;">'. $customer->email .'</a>';
                }
                else{
                    $email = '<a href="javascript:void();" class="text-danger">N/A</a>';
                }
                return $email;
            })
            ->addColumn('phone', function ($customer) {
                if( !empty($customer->phone) ){
                    $phone = '<a href="tel:'. $customer->phone .'" style="text-decoration: underline !important; color: green;">'. $customer->phone .'</a>';
                }
                else{
                    $phone = '<a href="javascript:void();" class="text-danger">N/A</a>';
                }
                return $phone;
            })
            ->addColumn('date', function ($customer) {
                $date = date('F d, Y', strtotime($customer->created_at));
                return $date;
            })
            ->addColumn('action', function ($customer) {
                 return '
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                    </button>

                    <div class="dropdown-menu dropdownmenu-primary" style="">
                        <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$customer->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </div>
                </div>';
            })
            ->rawColumns(['date', 'email', 'phone', 'image', 'action'])
            ->make(true);
    }

    public function customerView($id)
    {
        $user  = User::find($id);
        // dd($user);

        if( !empty($user->image) ){
            $image = ' <a href="'.asset( $user->image ).'" target="__blank">
            <img src="'.asset( $user->image ).'" width="100px" height="100px">
            </a>';
         }
         else{
             $image = ' <a href="'.asset('public/backend/assets/images/user.jpg').'" target="__blank">
             <img src="'.asset('public/backend/assets/images/user.jpg').'" width="100px" height="100px">
             </a>';
        }

         if( !empty($user->email) ){
            $email = '<a href="mailto:'. $user->email .'" target="_blank" style="text-decoration: underline !important; color: green;">'. $user->email .'</a>';
        }
        else{
            $email = '<a href="javascript:void();" class="text-danger">N/A</a>';
        }

        if( !empty($user->phone) ){
            $phone = '<a href="tel:'. $user->phone .'" style="text-decoration: underline !important; color: green;">'. $user->phone .'</a>';
        }
        else{
            $phone = '<a href="javascript:void();" class="text-danger">N/A</a>';
        }

        $created_date = date('d F, Y', strtotime($user->created_at));
        $updated_date = date('d F, Y', strtotime($user->updated_at));

        return response()->json([
            'success'           => $user,
            'image'             => $image,
            'email'             => $email,
            'phone'             => $phone,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }

}
