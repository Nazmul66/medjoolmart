<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlists = collect(); // Initialize as an empty collection

        if (Auth::check()) {
            $wishlists = Wishlist::leftJoin('products', 'products.id', 'wishlists.product_id')
                ->select('products.*', 'wishlists.id as wish_id')
                ->where('wishlists.user_id', Auth::id())
                ->get();
        }

        return view('frontend.pages.product_pages.wishlist_view', compact('wishlists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addToWishlist(Request $request)
    {
        // dd($request->all());
        if( !Auth::check() ){
            return response()->json([
                'status'  => 'error',
                'message' => 'login before add a product into wishlist!',
            ]);
        }

        $user = Auth::user();
        $productId = $request->id;
    
        // Check if the item is already in the wishlist
        $wishlist = Wishlist::where('user_id', $user->id)->where('product_id', $productId)->first();
    
        if ($wishlist) {
            // Remove from wishlist
            $wishlist->delete();

            // Check if there are any remaining wishlist items
            $wishlistCount = Wishlist::where('user_id', $user->id)->count();

            return response()->json([
                'status' => 'removed',
                'message' => 'Removed from wishlist',
                'wishlist_count' => $wishlistCount
            ]);
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId
            ]);

            // Get the updated count
            $wishlistCount = Wishlist::where('user_id', $user->id)->count();
    
            return response()->json([
                'status' => 'added',
                'message' => 'Added to wishlist',
                'wishlist_count' => $wishlistCount
            ]);
        }
    }

    public function wishlist_count()
    {
        $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();

        return response()->json([
            'status'  => 'success',
            'wishlistCount' => $wishlistCount,
        ]);
    }

}
