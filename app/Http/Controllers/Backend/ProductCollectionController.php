<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTraits;
use App\Models\Product;
use App\Models\Collection;
use App\Models\ProductCollection;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class ProductCollectionController extends Controller
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
        return view('backend.pages.product_collection.index');
    }

    public function create()
    {
        if (!$this->user || !$this->user->can('create.product.collection')) {
            throw UnauthorizedException::forPermissions(['create.product.collection']);
        }

        $products = Product::where('is_approved', 1)->where('status', 1)->where('qty', '>', 0)->get();
        return view('backend.pages.product_collection.create', compact('products'));
    }

    public function getData()
    {
        // get all data
        $collections = Collection::all();

        return DataTables::of($collections)
            ->addIndexColumn()
            ->addColumn('image', function ($collection) {
                return ' <a href="'.asset( $collection->image ).'" target="_blank">
                      <img src="'.asset( $collection->image ).'" width="150px">
                </a>';
            })
            ->addColumn('total_product', function ($collection) {
               $total = ProductCollection::where('collect_id', $collection->id)->count();
                return '<span class="text-dark">'. $total .' products</span>';
            }) 
            ->addColumn('date', function ($collection) {
                return '<span class="text-dark">'. date("F d, Y", strtotime($collection->created_at)) .'</span>';
            }) 
            ->addColumn('status', function ($collection) {
                if(auth("admin")->user()->can("status.product.collection"))
                    if ($collection->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$collection->id.'" data-status="'.$collection->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$collection->id.'" data-status="'.$collection->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($collection) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            @if(auth("admin")->user()->can("update.product.collection"))
                                <a class="dropdown-item text-primary" href="'. route('admin.product.collection.edit', $collection->id) .'"><i class="fas fa-edit"></i> Edit</a>
                            @endif

                            @if(auth("admin")->user()->can("delete.product.collection"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$collection->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['collection' => $collection]);
                return $actionHtml;
            })
            ->rawColumns(['image', 'total_product', 'date', 'status', 'action'])
            ->make(true);
    }

    public function changeCollectionStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.product.collection')) {
            throw UnauthorizedException::forPermissions(['status.product.collection']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Collection::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->user || !$this->user->can('create.product.collection')) {
            throw UnauthorizedException::forPermissions(['create.product.collection']);
        }

        // dd($request->all());
        $request->validate(
            [
                'title'         => 'required|string|max:255|unique:collections,title',
                'description'   => 'nullable',
                'image'         => 'required|image|mimes:jpeg,png,jpg,webp|max:4096', 
            ]
        );

        DB::beginTransaction();
        try {
            $collection                = new Collection();

            $collection->title         = $request->title;
            $collection->slug          = Str::slug($request->title);
            $collection->description   = $request->description;
            $collection->status        = 1;
    
            // Handle image with ImageUploadTraits function
            $uploadImage               = $this->imageUpload($request, 'image', 'collection');
            $collection->image         =  $uploadImage;
            $collection->save();

            if ($request->has('name') && $request->has('qty')) {
                foreach ($request->name as $index => $name) {
                    ProductCollection::create([
                        'collect_id' => $collection->id,
                        'product_id' => $request->product_id[$index],
                        'name'       => $name,
                        'qty'        => $request->qty[$index],
                    ]);
                }
            }
        }
        catch(Exception $ex){
            DB::rollBack();
            // throw $ex;
            Toastr::error('Collection create error', 'Error', ["positionClass" => "toast-top-right"]);
        }

        DB::commit();
        Toastr::success('Collection Create Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.product.collection.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!$this->user || !$this->user->can('update.product.collection')) {
            throw UnauthorizedException::forPermissions(['update.product.collection']);
        }

        $productCollections = ProductCollection::
                    leftJoin('collections', 'collections.id', 'product_collections.collect_id')
                    ->leftJoin('products', 'products.id', 'product_collections.product_id')
                    ->select('product_collections.*', 'products.thumb_image', 'products.slug')
                    ->where('product_collections.collect_id', $id)
                    ->get();

        $collection = Collection::where('id', $id)->first();
        $products = Product::where('is_approved', 1)->where('status', 1)->where('qty', '>', 0)->get();
        return view('backend.pages.product_collection.edit', compact('products', 'collection', 'productCollections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!$this->user || !$this->user->can('update.product.collection')) {
            throw UnauthorizedException::forPermissions(['update.product.collection']);
        }

        $collection                = Collection::find($id);
        $request->validate(
            [
                'title'         => 'required|string|max:255|unique:collections,title,' .$collection->id,
                'description'   => 'nullable',
                'image'         => 'image|mimes:jpeg,png,jpg,webp|max:4096', 
            ]
        );
         DB::beginTransaction();
         try { 
             $collection->title         = $request->title;
             $collection->slug          = Str::slug($request->title);
             $collection->description   = $request->description;
             $collection->status        = 1;
     
             // Handle image with ImageUploadTraits function
             $uploadImage               = $this->deleteImageAndUpload($request, 'image', 'collection', $collection->image );
             $collection->image         =  $uploadImage;
             $collection->save();
 
             if ($request->has('name') && $request->has('qty')) {
                foreach ($request->name as $index => $name) {
                    $productId = $request->product_id[$index];
                    $qty = $request->qty[$index];
            
                    // Find existing record using collect_id and product_id
                    $productCollection = ProductCollection::where('collect_id', $collection->id)
                        ->where('product_id', $productId)
                        ->first();
            
                    if ($productCollection) {
                        // Update existing record
                        $productCollection->update([
                            'name' => $name,
                            'qty'  => $qty,
                        ]);
                    } else {
                        // Create a new record if it doesn't exist
                        ProductCollection::create([
                            'collect_id' => $collection->id,
                            'product_id' => $productId,
                            'name'       => $name,
                            'qty'        => $qty,
                        ]);
                    }
                }
            }
         }
         catch(Exception $ex){
             DB::rollBack();
             throw $ex;
             Toastr::error('Collection Update error', 'Error', ["positionClass" => "toast-top-right"]);
         }
 
         DB::commit();
         Toastr::success('Collection Update Successfully', 'Success', ["positionClass" => "toast-top-right"]);
         return redirect()->route('admin.product.collection.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!$this->user || !$this->user->can('delete.product.collection')) {
            throw UnauthorizedException::forPermissions(['delete.product.collection']);
        }

        $collection = Collection::find($id);

        if ( !empty($collection->image) ) {
            if (file_exists($collection->image)) {
                @unlink($collection->image);
            }
        }

        $collection->delete();

        $productCollections = ProductCollection::where('collect_id', $id)->get();
        foreach( $productCollections as $item ){
            $item->delete();
        }

        Toastr::success('Product Collection deleted successfully.', 'Success', ["positionClass" => "toast-top-right"]);
        return response()->json(['message' => 'Collection has been deleted.'], 200);
        
    }

    public function productCollectionDelete(Request $request)
    {
        // dd($request->all());
        $productCollection = ProductCollection::where('id', $request->id)->first();
        if( !is_null( $productCollection ) ){
            $productCollection->delete();
        }

       return response()->json([
            'status' => true,
            'message' => "Product Collection Remove",
       ]);
    }

}

