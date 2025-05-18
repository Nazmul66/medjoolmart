<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTraits;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CustomPageController extends Controller
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
        return view('backend.pages.custom_pages.index');
    }

    public function create()
    {
        if (!$this->user || !$this->user->can('create.custom.page')) {
            throw UnauthorizedException::forPermissions(['create.custom.page']);
        }

        return view('backend.pages.custom_pages.create');
    }

    public function getData()
    {
        // get all data
        $customPages = CustomPage::all();
        return DataTables::of($customPages)
            ->addIndexColumn()
            ->addColumn('status', function ($customPage) {
                if(auth("admin")->user()->can("status.custom.page"))
                    if ($customPage->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$customPage->id.'" data-status="'.$customPage->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$customPage->id.'" data-status="'.$customPage->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($customPage) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" href="'. route('admin.customPage.show', $customPage->id) .'">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.custom.page"))
                                <a class="dropdown-item text-success" href="'. route('admin.customPage.edit', $customPage->id) .'">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['customPage' => $customPage]);
                return $actionHtml;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function changeCustomPageStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.custom.page')) {
            throw UnauthorizedException::forPermissions(['status.custom.page']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = CustomPage::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->user || !$this->user->can('create.custom.page')) {
            throw UnauthorizedException::forPermissions(['create.custom.page']);
        }

        // dd($request->all());
        $request->validate([
              'title'      => ['required', 'max:155', 'string', 'unique:custom_pages,title'],
              'content'    => ['required'],
              'meta_image' => ['image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ]);

        DB::beginTransaction();
        try {
            $customPage = new CustomPage();

            $customPage->title             = $request->title;
            $customPage->slug              = Str::slug($request->title);
            $customPage->content           = $request->content;
            $customPage->status            = $request->status;
            $customPage->meta_title        = $request->meta_title;
            $customPage->meta_keyword      = $request->meta_keyword;
            $customPage->meta_description  = $request->meta_description;

            // Handle image with ImageUploadTraits function
            $uploadImage                   = $this->imageUpload($request, 'meta_image', 'custom_page');
            $customPage->meta_image        =  $uploadImage;
            $customPage->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
        return redirect()->route('admin.customPage.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomPage $customPage)
    {
        if (!$this->user || !$this->user->can('update.custom.page')) {
            throw UnauthorizedException::forPermissions(['update.custom.page']);
        }
        // dd($customPage);
        return view('backend.pages.custom_pages.edit', compact('customPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!$this->user || !$this->user->can('update.custom.page')) {
            throw UnauthorizedException::forPermissions(['update.custom.page']);
        }

        // dd($request->all());
        $customPage =  CustomPage::find($id);
        $request->validate([
            'title'      => ['required', 'max:155', 'string', 'unique:custom_pages,title,'. $customPage->id],
            'content'    => ['required'],
            'meta_image' => ['image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
        ]);

        DB::beginTransaction();
        try {
            $customPage->title             = $request->title;
            $customPage->slug              = Str::slug($request->title);
            $customPage->content           = $request->content;
            $customPage->status            = $request->status;
            $customPage->meta_title        = $request->meta_title;
            $customPage->meta_keyword      = $request->meta_keyword;
            $customPage->meta_description  = $request->meta_description;

            // Handle image with ImageUploadTraits function
            $uploadImage                   = $this->imageUpload($request, 'meta_image', 'custom_page');
            $customPage->meta_image        =  $uploadImage;
            $customPage->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return redirect()->route('admin.customPage.index');
    }

    public function show($id)
    {
        $singleView = CustomPage::findOrFail($id);
        return view('backend.pages.custom_pages.view', compact('singleView')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomPage $customPage)
    {
        if ($customPage->meta_image) {
            if (file_exists($customPage->meta_image)) {
                unlink($customPage->meta_image);
            }
        }

        $customPage->delete();
        return response()->json(['message' => 'Custom Page has been deleted.'], 200);
    }


}
