<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.pages.dashboard');
    }

    public function dashboard_profile()
    {
        return view('users.pages.dashboard_profile');
    }

    public function dashboard_orders()
    {
        $orders = Order::leftJoin('order_products', 'order_products.id', 'orders.order_id')
            ->leftJoin('transactions', 'transactions.order_id', 'orders.order_id')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->select('orders.*', 'order_products.product_name', 'order_products.variants', 'order_products.variant_total', 'order_products.unit_price', 'order_products.qty', 'users.id as user_id', 'users.name as cus_name', 'users.email as cus_email', 'users.phone as cus_phone')
            ->get();
        return view('users.pages.dashboard_orders', compact('orders'));
    }


    public function dashboard_orders_views()
    {
        return view('users.pages.orders_view');
    }

    public function dashboard_download()
    {
        return view('users.pages.dashboard_download');
    }

    public function dashboard_reviews()
    {
        return view('users.pages.dashboard_reviews');
    }

    public function dashboard_wishlist()
    {
        return view('users.pages.dashboard_wishlist');
    }
    
    public function dashboard_address()
    {
        return view('users.pages.dashboard_addresses');
    }

    public function dashboard_new_address()
    {
        return view('users.pages.dashboard_new_address');
    }

    public function dashboard_chat()
    {
        return view('users.pages.dashboard_chat');
    }

}
