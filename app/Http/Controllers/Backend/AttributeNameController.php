<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AttributeNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.attribute.attribute_name');
    }

    public function getData()
    {
        // get all data
        $attrNames= AttributeName::all();

        return DataTables::of($attrNames)
            ->addColumn('name', function ($attrName) {
                return '<span class="btn btn-info">'. $attrName->name .'</span>';
            })
            ->addColumn('status', function ($attrName) {
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
            })

            ->addColumn('action', function ($attrName) {
                return '<div class="d-flex gap-3">
                    <a class="btn btn-sm btn-primary" id="editButton" href="javascript:void(0)" data-id="'.$attrName->id.'" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></a>

                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-id="'.$attrName->id.'" id="deleteBtn"> <i class="fas fa-trash"></i></a>
                </div>';
            })

            ->rawColumns(['name', 'status', 'action'])
            ->make(true);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $Current_status = $request->status;

        if ($Current_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $page = AttributeName::findOrFail($id);
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
        $request->validate(
            [
                'name' => ['required', 'unique:attribute_names,name', 'max:255'],
            ],
            [
                'name.required' => 'Please fill up the name',
                'name.max' => 'Character might be 255 word',
                'name.unique' => 'Character might be unique',
            ]
        );

        DB::beginTransaction();
        try {

            $attributeName = new AttributeName();

            $attributeName->name                   = Str::title($request->name);
            $attributeName->status                 = 1;

            // dd($category);
            $attributeName->save();
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
            // dd($ex->getMessage());
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Attribute Name Created!", 'status' => true]);
    }


    public function edit(AttributeName $attributeName)
    {
        // dd($attributeName);
        return response()->json(['success' => $attributeName]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attributeName  = AttributeName::find($id);

        // dd($attributeName);

        $request->validate(
            [
                'name' => ['required', 'max:255', 'unique:attribute_names,name,'. $attributeName->id ],
            ],
            [
                'name.required' => 'Please fill up the name',
                'name.max' => 'Character might be 255 words',
                'name.unique' => 'Character might be unique',
            ]
        );

        DB::beginTransaction();
        try {
            // Handle image with ImageUploadTraits function
            $attributeName->name                   = Str::title($request->name);
            $attributeName->status                 = 1;

            $attributeName->save();
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
    public function destroy(AttributeName $attributeName)
    {
        $attributeName->delete();

        return response()->json(['message' => 'Attribute Name has been deleted.'], 200);
    }

}
