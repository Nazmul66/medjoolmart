<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductReview;
use App\Models\ProductSize;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function product_page(Request $request)
    {
        if( $request->has('categories') ){
            $categoryItems = Category::where('status', 1)->get();
            $category = Category::where('slug', $request->categories)->firstOrFail();
            $products = Product::where([
                'category_id' => $category->id,
                'is_approved' => 1,
                'status' => 1,
            ])->orderBy('id', 'DESC')->paginate(20);
        }
        
        elseif( $request->has('sub_categories') ){
            $categoryItems = Subcategory::where('status', 1)->get();
            $subCat = Subcategory::where('slug', $request->sub_categories)->firstOrFail();
            $products = Product::where([
                'subCategory_id' => $subCat->id,
                'is_approved' => 1,
                'status' => 1,
            ])->orderBy('id', 'DESC')->paginate(20);
        }

        elseif( $request->has('child_categories') ){
            $categoryItems = ChildCategory::where('status', 1)->get();
            $childCat = ChildCategory::where('slug', $request->child_categories)->firstOrFail();
            $products = Product::where([
                'childCategory_id' => $childCat->id,
                'is_approved' => 1,
                'status' => 1,
            ])->orderBy('id', 'DESC')->paginate(20);
        }
    
        elseif( $request->has('brands') ){
            $categoryItems = Category::where('status', 1)->get();
            $brandData = Brand::where('slug', $request->brands)->firstOrFail();
            $products = Product::where([
                'brand_id' => $brandData->id,
                'is_approved' => 1,
                'status' => 1,
            ])->orderBy('id', 'DESC')->paginate(20);
        }

        elseif( $request->has('search') ){
            $categoryItems = Category::where('status', 1)->get();
            $products = Product::where(function($query) use ($request){
                $query->where('name', 'like', '%'. $request->search .'%')
                ->OrWhere('short_description', 'like', '%'. $request->search .'%')
                ->OrWhere('long_description', 'like', '%'. $request->search .'%');
            })
            ->orderBy('id', 'DESC')->paginate(20);
        }

        else{
            $categoryItems = Category::where('status', 1)->get();
            $products = Product::where([
                'is_approved' => 1,
                'status' => 1,
            ])->orderBy('id', 'DESC')->paginate(20);
        }

        $stockIn        = Product::where('qty', '>', 1)->where([
                                'is_approved' => 1,
                                'status' => 1,
                            ])->count();
        $stockOut       = Product::where('qty', '<=', 0)->where([
                                'is_approved' => 1,
                                'status' => 1,
                            ])->count();
        $maxPrice        = Product::max('selling_price') + 1000;
        $brands          = Brand::where('status', 1)->get();
        $product_sizes   = AttributeValue::where('attribute', 'size')->where('status', 1)->get();
        $product_colors  = AttributeValue::where('attribute', 'color')->where('status', 1)->get();

        return view('frontend.pages.product_pages.product', [
            'products'       => $products,
            'categoryItems'  => $categoryItems,
            'product_sizes'  => $product_sizes,
            'product_colors' => $product_colors,
            'brands'         => $brands,
            'maxPrice'       => $maxPrice,
            'stockIn'        => $stockIn,
            'stockOut'       => $stockOut,
        ]);
    }

    public function show_product_details($slug)
    {
        $products = Product::where('status', 1)->orderBy('product_view', 'desc')->get();
        $product  = Product::leftJoin('categories', 'categories.id', 'products.category_id')
                ->select('products.*', 'categories.category_name as cat_name', 'categories.slug as cat_slug')
                ->where('products.slug', $slug)
                ->first();

        // Handle case where the product is not found
        if (!$product) {
            abort(404);
        }

        $product->increment('product_view');

        $product_sizes    = ProductSize::where('product_id', $product->id)->get();
        $product_colors   = ProductColor::where('product_id', $product->id)->get();
        $product_images   = ProductImage::where('product_id', $product->id)->orderBy('order_id', 'desc')->get();

        $related_products = 
                    Product::where('category_id', '=', $product->category_id)
                    ->where('id', '!=', $product->id)
                    ->where('status', 1)
                    ->get();

        $product_reviews  = ProductReview::
                leftJoin('users', 'users.id', 'product_reviews.user_id')
                ->select('product_reviews.*', 'users.name', 'users.image')  
                ->where('product_id', $product->id)
                ->where('status', 1)
                ->get();

        $socialLinks = \Share::page(url()->current(), 'Share title')
                ->facebook()
                ->twitter()
                ->linkedin()
                ->whatsapp()
                ->reddit()
                ->pinterest()
                ->telegram();

        $socialLinks = str_replace('<a ', '<a target="_blank" ', $socialLinks);

        return view('frontend.pages.product_pages.product_details', [
            'products'           => $products,
            'product'            => $product,
            'product_reviews'    => $product_reviews,
            'product_sizes'      => $product_sizes,
            'product_colors'     => $product_colors,
            'product_images'     => $product_images,
            'related_products'   => $related_products,
            'socialLinks'        => $socialLinks,
        ]);
    }


    public function get_filter_product_ajax(Request $request)
    {
        // dd($request->all());
        $products = '';
            $query = Product::leftJoin('categories', 'categories.id', 'products.category_id')
                ->leftJoin('subcategories', 'subcategories.id', 'products.subCategory_id')
                ->leftJoin('child_categories', 'child_categories.id', 'products.childCategory_id')
                ->leftJoin('brands', 'brands.id', 'products.brand_id');

                // Filter by product category
                if( !empty($request->product_category_id) ){
                    $categories_id       = rtrim($request->product_category_id, ',');
                    $categories_id_array = explode(',', $categories_id);
                    $query->whereIn('products.category_id', $categories_id_array);
                }

                // Filter by subCategories
                if (!empty($request->product_subCategory_id)) {
                    $subCats_id = rtrim($request->product_subCategory_id, ',');
                    $subCats_id_array = explode(',', $subCats_id);
                    $query->whereIn('products.subCategory_id', $subCats_id_array);
                }

                // Filter by childCategories
                if (!empty($request->product_childCategory_id)) {
                    $childCats_id = rtrim($request->product_childCategory_id, ',');
                    $childCats_id_array = explode(',', $childCats_id);
                    $query->whereIn('products.childCategory_id', $childCats_id_array);
                }

                // Range Filter by product price
                if (!empty($request->start_price) || !empty($request->end_price)) {
                    $query->whereBetween('products.selling_price', [$request->start_price, $request->end_price]);
                }
                
                // Filter by Color
                if( !empty($request->color_id)){
                    $color_id       = rtrim($request->color_id, ',');
                    $color_id_array = explode(',', $color_id);
                    $query->join('product_colors', 'product_colors.product_id', 'products.id')
                          ->whereIn('product_colors.color_id', $color_id_array);
                }

                // Filter by Size
                if( !empty($request->size_id)){
                    $size_id       = rtrim($request->size_id, ',');
                    $size_id_array = explode(',', $size_id);
                    $query->join('product_sizes', 'product_sizes.product_id', 'products.id')
                          ->whereIn('product_sizes.size_id', $size_id_array);
                }

                // Filter by brand
                if( !empty($request->brand_id)){
                    $brand_id       = rtrim($request->brand_id, ',');
                    $brand_id_array = explode(',', $brand_id);
                    $query->whereIn('products.brand_id', $brand_id_array);
                }

                // Filter by Stock
                if( !empty($request->stock_id)){
                    if( $request->stock_id === 'stock_in' ){
                        $query->where('products.qty', '>', 1);
                    }
                    else{
                        $query->where('products.qty', '<=', 0);
                    }
                }

                // Filter by sorting
                if( !empty($request->sorting_id)){
                    if( $request->sorting_id === 'a_z' ){
                        $query->orderBy('products.name', 'asc');
                    }
                    elseif( $request->sorting_id === 'z_a' ){
                        $query->orderBy('products.name', 'desc');
                    }
                    elseif( $request->sorting_id === 'price_low_high' ){
                        $query->orderBy('products.selling_price', 'asc');
                    }
                    elseif( $request->sorting_id === 'price_high_low' ){
                        $query->orderBy('products.selling_price', 'desc');
                    }
                    else{
                        $query->orderBy('products.created_at', 'desc');
                    }
                }

                $products = $query->select('products.id', 'products.name', 'products.slug','products.thumb_image','products.discount_type','products.selling_price','products.qty','products.product_sold','products.is_approved', 'products.status')
                    ->distinct()
                    ->where('products.is_approved', 1)
                    ->where('products.status', 1)
                    ->paginate(20);

        return response()->json([
            'status'  => true,
            'count'   => $products->count(),
            'success' => view('frontend.include.render_product_page',[
                'products' => $products,
            ])->render(),
        ]);
    }


    public function pagination(Request $request)
    {
        $products = '';
        $query = Product::leftJoin('categories', 'categories.id', 'products.category_id')
            ->leftJoin('subcategories', 'subcategories.id', 'products.subCategory_id')
            ->leftJoin('child_categories', 'child_categories.id', 'products.childCategory_id')
            ->leftJoin('brands', 'brands.id', 'products.brand_id');

            // Filter by product category
            if( !empty($request->product_category_id) ){
                $categories_id       = rtrim($request->product_category_id, ',');
                $categories_id_array = explode(',', $categories_id);
                $query->whereIn('products.category_id', $categories_id_array);
            }

            // Filter by subCategories
            if (!empty($request->product_subCategory_id)) {
                $subCats_id = rtrim($request->product_subCategory_id, ',');
                $subCats_id_array = explode(',', $subCats_id);
                $query->whereIn('products.subCategory_id', $subCats_id_array);
            }

            // Filter by childCategories
            if (!empty($request->product_childCategory_id)) {
                $childCats_id = rtrim($request->product_childCategory_id, ',');
                $childCats_id_array = explode(',', $childCats_id);
                $query->whereIn('products.childCategory_id', $childCats_id_array);
            }

            // Range Filter by product price
            if (!empty($request->start_price) || !empty($request->end_price)) {
                $query->whereBetween('products.selling_price', [$request->start_price, $request->end_price]);
            }
            
            // Filter by Color
            if( !empty($request->color_id)){
                $color_id       = rtrim($request->color_id, ',');
                $color_id_array = explode(',', $color_id);
                $query->join('product_colors', 'product_colors.product_id', 'products.id')
                      ->whereIn('product_colors.color_id', $color_id_array);
            }

            // Filter by Size
            if( !empty($request->size_id)){
                $size_id       = rtrim($request->size_id, ',');
                $size_id_array = explode(',', $size_id);
                $query->join('product_sizes', 'product_sizes.product_id', 'products.id')
                      ->whereIn('product_sizes.size_id', $size_id_array);
            }

            // Filter by brand
            if( !empty($request->brand_id)){
                $brand_id       = rtrim($request->brand_id, ',');
                $brand_id_array = explode(',', $brand_id);
                $query->whereIn('products.brand_id', $brand_id_array);
            }

            // Filter by Stock
            if( !empty($request->stock_id)){
                if( $request->stock_id === 'stock_in' ){
                    $query->where('products.qty', '>', 1);
                }
                else{
                    $query->where('products.qty', '<=', 0);
                }
            }

            // Filter by sorting
            if( !empty($request->sorting_id)){
                if( $request->sorting_id === 'a_z' ){
                    $query->orderBy('products.name', 'asc');
                }
                elseif( $request->sorting_id === 'z_a' ){
                    $query->orderBy('products.name', 'desc');
                }
                elseif( $request->sorting_id === 'price_low_high' ){
                    $query->orderBy('products.selling_price', 'asc');
                }
                elseif( $request->sorting_id === 'price_high_low' ){
                    $query->orderBy('products.selling_price', 'desc');
                }
                else{
                    $query->orderBy('products.created_at', 'desc');
                }
            }

            $products = $query->select('products.id', 'products.name', 'products.slug','products.thumb_image','products.discount_type','products.selling_price','products.qty','products.product_sold','products.is_approved', 'products.status')
                ->distinct()
                ->where('products.is_approved', 1)
                ->where('products.status', 1)
                ->paginate(20);

                // dd($products);
            return response()->json([
                'status'  => true,
                'count'   => $products->total(),
                'success' => view('frontend.include.render_product_page',[
                    'products' => $products,
                ])->render(),
            ]);
    }


}
