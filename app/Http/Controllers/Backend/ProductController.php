<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTraits;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ProductController extends Controller
{
    use ImageUploadTraits;

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
        $categories        = Category::get_data();
        $subCategories     = Subcategory::get_data();
        $childCategories   = ChildCategory::get_data();
        $brands            = Brand::get_data();

        return view('backend.pages.products.index', compact('categories', 'subCategories', 'childCategories', 'brands'));
    }

    public function create()
    {
        if (!$this->user || !$this->user->can('create.product')) {
            throw UnauthorizedException::forPermissions(['create.product']);
        }

        $categories        = Category::get_data();
        $subCategories     = Subcategory::get_data();
        $childCategories   = ChildCategory::get_data();
        $brands            = Brand::get_data();
        return view('backend.pages.products.create', compact('categories', 'subCategories', 'childCategories', 'brands'));
    }

    public function getData(Request $request)
    {
        // get all data
        $products = "";
           $query = Product::leftJoin('categories', 'categories.id', 'products.category_id')
                    ->leftJoin('subcategories', 'subcategories.id', 'products.subCategory_id')
                    ->leftJoin('child_categories', 'child_categories.id', 'products.childCategory_id')
                    ->leftJoin('brands', 'brands.id', 'products.brand_id');
                   
                    if( !empty($request->category_id) ){
                        $query->where('products.category_id', $request->category_id);
                    }

                    if( !empty($request->subCategory_id) ){
                        $query->where('products.subCategory_id', $request->subCategory_id);
                    }

                    if( !empty($request->product_qty) ){
                        $qtyRange = explode('-', $request->product_qty);
                        if (count($qtyRange) === 2) {
                            $query->whereBetween('qty', [$qtyRange[0], $qtyRange[1]]);
                        }
                    }

                    if( !empty($request->product_price) ){
                        $priceRange = explode('-', $request->product_price);
                        if (count($priceRange) === 2) {
                            $query->whereBetween('selling_price', [$priceRange[0], $priceRange[1]]);
                        }
                    }

            $products = $query->select('products.*', 'categories.category_name as cat_name', 'subcategories.subcategory_name as subCat_name', 'child_categories.name as childCat_name', 'brands.brand_name')
                    ->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('product_img', function ($product) {
                return ' <a href="'.asset( $product->thumb_image ).'" target="__blank">
                      <img src="'.asset( $product->thumb_image ).'" width="100px" height="100px">
                </a>';
            })
            ->addColumn('categorized', function ($product) {
                $subCat = $product->subCat_name ?? 'N/A';
                return '<div class="">
                       <h6>Category Name: <span class="badge bg-success">'. $product->cat_name .'</span></h6> 
                       <h6>SubCategory Name : <span class="badge bg-success">'. $subCat .'</span></h6>
                </div>';
            })
            ->addColumn('special_featured', function ($product) {
                $is_top = $product->is_top == 1 ? "Yes" : 'No';
                $is_best = $product->is_best == 1 ? "Yes" : 'No';
                $is_featured = $product->is_featured == 1 ? "Yes" : 'No';

                return '<div class="">
                       <h6>Top Product: <span class="badge bg-success">'. $is_top .'</span></h6> 
                       <h6>Best Product : <span class="badge bg-success">'. $is_best .'</span></h6>
                       <h6>Featured Product : <span class="badge bg-success">'. $is_featured .'</span></h6>
                </div>';
            })
            ->addColumn('product_details', function ($product) {
                return '<div class="">
                       <h6><span class="text-dark">'. $product->name .'</span></h6> 
                </div>';
            })
            ->addColumn('quantity', function ($product) {
                return '<div class="">
                       <h6><span class="text-dark">'. $product->qty .' Pcs</span></h6>
                </div>';
            })
            ->addColumn('status', function ($product) {
                if(auth("admin")->user()->can("status.product"))
                    if ($product->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$product->id.'" data-status="'.$product->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$product->id.'" data-status="'.$product->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($product) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" href="'. route('admin.product.show', $product->id) .'"><i class="fas fa-eye"></i> View</a>

                            @if(auth("admin")->user()->can("update.product"))
                                <a class="dropdown-item text-primary" href="'. route('admin.product.edit', $product->id) .'"><i class="fas fa-edit"></i> Edit</a>
                            @endif

                            @if(auth("admin")->user()->can("delete.product"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$product->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("variant.product"))
                                <a class="dropdown-item text-success" href="'. route('admin.product-variant', $product->id) .'" ><i class="bx bx-cog"></i>
                                Product Variants
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['product' => $product]);
                return $actionHtml;
            })

            ->rawColumns(['categorized', 'quantity', 'special_featured', 'product_details', 'product_img', 'status', 'action'])
            ->make(true);
    }

    public function changeProductStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.product')) {
            throw UnauthorizedException::forPermissions(['status.product']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Product::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        if (!$this->user || !$this->user->can('create.product')) {
            throw UnauthorizedException::forPermissions(['create.product']);
        }

        // dd($request->all());
        DB::beginTransaction();
        try {
            $product = new Product();

            $product->name                      = $request->name;
            $product->slug                      = Str::slug($request->name);
            $product->sku                       = $request->sku;
            $product->barcode                   = 730 . rand(100000000, 999999999);
            $product->vender_id                 = 1;  // Note 1=admin, 2=vendor
            $product->category_id               = $request->category_id;
            $product->subCategory_id            = $request->subCategory_id;
            $product->childCategory_id          = $request->childCategory_id;
            $product->brand_id                  = $request->brand_id;
            $product->qty                       = $request->qty;
            $product->units                     = $request->units;
            $product->video_link                = $request->video_link;
            $product->tags                      = $request->tags;
            $product->purchase_price            = $request->purchase_price;
            $product->selling_price             = $request->selling_price;
            $product->discount_type             = $request->discount_type;

            if( $request->discount_type === "none" ){
                $product->discount_value            = null;
            }

            $product->discount_value            = $request->discount_value;
            $product->offer_start_date          = $request->offer_start_date;
            $product->offer_end_date            = $request->offer_end_date;
            $product->short_description         = $request->short_description;
            $product->long_description          = $request->long_description;
            $product->return_policy             = $request->return_policy;
            $product->shipping_return           = $request->shipping_return;
            // $product->type                      = $request->type ?? 1;
            $product->is_top                    = $request->is_top;
            $product->is_best                   = $request->is_best;
            $product->is_featured               = $request->is_featured;
            $product->is_approved               = 1;  // Note 0=Not Approve, 1=Approve
            $product->seo_title                 = $request->seo_title;
            $product->seo_description           = $request->seo_description;
            $product->status                    = 1;
    
            // Handle image with ImageUploadTraits function
            $uploadImage                        = $this->imageUpload($request, 'thumb_image', 'product');
            $product->thumb_image               =  $uploadImage;
    
            // dd($product);
            $product->save();
        }

        catch(Exception $ex){
            DB::rollBack();
            throw $ex;
            Toastr::error('Product create error', 'Error', ["positionClass" => "toast-top-right"]);
        }

        DB::commit();
        Toastr::success('Product Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.product.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!$this->user || !$this->user->can('update.product')) {
            throw UnauthorizedException::forPermissions(['update.product']);
        }

        // dd($product);
        $categories        = Category::get_data();
        $subCategories     = Subcategory::get_data();
        $childCategories   = ChildCategory::get_data();
        $brands            = Brand::get_data();
        $product           = Product::findOrFail($id);

        return view('backend.pages.products.edit', compact('categories', 'subCategories', 'childCategories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        if (!$this->user || !$this->user->can('update.product')) {
            throw UnauthorizedException::forPermissions(['update.product']);
        }

        $product  = Product::find($id);

        DB::beginTransaction();
        try {

            $product->name                      = $request->name;
            $product->slug                      = Str::slug($request->name);
            $product->sku                       = $request->sku;
            // $product->barcode                   = 730 . rand(100000000, 999999999);
            // $product->vender_id                 = 1;  // Note 1=admin, 2=vendor
            $product->category_id               = $request->category_id;
            $product->subCategory_id            = $request->subCategory_id;
            $product->childCategory_id          = $request->childCategory_id;
            $product->brand_id                  = $request->brand_id;
            $product->qty                       = $request->qty;
            $product->units                     = $request->units;
            $product->video_link                = $request->video_link;
            $product->tags                      = $request->tags;
            $product->purchase_price            = $request->purchase_price;
            $product->selling_price             = $request->selling_price;
            $product->discount_type             = $request->discount_type;
            if( $request->discount_type === "none" ){
                $product->discount_value        = null;
            }
            else{
                $product->discount_value        = $request->discount_value;
            }
            $product->offer_start_date          = $request->offer_start_date;
            $product->offer_end_date            = $request->offer_end_date;
            $product->short_description         = $request->short_description;
            $product->long_description          = $request->long_description;
            $product->return_policy             = $request->return_policy;
            $product->shipping_return           = $request->shipping_return;
            // $product->type                      = $request->type ?? 1;
            $product->is_top                    = $request->is_top;
            $product->is_best                   = $request->is_best;
            $product->is_featured               = $request->is_featured;
            $product->is_approved               = 1;  // Note 0=Not Approve, 1=Approve
            $product->seo_title                 = $request->seo_title;
            $product->seo_description           = $request->seo_description;
            $product->status                    = 1;
    
            // Handle image with ImageUploadTraits function
            $uploadImages                     = $this->deleteImageAndUpload($request, 'thumb_image', 'product', $product->thumb_image );
            $product->thumb_image           =  $uploadImages;
        
            $product->update();
        }
        catch(Exception $ex){
            DB::rollBack();
            // throw $ex;
            Toastr::error('Product updated error', 'Error', ["positionClass" => "toast-top-right"]);
        }

        DB::commit();
        Toastr::success('Product updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.product.index');
        // return response()->json(['message'=> "Successfully Product Updated!", 'status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!$this->user || !$this->user->can('delete.product')) {
            throw UnauthorizedException::forPermissions(['delete.product']);
        }

        if ($product->thumb_image) {
            if (file_exists($product->thumb_image)) {
                unlink($product->thumb_image);
            }
        }

        $product->delete();
        return response()->json(['message' => 'Product has been deleted.'], 200);
    }

    public function getSubCategories(Request $request, Category $category)
    {
        $subcats= SubCategory::where('category_id', $category->id)->get();
        return response()->json(['message' => 'success', 'data' => $subcats], 200);
    }


    public function get_product_subCategory_data(Request $request)
    {
        // dd($request->all());
        $subCategories = Subcategory::where('category_id', $request->id)->where('status', 1)->get();

        // 'subcategory_img' is the column name where image filename is stored
        foreach ($subCategories as $subCategory) {
            $subCategory->image_url = asset($subCategory->subcategory_img); 
        }

        return response()->json(['status' => true, 'data' => $subCategories]);
    }

    public function get_product_childCategory_data(Request $request)
    {
        // dd($request->all());
        $childCategories = ChildCategory::where('subCategory_id', $request->id)->where('status', 1)->get();

        // 'subcategory_img' is the column name where image filename is stored
        foreach ($childCategories as $childCategory) {
            $childCategory->image_url = asset($childCategory->img); 
        }

        return response()->json(['status' => true, 'data' => $childCategories]);
    }


    public function show($id)
    {
        $product = Product::leftJoin('categories', 'categories.id', 'products.category_id')
                ->leftJoin('subcategories', 'subcategories.id', 'products.subCategory_id')
                ->leftJoin('child_categories', 'child_categories.id', 'products.childCategory_id')
                ->leftJoin('brands', 'brands.id', 'products.brand_id')
                ->select('products.*', 'categories.category_name as cat_name', 'subcategories.subcategory_name as subCat_name', 'child_categories.name as childCat_name', 'brands.brand_name')
                ->where('products.id', $id)
                ->first();

       return view('backend.pages.products.view', compact('product'));
    }


    public function product_variant($product_id)
    {
        if (!$this->user || !$this->user->can('variant.product')) {
            throw UnauthorizedException::forPermissions(['variant.product']);
        }

        // Product Color
        $data['product_id']       = $product_id;
        $data['size_value']       = AttributeValue::where('attribute', "size")->where('status', 1)->get();
        $data['color_value']      = AttributeValue::where('attribute', "color")->where('status', 1)->get();
        $data['productImages']    = ProductImage::where('product_id', $product_id)->orderBy('order_id', 'asc')->get();
        $data['productSizes']     = ProductSize::where('product_id', $product_id)->get();
        $data['productColors']    = ProductColor::where('product_id', $product_id)->get();

        return view('backend.pages.products.product_variant', $data);
    }
    
    
    public function update_product_variant(Request $request, $id)
    {
        // Handle Product sizes
        if ($request->has('size_name') && $request->has('size_price')) {
            foreach ($request->size_name as $index => $sizeName) {
                if (!empty($sizeName)) {
                    // Find existing ProductSize by size_id, or create a new one
                    ProductSize::updateOrCreate(
                        [
                            'product_id' => $id, 
                            'size_id' => $request->size_id[$index] // Match on product_id and size_id
                        ],
                        [
                            'size_name' => $sizeName, // Update or set size_name
                            'size_price' => $request->size_price[$index], // Update or set size_price
                            'stock' => $request->stock[$index] // Update or set stock
                        ]
                    );
                }
            }
        }


        // Handle Product Colors
        if ($request->has('color_name')) {
            foreach ($request->color_name as $row => $colorName) {
                if (!empty($colorName)) {
                    // Find existing ProductColor by color_id, or create a new one
                    $productColor = ProductColor::updateOrCreate(
                        [
                            'product_id' => $id, 
                            'color_id' => $request->color_id[$row] // Match on product_id and color_id
                        ],
                        [
                            'color_name' => $colorName, // Update or set color_name
                            'color_price' => $request->color_price[$row], // Update or set color_price
                            'color_code' => $request->color_code[$row] // Update or set color_code
                        ]
                    );
                }
            }
        }


        Toastr::success('Product variation successfully updated', 'Success', ["positionClass" => "toast-top-right"]);
       return redirect()->back();
    }

    public function product_images_store(Request $request, $id)
    {
        // Multiple images store
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {

                $productImages = new ProductImage();
                $productImages->product_id = $id;
    
                // Generate unique image name
                $imageName = $request->slug . rand(1, 99999999) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'public/backend/images/multiple-image/';
                $image->move($imagePath, $imageName);
                $productImages->images   =  $imagePath . $imageName;

                $productImages->save();
            }
        }

        Toastr::success('Product image successfully updated', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function product_images_sortable(Request $request)
    {
        //  dd($request->photo_id);
        if( !empty($request->photo_id) ){
            $i = 1;
            foreach( $request->photo_id as $image_id ){
                $productImage = ProductImage::findOrFail($image_id);

                $productImage->order_id = $i;
                $productImage->save();

                $i++;
            }
        }
        return response()->json(['status' => 'success']);
    }

    // Delete Multiple Product images variants
    public function delete_multiple_image($id)
    {
        try {
            $productImg = ProductImage::findOrFail($id);
            if( !is_null( $productImg ) ){
                if( file_exists( $productImg->images )){
                    unlink($productImg->images);
                }
                $productImg->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.',
            ]);
        } 
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the image.',
            ]);
        }
    }

    // Delete Multiple Product size variants
    public function delete_size_variants(Request $request)
    {
        // dd($request->all());
        $productSize = ProductSize::findOrFail($request->id);
        if( !is_null( $productSize ) ){
            $productSize->delete();
        }

       return response()->json([
            'status' => true,
            'message' => "Product Variant remove",
       ]);
    }


    // Delete Multiple Product color variants
    public function delete_color_variants(Request $request)
    {
        $productColor = ProductColor::findOrFail($request->id);
        if( !is_null( $productColor ) ){
            $productColor->delete();
        }

       return response()->json([
            'status' => true,
            'message' => "Product Variant remove",
       ]);
    }
}
