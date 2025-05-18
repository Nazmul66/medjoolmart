<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
     
class CartController extends Controller
{

    public function cart_view()
    {
        $data['cartItems']  =  Cart::content();
        $data['coupons']    =  Coupon::where('status', 1)->get();
        $data['products']   =  Product::where('status', 1)->inRandomOrder()->get();
        return view('frontend.pages.product_pages.cart_view', $data);
    }

    public function addCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if( $product->qty ===  0){
            return response()->json([
                'status' => "error",
                'message' => "Product stock out",
            ]);
        }
        elseif( $product->qty < $request->qty ){
            return response()->json([
                'status' => "error",
                'message' => 'Quantity is not available in our stock',
            ]);
        }

        $product_color = null;
        if( !empty($request->color_id) ){
            $product_color = ProductColor::where('product_id', $product->id)
                ->where('id', $request->color_id)
                ->first();
        }

        $product_size = null;
        if( !empty($request->size_id) ){
            $product_size  = ProductSize::where('product_id', $product->id)
                ->where('id', $request->size_id)
                ->first();
        }

        $productPrice = 0;
        if( checkDiscount($product) ){
            if( $product->discount_type === 'amount' ){
                $productPrice = $product->selling_price - $product->discount_value;
            }
            elseif( $product->discount_type === 'percent'){
                $productPrice = $product->selling_price - ($product->selling_price * $product->discount_value / 100);
            }
            else{
                $productPrice = $product->selling_price;
            }
        }
        else{
            $productPrice = $product->selling_price;  
        }

        $cartData = [];
        $cartData['id']                        = $product->id;
        $cartData['name']                      = $product->name;
        $cartData['qty']                       = $request->qty;
        $cartData['price']                     = $productPrice;
        $cartData['weight']                    = 10;

        // if ($product_size) {
            $cartData['options']['size_id']     = $product_size->id ?? null;
            $cartData['options']['size_name']   = $product_size->size_name ?? null;
            $cartData['options']['size_price']  = $product_size->size_price ?? null;
        // }

        // if ($product_color) {
            $cartData['options']['color_id']    = $product_color->id ?? null;
            $cartData['options']['color_name']  = $product_color->color_name ?? null;
            $cartData['options']['color_price'] = $product_color->color_price ?? null;
        // }

        $cartData['options']['variants_total']  = ( $product_color->color_price ?? 0 ) + ( $product_size->size_price ?? 0 );
        $cartData['options']['slug']            = $product->slug;
        $cartData['options']['units']           = $product->units;
        $cartData['options']['image']           = $product->thumb_image;
        $cartData['options']['image']           = $product->thumb_image;

        // dd($cartData);
        Cart::add($cartData);

        return response()->json([
           'status' => 'success',
           'message' => 'Product added to cart!',
           'button_value' => $request->button_value,
        ]);
    }

    public function get_sidebar_cart()
    {
        $cartItems = Cart::content()->map(function ($item) {
            return [
                'rowId' => $item->rowId,
                'name' => $item->name,
                'qty' => $item->qty,
                'units' => $item->options->units,
                'price' => $item->price,
                'size_name' => $item->options->size_name ?? null,
                'size_price' => $item->options->size_price ?? 0,
                'color_name' => $item->options->color_name ?? null,
                'color_price' => $item->options->color_price ?? 0,
                'image' => asset($item->options->image),
                'slug' => $item->options->slug,
                'total' => ($item->price + ($item->options->size_price ?? 0) + ($item->options->color_price ?? 0)) * $item->qty,
                'variant_price' => ($item->price + ($item->options->size_price ?? 0) + ($item->options->color_price ?? 0)),
            ];
        })->values()->toArray();

        $isEmpty = Cart::content()->isEmpty(); // Check if the cart is empty
    
        return response()->json([
            'status' => true,
            'isEmpty' => $isEmpty,
            'cartItems' => $cartItems ?: [],
        ]);
    }

    public function updateProductQuantity(Request $request)
    {
        // dd($request->all());

        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        if( $product->qty ===  0){
            return response()->json([
                'status' => "error",
                'message' => "Product stock out",
            ]);
        }
        elseif( $product->qty < $request->quantity ){
            return response()->json([
                'status' => "error",
                'recent_stock' => $product->qty,
                'message' => 'Quantity is not available in our stock',
            ]);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
   
        // dd($productTotal);
        return response()->json([
            'status'       => 'success',
            'message'      => 'Product quantity updated',
            'productTotal' => $productTotal,
            'productQty'   => Cart::get($request->rowId)->qty,
        ]);
    }

    public function cart_remove_product($rowId)
    {
      // dd($rowId);
       Cart::remove($rowId);

       if( Cart::content()->count() === 0 ){
            Session::forget('coupon');
            Session::forget('shippingCost');
       }

       return response()->json([
            'status'  => 'success',
            'message' => 'Delete Cart item successfully',
        ]);
    }

    public function getTotalCart()
    {
       $total = 0;
       foreach( Cart::content() as $product ){
            $total += $this->getProductTotal($product->rowId);
       }

       return response()->json(['status' => 'success', 'total' => $total]);
    }

    public function cart_count()
    {
        $cartCount = Cart::content()->count();

        return response()->json([
            'status'  => 'success',
            'cartCount' => $cartCount,
         ]);
    }

    public function clear_cart()
    {
        Cart::destroy();
        Session::forget('coupon'); 
        Session::forget('shippingCost');

        return response()->json([
           'status'  => 'success',
           'message' => 'Cart cleared successfully',
        ]);
    }

    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $totalPrice = ($product->price + ($product->options->size_price ?? 0) + ($product->options->color_price ?? 0)) * $product->qty;

        return $totalPrice;
    }



}
