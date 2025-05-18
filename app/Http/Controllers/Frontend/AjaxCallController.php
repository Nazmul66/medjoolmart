<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class AjaxCallController extends Controller
{
    public function cartQuickView(Request $request)
    {
        // dd($request->all());
        $currency = getSetting()->currency_symbol;
        $Product__sizes = AttributeValue::where('attribute', "size")->get();
        $sizes = array_map(function ($item) {
            return $item['value'];
        }, $Product__sizes->toArray());

        $product = Product::leftJoin('categories', 'categories.id', 'products.category_id')
                    ->select('products.*', 'categories.category_name as cat_name')
                    ->where('products.id', $request->id)
                    ->first();

        // dd($product);
        $product_image = ProductImage::where('product_id', $product->id)->orderBy('order_id', 'asc')->get();
        $product_size = ProductSize::where('product_id', $product->id)->get();
        $product_color = ProductColor::where('product_id', $product->id)->get();

        // dd($product);
        $main_image = '';
        if( !empty($product->thumb_image) ){
            $main_image = '
                    <img class="lazyload" data-src="'. asset($product->thumb_image) .'" src="'. asset($product->thumb_image) .'" alt="'. $product->slug .'">
                ';
        }

        $images = [];
        if (!empty($product_image)) {
            foreach ($product_image as $image) {
                $images[] = asset($image->images);
            }
        }

        // Add $main_image as the first element of $images if it exists
        if (!empty($main_image)) {
            array_unshift($images, asset($product->thumb_image));
        }

        $price_val = '';
        if( checkDiscount($product) ){
            if ($product->discount_type === 'amount') {
                $discounted_price = $product->selling_price - $product->discount_value;
            
                $price_val = '
                    <h5 class="price-on-sale font-2">'. $currency . number_format($discounted_price, 2) . '</h5>
                    <div class="compare-at-price font-2">'. $currency . number_format($product->selling_price, 2) . '</div>
                    <div class="badges-on-sale text-btn-uppercase">
                        -' . $product->discount_value. $currency.'
                    </div>';
            } elseif ($product->discount_type === 'percent') {
                $discounted_price = $product->selling_price - ($product->selling_price * $product->discount_value / 100);
            
                $price_val = '
                    <h5 class="price-on-sale font-2">'. $currency . number_format($discounted_price, 2) . '</h5>
                    <div class="compare-at-price font-2">'. $currency . number_format($product->selling_price, 2) . '</div>
                    <div class="badges-on-sale text-btn-uppercase">
                        -' . $product->discount_value. '%
                    </div>';
            } else {
                $price_val = '
                    <h5 class="price-on-sale font-2">'. $currency . number_format($product->selling_price, 2) . '</h5>';
            }
        }
        else{
            $price_val = '
                <h5 class="price-on-sale font-2">'. $currency . number_format($product->selling_price, 2) . '</h5>';
        }


        // $product_price = '';
        // if ($product->discount_type === 'amount') {
        //     $discounted_price = $product->selling_price - $product->discount_value;
        
        //     $product_price = $discounted_price;
        // } elseif ($product->discount_type === 'percent') {
        //     $discounted_price = $product->selling_price - ($product->selling_price * $product->discount_value / 100);
        
        //     $product_price = $discounted_price;
        // } else {
        //     $product_price = $product->selling_price;
        // }


        $productSizes = collect($product_size);
        $defaultOrder = $sizes; 
        
        // Sort the sizes by the default order
        $sortedSizes = $productSizes->sortBy(function ($size) use ($defaultOrder) {
            return array_search($size->size_name, $defaultOrder); 
        });

        // Convert back to a plain array
        $product_sizes = $sortedSizes->values()->all();
        
        return response()->json([
            'product' => $product,
            'main_image' => $main_image,
            'multi_images' => $images,
            'product_sizes' => $product_sizes ?: [],
            'product_color' => $product_color,
            'price_val' => $price_val,
            // 'product_price' => $product_price,
        ]);
    }


}
