<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateChildCategoryRequest;
use App\Http\Requests\Admin\UpdateChildCategoryRequest;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;


class ChildCategoryController extends Controller
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
        $categories = Category::where('status', 1)->get();
        $subCategories = Subcategory::where('status', 1)->get();
        // dd($categories);
        return view('backend.pages.childCategories.index', compact('categories', 'subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getData()
    {
        // get all data
        $childCategories= ChildCategory::join('categories', 'child_categories.category_id', '=', 'categories.id')->join('subcategories', 'child_categories.subCategory_id', '=', 'subcategories.id')
            ->select('categories.category_name', 'subcategories.subcategory_name', 'child_categories.name', 'child_categories.*')
            ->get();

        return DataTables::of($childCategories)
            ->addIndexColumn()
            ->addColumn('childCategoryImg', function ($childCategory) {
                return '<a href="'.asset( $childCategory->img ).'" target="__blank">
                    <img src="'.asset( $childCategory->img ).'" width="50px" height="50px">
                </a>';
            })
            ->addColumn('status', function ($childCategory) {
                if(auth("admin")->user()->can("status.childcategory"))
                    if ($childCategory->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$childCategory->id.'" data-status="'.$childCategory->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$childCategory->id.'" data-status="'.$childCategory->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })

            ->addColumn('action', function ($childCategory) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$childCategory->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.childcategory"))
                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$childCategory->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("delete.childcategory"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$childCategory->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['childCategory' => $childCategory]);
                return $actionHtml;
            })
            ->rawColumns(['childCategoryImg','status','action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateChildCategoryRequest $request)
    {   
        if (!$this->user || !$this->user->can('create.childcategory')) {
            throw UnauthorizedException::forPermissions(['create.childcategory']);
        }

        DB::beginTransaction();
        try {

            $childCategory = new ChildCategory();

            $childCategory->category_id            = $request->category_id;
            $childCategory->subCategory_id         = $request->subCategory_id;
            $childCategory->name                   = $request->name;
            $childCategory->slug                   = Str::slug($request->name);
            $childCategory->status                 = $request->status;

            // Handle image with ImageUploadTraits function
            $uploadImage                           = $this->imageUpload($request, 'img', 'childCategory');
            $childCategory->img                    =  $uploadImage;
            // dd($childCategory);
            $childCategory->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return response()->json(['message'=> "Successfully ChildCategory Created!", 'status' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function changeChildCategoryStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.childcategory')) {
            throw UnauthorizedException::forPermissions(['status.childcategory']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = ChildCategory::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChildCategory $childCategory)
    {
        if (!$this->user || !$this->user->can('update.childcategory')) {
            throw UnauthorizedException::forPermissions(['update.childcategory']);
        }
        // dd($childCategory);
        return response()->json(['success' => $childCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildCategoryRequest $request, string $id)
    {
        if (!$this->user || !$this->user->can('update.childcategory')) {
            throw UnauthorizedException::forPermissions(['update.childcategory']);
        }

        $childCategory = ChildCategory::find($id);

        DB::beginTransaction();
        try {
            $childCategory->category_id            = $request->category_id;
            $childCategory->subCategory_id         = $request->subCategory_id;
            $childCategory->name                   = $request->name;
            $childCategory->slug                   = Str::slug($request->name);
            $childCategory->status                 = $request->status;

            // Handle image with ImageUploadTraits function
            $uploadImages                          = $this->deleteImageAndUpload($request, 'img', 'childCategory', $childCategory->img );
            $childCategory->img                    =  $uploadImages;
            $childCategory->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return response()->json(['message'=> "success"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChildCategory $childCategory)
    {
        if (!$this->user || !$this->user->can('delete.childcategory')) {
            throw UnauthorizedException::forPermissions(['delete.childcategory']);
        }

        if ($childCategory->img) {
            if (file_exists($childCategory->img)) {
                unlink($childCategory->img);
            }
        }
        $childCategory->delete();
        return response()->json(['message' => 'ChildCategory has been deleted.'], 200);
    }

    public function childSubCategoryView($id)
    {
        $childCategory= 
                    ChildCategory::join('categories', 'child_categories.category_id', '=', 'categories.id')->join('subcategories', 'child_categories.subCategory_id', '=', 'subcategories.id')
                    ->select('categories.category_name', 'subcategories.subcategory_name', 'child_categories.*')
                    ->where('child_categories.id', $id)
                    ->first();
        // dd($childCategory);

        $statusHtml = '';
        if ($childCategory->status === 1) {
            $statusHtml = '<span class="text-success">Active</span>';
        } else {
            $statusHtml = '<span class="text-danger">Inactive</span>';
        }

        $created_date = date('d F, Y H:i:s A', strtotime($childCategory->created_at));
        $updated_date = date('d F, Y H:i:s A', strtotime($childCategory->updated_at));

        return response()->json([
            'success'           => $childCategory,
            'statusHtml'        => $statusHtml,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }

    public function get_subCategory_data(Request $request)
    {
        // dd($request->all());
        $subCategories = Subcategory::where('category_id', $request->id)->where('status', 1)->get();
        return response()->json(['status' => true, 'data' => $subCategories]);
    }
}
