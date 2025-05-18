<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    use ImageUploadTraits;

    public function cacheClear()
    {
        Artisan::call('config:cache');
        Artisan::call('config:clear');
        Artisan::call('route:cache');
        Artisan::call('route:clear');
        Artisan::call('view:cache');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize');
        Artisan::call('optimize:clear');
    
        Toastr::success('Cache Cleared Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function dashboards()
    {
        $data['total_order']     = Order::get()->count();
        $data['today_order']     = Order::whereDate('created_at', Carbon::today())->count();
        $data['pending_order']   = Order::where('order_status', 'pending')->count();
        $data['delivered_order'] = Order::where('order_status', 'delivered')->count();
        $data['cancelled_order'] = Order::where('order_status', 'cancelled')->count();
        $data['total_amount']    = Order::where('order_status', '!=', 'cancelled')->sum('total_amount');
        $data['todays_amount']   = Order::where('order_status', '!=', 'cancelled')->where('created_at', Carbon::today())->sum('total_amount');
        $data['monthly_amount']  = Order::where('order_status', '!=', 'cancelled')->where('created_at', Carbon::now()->month)->sum('total_amount');
        $data['yearly_amount']   = Order::where('order_status', '!=', 'cancelled')->where('created_at', Carbon::now()->year)->sum('total_amount');
        $data['brands']          = Brand::where('status', 1)->count();
        $data['categories']      = Category::where('status', 1)->count();
        $data['subscriber']      = NewsletterSubscriber::count();
        $data['products']        = Product::where('status', 1)->where('is_approved', 1)->count();
        $data['collections']     = Collection::where('status', 1)->count();
        $data['users']           = User::count();
        $data['reviews']         = ProductReview::count();
        $data['wishlists']       = Wishlist::count();

        return view('backend.pages.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        if( $request->isMethod('POST') ){
           $data = $request->all();

           // validation
           $rules = [
                'email' => [
                    'required',
                    'string',
                    'email:rfc,dns', // Ensures a valid email format & checks domain existence
                    'max:255'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',          // Minimum 8 characters
                    'max:30',         // Maximum 30 characters
                ]
           ];

           $customMessage = [
                "email.required"    => 'The email field is required.',
                "email.email"       => 'Please enter a valid email address.',
                "email.unique"      => 'This email is already registered.',
                "password.required" => 'The password field is required.',
                "password.min"      => 'Password must be at least 8 characters long.',
                "password.max"      => 'Password cannot exceed 30 characters.',
                "password.regex"    => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            ];

           $request->validate($rules, $customMessage);

           if( $admin = Auth::guard('admin')->attempt(["email" => $data['email'], "password" => $data['password']]) ){
                Toastr::success('Login Successfully', 'Success', ["positionClass" => "toast-top-right"]);
                return redirect('/admin/dashboards');
           }
           else{
                Toastr::error('Invalid Email or Password', 'Error', ["positionClass" => "toast-top-right"]);
                return redirect()->back();
           }
        }

        else{
            return view("backend.pages.auth.login");
        }
    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        
        Toastr::success('Admin Logout Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect('/admin/login');
    }

    public function profiles()
    {
        return view('backend.pages.profile-update.index');
    }

     /**
     * Admin Profile update
     */
    public function profileUpdate()
    {
        $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
        return view('backend.pages.profile-update.profile_update', compact('admin'));
    }

    public function changeProfile(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'email', 'max:255'],
                'phone'    => ['required', 'regex:/^[0-9]{11,15}$/'],
                'image'    => ['image', 'mimes:jpg,png,webp,jpeg', 'max: 4096'],
            ],
            [
                'name.required'     => 'The name field is required.',
                'email.required'    => 'The email field is required.',
                'email.email'       => 'Please enter a valid email address.',
                'phone.required'    => 'The phone field is required.',
            ]
        );

        DB::beginTransaction();
        try {
            $admin          =  Admin::where('id', Auth::guard('admin')->user()->id)->first();
            $admin->name    =  $request->name;
            $admin->email   =  $request->email;
            $admin->phone   =  $request->phone;

            // Handle image with ImageUploadTraits function
            if( $request->hasFile('image') ){
                if( !empty($admin->image) && file_exists($admin->image)){
                    unlink($admin->image);
                }

                $uploadImage           = $this->imageUpload($request, 'image', 'settings');
                $admin->image          =  $uploadImage;
            }
            $admin->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            // throw $ex;
            // dd($ex->getMessage());
            Toastr::error('Profile updated error', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        DB::commit();
        Toastr::success('Profile updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'new_password' => [
                    'string', 
                    'min:8', 
                    'regex:/[a-z]/',    // Must contain at least one lowercase letter
                    'regex:/[A-Z]/',    // Must contain at least one uppercase letter
                    'regex:/[0-9]/',    // Must contain at least one number
                    'regex:/[@$!%*?&#]/' // Must contain a special character
                ],        
                'confirm_password' => [
                    'same:new_password', // Ensure it matches the new password
                ],      
            ],
            [
                'new_password.required'    => 'The new password field is required.',
                'new_password.string'      => 'The new password must be a valid string.',
                'new_password.min'         => 'The new password must be at least 8 characters long.',
                'new_password.regex'       => 'The new password must include at least one lowercase letter, one uppercase letter, one number, and one special character.',
                'confirm_password.required' => 'The confirm password field is required.',
                'confirm_password.same'     => 'The confirm password must match the new password.',
            ]
        );

        // Password Update
        if( Hash::check($request->current_password, Auth::guard('admin')->user()->password) ){
            if( $request->new_password === $request->confirm_password ){
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'password' => bcrypt($request->new_password)
                ]);

                Toastr::success('Profile updated successfully', 'Success', ["positionClass" => "toast-top-right"]);        
                return redirect()->back();
           }

           else{
                Toastr::error('Your New password & Confirm Password not matched', 'Error', ["positionClass" => "toast-top-right"]); 
                return redirect()->back();
           }
        }

        else{
            Toastr::error('Your Current password is incorrect', 'Error', ["positionClass" => "toast-top-right"]); 
            return redirect()->back();
        }
    }

    public function checkCurrentPassword(Request $request)
    {
        // dd($request->all());
        return response()->json([
            'match' => Hash::check($request->current_password, Auth::guard('admin')->user()->password)
        ]);
    }
}
