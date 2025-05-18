<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Traits\ImageUploadTraits;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CategoryController extends Controller
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
        return view('backend.pages.categories.index');
    }

    public function getData()
    {
        // get all data
        $categories= Category::all();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('categoryImg', function ($category) {
                return '<a href="'.asset( $category->category_img ).'" target="__target">
                     <img src="'.asset( $category->category_img ).'" width="50px" height="50px" >
                </a>';
            })
            ->addColumn('status', function ($category) {
                if(auth("admin")->user()->can("status.category"))
                    if ($category->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$category->id.'" data-status="'.$category->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$category->id.'" data-status="'.$category->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($category) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$category->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.category"))
                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$category->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("delete.category"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$category->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['category' => $category]);
                return $actionHtml;
            })
            ->rawColumns(['categoryImg', 'status', 'action'])
            ->make(true);
    }

    public function changeCategoryStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.category')) {
            throw UnauthorizedException::forPermissions(['status.category']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Category::findOrFail($id);
        $page->status = $status;
        $page->save();

        //Debugged this code --> return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        if (!$this->user || !$this->user->can('create.category')) {
            throw UnauthorizedException::forPermissions(['create.category']);
        }

        DB::beginTransaction();
        try {

            $category = new Category();
            $category->category_name          = $request->category_name;
            $category->slug                   = Str::slug($request->category_name);
            $category->status                 = $request->status;

            // Handle image with ImageUploadTraits function
            $uploadImage                      = $this->imageUpload($request, 'category_img', 'category');
            $category->category_img           =  $uploadImage;
            $category->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Category Created!", 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (!$this->user || !$this->user->can('update.category')) {
            throw UnauthorizedException::forPermissions(['update.category']);
        }

        // dd($category);
        return response()->json(['success' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        if (!$this->user || !$this->user->can('update.category')) {
            throw UnauthorizedException::forPermissions(['update.category']);
        }

        $category  = Category::find($id);

        DB::beginTransaction();
        try {
            // Handle image with ImageUploadTraits function
            $category->category_name          = $request->category_name;
            $category->slug                   = Str::slug($request->category_name);
            $category->front_status           = $request->front_status;
            $category->status                 = $request->status;

            $uploadImages                     = $this->deleteImageAndUpload($request, 'category_img', 'category', $category->category_img );
            $category->category_img           =  $uploadImages;

            $category->save();
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
    public function destroy(Category $category)
    {
        if (!$this->user || !$this->user->can('delete.category')) {
            throw UnauthorizedException::forPermissions(['delete.category']);
        }

        if ($category->category_img) {
            if (file_exists($category->category_img)) {
                unlink($category->category_img);
            }
        }

        $category->delete();

        return response()->json(['message' => 'Category has been deleted.'], 200);
    }

    public function CategoryView($id)
    {
        $category  = Category::find($id);
        // dd($category);

        $front_status_html = '';
        if ($category->front_status === 1) {
            $front_status_html = '<span class="text-success">Active</span>';
        } else {
            $front_status_html = '<span class="text-danger">Inactive</span>';
        }

        $statusHtml = '';
        if ($category->status === 1) {
            $statusHtml = '<span class="text-success">Active</span>';
        } else {
            $statusHtml = '<span class="text-danger">Inactive</span>';
        }

        $created_date = date('d F, Y H:i:s A', strtotime($category->created_at));
        $updated_date = date('d F, Y H:i:s A', strtotime($category->updated_at));

        return response()->json([
            'success'           => $category,
            'statusHtml'        => $statusHtml,
            'front_status_html' => $front_status_html,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }
}
