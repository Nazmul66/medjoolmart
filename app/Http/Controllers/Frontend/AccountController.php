<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductReview;
use App\Models\User;
use App\Models\Wishlist;
use App\Traits\ImageUploadTraits;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    use ImageUploadTraits;

    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $data['all_orders']     = Order::where('user_id', Auth::user()->id)->count();
        $data['pending_orders'] = Order::where('user_id', Auth::user()->id)->where('order_status', 'pending')->count();
        $data['complete_order'] = Order::where('user_id', Auth::user()->id)->where('order_status', 'delivered')->count();
        $data['total_spend']    = Order::where('user_id', Auth::user()->id)->where('order_status', '!=', 'cancelled')->sum('total_amount');
        $data['wishlists']      = Wishlist::where('user_id', Auth::user()->id)->count();
        $data['reviews']        = ProductReview::where('user_id', Auth::user()->id)->count();
        return view('frontend.pages.user.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dashboard_profile()
    {
        return view('frontend.pages.user.dashboard_profile');
    }

    public function dashboard_review()
    {
        $user_reviews = ProductReview::leftJoin('users', 'users.id', 'product_reviews.user_id')
                    ->leftJoin('products', 'products.id', 'product_reviews.product_id')
                    ->select('product_reviews.*', 'products.name as prdt_name', 'users.name as user_name', 'products.slug')
                    ->where('user_id', Auth::user()->id)
                    ->get();
        return view('frontend.pages.user.dashboard_review', compact('user_reviews'));
    }

    public function dashboard_profile_update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate(
            [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'email', 'max:255'],
                'phone'    => ['required', 'regex:/^[0-9]{11,15}$/'],
                'image'    => ['nullable', 'image', 'mimes:jpg,png,webp,jpeg', 'max:4096'],
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
            $user            =  User::where('id', $id)->first();
            $user->name      =  $request->name;
            $user->email     =  $request->email;
            $user->phone     =  $request->phone;
            $user->city      =  $request->city;
            $user->country   =  $request->country;

            // Handle image with ImageUploadTraits function
            if( !empty($request->image) ){
                if( !empty($user->image) && file_exists($user->image)){
                    unlink($user->image);
                }

                $uploadImage          = $this->imageUpload($request, 'image', 'settings');
                $user->image          =  $uploadImage;
            }
            $user->save();
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

    public function checkCurrentPassword(Request $request)
    {
        // dd($request->all());
        return response()->json([
            'match' => Hash::check($request->current_password, Auth::user()->password)
        ]);
    }

    public function changePassword(Request $request)
    {
        // dd($request->all());
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
        if( Hash::check($request->current_password, Auth::user()->password) ){
            if( $request->new_password === $request->confirm_password ){
                User::where('id', Auth::user()->id)->update([
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

    /**
     * Store a newly created resource in storage.
     */
    public function dashboard_orders(Request $request)
    {
        $orders = Order::leftJoin('transactions', 'transactions.order_id', 'orders.order_id')
                ->leftJoin('users', 'users.id', 'orders.user_id')
                ->select('orders.*','users.id as user_id', 'users.name as cus_name', 'users.email as cus_email', 'users.phone as cus_phone')
                ->where('users.id', Auth::user()->id)
                ->get();

        return view('frontend.pages.user.dashboard_order', compact('orders'));
    }

    /**
      * Display the specified resource.
    */
    public function dashboard_orders_views(string $id)
    {
        $order  = DB::table('orders')
        ->leftJoin('transactions', 'transactions.order_id', 'orders.order_id')
        ->where('orders.id', $id)
        ->select('orders.*', 'transactions.transaction_id')
        ->first();
        
        $order_products = OrderProduct::where('order_id', $order->order_id)->get();
        return view('frontend.pages.user.dashboard_order_view', compact('order', 'order_products'));
    }

    /**
      * Show the form for editing the specified resource.
    */
    public function dashboard_wishlist()
    {
        $wishlists = Wishlist::leftJoin('products', 'products.id', 'wishlists.product_id')
        ->select('products.*', 'wishlists.id as wish_id')
        ->where('wishlists.user_id', Auth::id())->get();
        return view('frontend.pages.user.dashboard_wishlist', compact('wishlists'));
    }

    public function dashboard_wishlist_remove(string $id)
    {
        // dd($id);
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        return response()->json([
            'status'   => 'success',
            'message'  => 'Wishlist product removed successfully'
        ]);
    }

}
