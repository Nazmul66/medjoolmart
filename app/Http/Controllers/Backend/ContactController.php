<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
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
        if (!$this->user || !$this->user->can('index.contact')) {
            throw UnauthorizedException::forPermissions(['index.contact']);
        }

        return view('backend.pages.contact_us.index');
    }

    public function getData()
    {
        // get all data
        $contacts = Contact::all();
        return DataTables::of($contacts)
            ->addIndexColumn()
            ->addColumn('email', function ($contact) {
                if( !empty($contact->email) ){
                    $email = '<a href="mailto:'. $contact->email .'" target="_blank" style="text-decoration: underline !important; color: green;">'. $contact->email .'</a>';
                }
                else{
                    $email = '<a href="javascript:void();" class="text-danger">N/A</a>';
                }
                return $email;
            })
            ->addColumn('phone', function ($contact) {
                if( !empty($contact->phone) ){
                    $phone = '<a href="tel:'. $contact->phone .'" style="text-decoration: underline !important; color: green;">'. $contact->phone .'</a>';
                }
                else{
                    $phone = '<a href="javascript:void();" class="text-danger">N/A</a>';
                }
                return $phone;
            })
            ->addColumn('date', function ($contact) {
                $date = date('F d, Y', strtotime($contact->created_at));
                return $date;
            })
            ->addColumn('action', function ($contact) {
                return  '<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu dropdownmenu-primary">
                        <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="' . $contact->id . '" data-bs-toggle="modal" data-bs-target="#viewModal">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </div>
                </div>';
            })
            ->rawColumns(['date', 'email', 'phone', 'action'])
            ->make(true);
    }

    public function contactView($id)
    {
        // if (!$this->user || !$this->user->can('view.category')) {
        //     throw UnauthorizedException::forPermissions(['view.category']);
        // }

        $contact  = Contact::find($id);
        // dd($contact);

         if( !empty($contact->email) ){
            $email = '<a href="mailto:'. $contact->email .'" target="_blank" style="text-decoration: underline !important; color: green;">'. $contact->email .'</a>';
        }
        else{
            $email = '<a href="javascript:void();" class="text-danger">N/A</a>';
        }

        if( !empty($contact->phone) ){
            $phone = '<a href="tel:'. $contact->phone .'" style="text-decoration: underline !important; color: green;">'. $contact->phone .'</a>';
        }
        else{
            $phone = '<a href="javascript:void();" class="text-danger">N/A</a>';
        }

        $created_date = date('d F, Y', strtotime($contact->created_at));
        $updated_date = date('d F, Y', strtotime($contact->updated_at));

        return response()->json([
            'success'           => $contact,
            'email'             => $email,
            'phone'             => $phone,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }

}
