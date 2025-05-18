<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class SubscriptionController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->user = Auth::guard('admin')->user();
        if (!$this->user) {
            abort(403, 'Unauthorized access');
        }
    }

    public function index()
    {
        return view('backend.pages.subscriber.index');
    }

    public function getData()
    {
        // get all data
        $subscribers = NewsletterSubscriber::all();

        return DataTables::of($subscribers)
            ->addIndexColumn()
            ->addColumn('sub_id', function($subscriber) {
                return $subscriber->id;
            })
            ->addColumn('view', function($subscriber) {
                return $subscriber->view == 0 ? true : false;
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
            ->addColumn('is_verify', function ($subscriber) {
                if ($subscriber->is_verified == 1) {
                    return '<button type="button" class="btn btn-success btn-rounded waves-effect waves-light">Verify</button>';
                } else {
                    return '<button type="button" class="btn btn-danger btn-rounded waves-effect waves-light">Not Verify</button>';
                }
            })
            ->addColumn('action', function ($subscriber) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions
                            @if(auth("admin")->user()->can("delete.subscription")) 
                                <i class="mdi mdi-chevron-down"></i>
                            @endif
                        </button>
                        @if(auth("admin")->user()->can("delete.subscription"))
                            <div class="dropdown-menu dropdownmenu-primary">
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$subscriber->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        @endif
                    </div>
                ', ['subscriber' => $subscriber]);

                return $actionHtml;
            })
            ->rawColumns(['sub_id', 'view', 'is_verify', 'email', 'action'])
            ->make(true);
    }

    public function destroy($id)
    {
        if (!$this->user || !$this->user->can('delete.subscription')) {
            throw UnauthorizedException::forPermissions(['delete.subscription']);
        }

        NewsletterSubscriber::where('id', $id)->delete();
        return response()->json(['message' => 'Subscriber has been deleted.'], 200);
    }

    public function subscriptionView(Request $request)
    {
        $id = $request->id;

        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->view = 1; // mark as viewed
        $subscriber->save();
    
        return response()->json(['message' => 'Marked as viewed', 'status' => true]);
    }
}
