<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionController extends Controller
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
        if (!$this->user || !$this->user->can('index.permission')) {
            throw UnauthorizedException::forPermissions(['index.permission']);
        }

        return view('backend.pages.role_and_permission.permission.index');
    }

    public function getData()
    {
        // get all data
        $permissions = Permission::all();

        return DataTables::of($permissions)
            ->addColumn('name', function ($permission) {
                return '<span class="badge bg-primary" style="font-size: 14px; padding: 10px 10px;">'. $permission->name .'</span>';
            })
            ->addColumn('group_name', function ($permission) {
                return '<span class="badge bg-success" style="font-size: 14px; padding: 10px 10px;">'. $permission->group_name .'</span>';
            })
            ->addColumn('action', function ($permission) {
                $actionHtml = Blade::render('
                    <div class="d-flex gap-3">
                        @if(auth("admin")->user()->can("update.permission"))
                            <a class="btn btn-sm btn-primary" id="editButton" href="javascript:void(0)" data-id="'.$permission->id.'" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i></a>
                        @endif

                        @if(auth("admin")->user()->can("delete.permission"))
                            <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-id="'.$permission->id.'" id="deleteBtn"> <i class="fas fa-trash"></i></a>
                        @endif
                    </div>
            ', ['permission' => $permission]);
            return $actionHtml;
            })
            ->rawColumns(['name', 'group_name', 'action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->user || !$this->user->can('create.permission')) {
            throw UnauthorizedException::forPermissions(['create.permission']);
        }

        $request->validate(
            [
                'name' => ['required', 'unique:permissions,name', 'max:255'],
                'group_name' => ['required', 'max:255'],
            ],
            [
                'name.required' => 'Please fill up the name',
                'name.max' => 'Character might be 255',
                'name.unique' => 'Character might be unique',
                'group_name.required' => 'Group Name Required',
                'group_name.max' => 'Group Name character might be 255',
            ]
        );

        DB::beginTransaction();
        try {
            Permission::create([
                'name'       => convertToSlugDot(strtolower($request->name)),
                'group_name' => strtolower($request->group_name),
                'guard_name' => "admin"
            ]);
        }
        catch(\Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        DB::commit();
        return response()->json(['message'=> "Successfully Permission Created!", 'status' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        if (!$this->user || !$this->user->can('update.permission')) {
            throw UnauthorizedException::forPermissions(['update.permission']);
        }

        // dd($permission);
        return response()->json(['success' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        if (!$this->user || !$this->user->can('update.permission')) {
            throw UnauthorizedException::forPermissions(['update.permission']);
        }

        $request->validate(
            [
                'name' => ['required', 'unique:permissions,name,'. $permission->id , 'max:255'],
                'group_name' => ['required', 'max:255'],
            ],
            [
                'name.required' => 'Please fill up the name',
                'name.max' => 'Character might be 255 word',
                'name.unique' => 'Character might be unique',
                'group_name.required' => 'Group Name Required',
                'group_name.max' => 'Group Name character might be 255',
            ]
        );

        DB::beginTransaction();
        try {
            $permission->update([
                'name'       => convertToSlugDot(strtolower($request->name)),
                'group_name' => strtolower($request->group_name),
                'guard_name' => "admin"
            ]);
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
    public function destroy(Permission $permission)
    {
        if (!$this->user || !$this->user->can('delete.permission')) {
            throw UnauthorizedException::forPermissions(['delete.permission']);
        }

        $permission->delete();
        return response()->json(['message' => 'Permission has been deleted.'], 200);
    }

}
