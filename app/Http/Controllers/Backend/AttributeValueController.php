<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeName;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AttributeValueController extends Controller
{
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
        if (!$this->user || !$this->user->can('index.attribute')) {
            throw UnauthorizedException::forPermissions(['index.attribute']);
        }

        return view('backend.pages.attribute.attribute_values');
    }

    public function getData()
    {
        // get all data
        $attrValues = AttributeValue::get();

        return DataTables::of($attrValues)
            ->addIndexColumn()
            ->addColumn('attribute', function ($attrValue) {
                return '<span class="btn btn-dark">'. $attrValue->attribute .'</span>';
            })
            ->addColumn('color_value', function ($attrValue) {
                if ($attrValue->attribute === 'color') {
                    return '<div class="d-flex gap-2 align-items-center">
                            <div class="circle_rounded" style="background:'. $attrValue->color_value .'"></div>
                            <span class="text-dark">' . $attrValue->color_value . '</span>
                        </div>
                    ';
                } else {
                    return '<span class="btn btn-danger">N/A</span>';
                }
            })
            ->addColumn('value', function ($attrValue) {
                return '<span class="btn btn-secondary">'. $attrValue->value .'</span>';
            })
            ->addColumn('status', function ($attrName) {
                if(auth("admin")->user()->can("status.attribute"))
                    if ($attrName->status == 1) {
                        return ' <a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$attrName->id.'" data-status="'.$attrName->status.'"> <i
                                class="fa-solid fa-toggle-on fa-2x"></i>
                        </a>';
                    } else {
                        return '<a class="status" id="status" href="javascript:void(0)"
                            data-id="'.$attrName->id.'" data-status="'.$attrName->status.'"> <i
                                class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                        </a>';
                    }
                else{
                    return '<span class="badge bg-info">N/A</span>'; 
                }
            })
            ->addColumn('action', function ($attrName) {
                $actionHtml = Blade::render('
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Actions <i class="mdi mdi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu dropdownmenu-primary" style="">
                            <a class="dropdown-item text-info" id="viewButton" href="javascript:void(0)" data-id="'.$attrName->id.'" data-bs-toggle="modal" data-bs-target="#viewModal">
                                <i class="fas fa-eye"></i> View
                            </a>

                            @if(auth("admin")->user()->can("update.attribute"))
                                <a class="dropdown-item text-success" id="editButton" href="javascript:void(0)" data-id="'.$attrName->id.'" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif

                            @if(auth("admin")->user()->can("delete.attribute"))
                                <a class="dropdown-item text-danger" href="javascript:void(0)" data-id="'.$attrName->id.'" id="deleteBtn">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            @endif
                        </div>
                    </div>
                ', ['attrName' => $attrName]);
                return $actionHtml;
            })
            ->rawColumns(['attribute', 'color_value', 'value', 'status', 'action'])
            ->make(true);
    }

    public function changeStatus(Request $request)
    {
        if (!$this->user || !$this->user->can('status.attribute')) {
            throw UnauthorizedException::forPermissions(['status.attribute']);
        }

        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = AttributeValue::findOrFail($id);
        $page->status = $status;
        $page->save();

        //Debugged this code --> return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
        return response()->json(['message' => 'success', 'status' => $status, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->user || !$this->user->can('create.attribute')) {
            throw UnauthorizedException::forPermissions(['create.attribute']);
        }

        $request->validate(
            [
                'color_value' => ['nullable'],
                'value' => ['required', 'max:255', 'unique:attribute_values,value' ],
            ],
            [
                'value.required' => 'Please fill up the value',
                'value.max' => 'Character might be 255 word',
                'value.unique' => 'Character might be unique',
            ]
        );

        DB::beginTransaction();
        try {
            $attributeValue = new AttributeValue();

            $attributeValue->attribute             = $request->attribute;
            if( $request->attribute === 'color' ){
                $attributeValue->color_value	    = $request->color_value;
            }
            else{
                $attributeValue->color_value	    = null;
            }
            $attributeValue->value          	    = convertToSlug($request->value);
            $attributeValue->status                 = 1;
            // dd($attributeValue);
            $attributeValue->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Attribute Value Created!", 'status' => true]);
    }


    public function edit(AttributeValue $attributeValue)
    {
        if (!$this->user || !$this->user->can('update.attribute')) {
            throw UnauthorizedException::forPermissions(['update.attribute']);
        }

        // dd($attributeValue);
        return response()->json(['success' => $attributeValue]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!$this->user || !$this->user->can('update.attribute')) {
            throw UnauthorizedException::forPermissions(['update.attribute']);
        }

        $attributeValue  = AttributeValue::find($id);
        // dd($request->all(), $attributeValue);

        $request->validate(
            [
                'color_value' => ['nullable'],
                'value' => ['required', 'max:255', 'unique:attribute_values,value,'. $attributeValue->id ],
            ],
            [
                'value.required' => 'Please fill up the value',
                'value.max' => 'Character might be 255 word',
                'value.unique' => 'Character might be unique',
            ]
        );

        DB::beginTransaction();
        try {
            // Handle image with ImageUploadTraits function
            $attributeValue->attribute              = $request->attribute;
            if( $request->attribute === 'color' ){
                $attributeValue->color_value	    = $request->color_value;
            }
            else{
                $attributeValue->color_value	    = null;
            }
            $attributeValue->value          	    = convertToSlug($request->value);
            // dd($attributeValue);
            $attributeValue->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
        return response()->json(['message'=> "success"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeValue $attributeValue)
    {
        if (!$this->user || !$this->user->can('delete.attribute')) {
            throw UnauthorizedException::forPermissions(['delete.attribute']);
        }

        $attributeValue->delete();
        return response()->json(['message' => 'Attribute Value has been deleted.'], 200);
    }


    public function attributeView($id)
    {
        $attributeValue  = AttributeValue::find($id);
        // dd($attributeValue);

        $statusHtml = '';
        if ($attributeValue->status === 1) {
            $statusHtml = '<span class="text-success">Active</span>';
        } else {
            $statusHtml = '<span class="text-danger">Inactive</span>';
        }

        $colorValue = '';
        if (!empty($attributeValue->color_value)) {
            $safeColorValue = htmlspecialchars($attributeValue->color_value, ENT_QUOTES, 'UTF-8');
            $colorValue = '<div class="d-flex gap-2 align-items-center">
                    <div class="circle_rounded" style="background:' . $safeColorValue . '"></div>
                    <span class="text-dark">' . $safeColorValue . '</span>
                </div>';
        } else {
            $colorValue = '<button class="btn btn-danger">N/A</button>';
        }

        $created_date = date('d F, Y H:i:s A', strtotime($attributeValue->created_at));
        $updated_date = date('d F, Y H:i:s A', strtotime($attributeValue->updated_at));

        return response()->json([
            'success'           => $attributeValue,
            'colorValue'       => $colorValue,
            'statusHtml'        => $statusHtml,
            'created_date'      => $created_date,
            'updated_date'      => $updated_date,
        ]);
    }

}
