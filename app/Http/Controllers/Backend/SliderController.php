<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateSliderRequest;
use App\Http\Requests\Admin\UpdateSliderRequest;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class SliderController extends Controller
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
        return view('backend.pages.slider.index');
    }

    public function getData()
    {
        // get all data
        $sliders= Slider::all();

        return DataTables::of($sliders)
            ->addIndexColumn()
            ->addColumn('slider_image', function ($slider) {
                return '<a href="'. asset( $slider->slider_image ) .'" target="__blank">
                     <img src="'. asset( $slider->slider_image ) .'" width="75px">
                    </a>';
            })
            // ->addColumn('type', function ($slider) {
            //     if( !is_null($slider->type) ){
            //         return '<span class="badge bg-primary">'. $slider->type .'</span>';
            //     }
            //     else{
            //         return '<span class="badge bg-primary">N/A</span>';
            //     }
            // })
            ->addColumn('title', function ($slider) {
                return '<span class="badge bg-primary">'. $slider->title .'</span>';
            })
            // ->addColumn('btn_url', function ($slider) {
            //     if( !is_null($slider->starting_price) ){
            //          return '<span class="badge bg-info">'. $slider->btn_url .'</span>';
            //     }
            //     else{
            //         return '<span class="badge bg-info">N/A</span>';
            //     }
            // })
            ->addColumn('starting_price', function ($slider) {
                if( !is_null($slider->starting_price) ){
                    return '<span class="badge bg-success">'. $slider->starting_price .' TK</span>';
                }
                else{
                    return '<span class="badge bg-success">N/A</span>';
                }
            })
            // ->addColumn('serial', function ($slider) {
            //     if( !is_null($slider->serial) ){
            //         return '<span class="badge bg-success">'. $slider->serial .' TK</span>';
            //     }
            //     else{
            //         return '<span class="badge bg-success">N/A</span>';
            //     }
            // })
            ->addColumn('status', function ($slider) {
                if(auth("admin")->user()->can("status.slider"))
                {
                    if ($slider->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$slider->id.'" data-status="'.$slider->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$slider->id.'" data-status="'.$slider->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($slider) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$slider->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.slider"))
                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$slider->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("delete.slider"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$slider->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['slider' => $slider]);
                return $actionHtml;
            })
            ->rawColumns(['slider_image', 'starting_price', 'title', 'status','action'])
            ->make(true);
    }

    public function changeSliderStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.slider')) {
            throw UnauthorizedException::forPermissions(['status.slider']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = Slider::findOrFail($id);
        $page->status = $status;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSliderRequest $request)
    {
        if (!$this->user || !$this->user->can('create.slider')) {
            throw UnauthorizedException::forPermissions(['create.slider']);
        }

        DB::beginTransaction();
        try {
            $slider = new Slider();

            $slider->title                  = $request->title;
            $slider->type                   = $request->type;
            $slider->starting_price         = $request->starting_price;
            $slider->btn_url                = $request->btn_url;
            $slider->serial                 = Slider::max('serial') ? Slider::max('serial') + 1 : 1;
            $slider->status                 =  $request->status;

            // Handle image with ImageUploadTraits function
            $uploadImage                    = $this->imageUpload($request, 'slider_image', 'slider');
            $slider->slider_image           =  $uploadImage;
            $slider->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Slider Created!", 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        if (!$this->user || !$this->user->can('update.slider')) {
            throw UnauthorizedException::forPermissions(['update.slider']);
        }

        return response()->json(['success' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        if (!$this->user || !$this->user->can('update.slider')) {
            throw UnauthorizedException::forPermissions(['update.slider']);
        }

        $slider =  Slider::find($id);

        DB::beginTransaction();
        try {
            $slider->type                       = $request->type;
            $slider->title                      = $request->title;
            $slider->starting_price             = $request->starting_price;
            $slider->btn_url                    = $request->btn_url;
            // $slider->serial                     = $request->serial;
            $slider->status                     = 1;

            // Handle image with ImageUploadTraits function
            $uploadImages                       = $this->deleteImageAndUpload($request, 'slider_image', 'slider', $slider->slider_image );
            $slider->slider_image               =  $uploadImages;
            $slider->save();
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
    public function destroy(Slider $slider)
    {
        if (!$this->user || !$this->user->can('delete.slider')) {
            throw UnauthorizedException::forPermissions(['delete.slider']);
        }

        if ($slider->slider_image) {
            if (file_exists($slider->slider_image)) {
                unlink($slider->slider_image);
            }
        }
        $slider->delete();
        return response()->json(['message' => 'Slider has been deleted.'], 200);
    }

    public function sliderView($id)
    {
        $slider  = Slider::find($id);

        $statusHtml = '';
        if ($slider->status === 1) {
            $statusHtml = '<span class="text-success">Active</span>';
        } else {
            $statusHtml = '<span class="text-danger">Inactive</span>';
        }

        $created_date = date('d F, Y H:i:s A', strtotime($slider->created_at));
        $updated_date = date('d F, Y H:i:s A', strtotime($slider->updated_at));

        return response()->json([
            'success'           => $slider,
            'statusHtml'        => $statusHtml,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }
}
