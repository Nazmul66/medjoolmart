<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AdminRoleController extends Controller
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
        if (!$this->user || !$this->user->can('index.admin-role')) {
            throw UnauthorizedException::forPermissions(['index.admin-role']);
        }

        $admins = Admin::where('id', '!=', Admin::min('id'))->get();
        return view('backend.pages.role_and_permission.admin.index',[
            "admins" => $admins,
        ]);
    }

    public function create()
    {
        if (!$this->user || !$this->user->can('create.admin-role')) {
            throw UnauthorizedException::forPermissions(['create.admin-role']);
        }

        $roles = Role::where('guard_name', 'admin')->pluck('name', 'name')->all();
        return view('backend.pages.role_and_permission.admin.create',[
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->user || !$this->user->can('create.admin-role')) {
            throw UnauthorizedException::forPermissions(['create.admin-role']);
        }

        // dd($request->all());
        $request->validate(
            [
                'name'     => ['required', 'string', 'unique:admins,name', 'max:255'],
                'email'    => ['required', 'unique:admins,email', 'email', 'max:255'],
                'phone'    => ['required', 'regex:/^[0-9]{11,15}$/'],
                'password' => [
                    $request->isMethod('post') ? 'required' : 'nullable',
                    'string', 
                    'min:8', 
                    'regex:/[a-z]/',    // Must contain at least one lowercase letter
                    'regex:/[A-Z]/',    // Must contain at least one uppercase letter
                    'regex:/[0-9]/',    // Must contain at least one number
                    'regex:/[@$!%*?&#]/' // Must contain a special character
                ],        
                'roles' => [
                    'required', 
                    'array', 
                    'exists:roles,name' // Ensure each role exists in the database
                ],
            ],
            [
                'name.required'     => 'The name field is required.',
                'name.unique'       => 'This name is already in use.',
                'email.required'    => 'The email field is required.',
                'email.email'       => 'Please enter a valid email address.',
                'email.unique'      => 'This email is already in use.',
                'password.required' => 'The password field is required.',
                'password.min'      => 'The password must be at least 8 characters.',
                'password.regex'    => 'The password must include uppercase, lowercase, numbers, and special characters.',
                'roles.required'    => 'Please assign at least one role.',
                'roles.exists'      => 'One or more of the selected roles are invalid.',
            ]
        );

        DB::beginTransaction();
        try {
           $admin =  Admin::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            $admin->syncRoles($request->roles); // sync roles
        }
        catch(\Exception $ex){
            DB::rollBack();
            // throw $ex;
            // dd($ex->getMessage());
            Toastr::error('New Admin create error', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        DB::commit();
        Toastr::success('New Admin create successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.admin-role.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!$this->user || !$this->user->can('update.admin-role')) {
            throw UnauthorizedException::forPermissions(['update.admin-role']);
        }

        $admin     = Admin::findOrFail($id);
        $roles     = Role::where('guard_name', 'admin')->pluck('name', 'name')->all();
        $userRoles = $admin->roles->pluck('name', 'name')->all();
        
        return view('backend.pages.role_and_permission.admin.edit',[
            'admin'     => $admin,
            'roles'     => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!$this->user || !$this->user->can('update.admin-role')) {
            throw UnauthorizedException::forPermissions(['update.admin-role']);
        }

        $request->validate(
            [
                'name'     => ['required', 'string', 'max:255', 'unique:admins,name,' . $id],
                'email'    => ['required', 'email', 'max:255', 'unique:admins,email,' . $id],
                'phone'    => ['required', 'regex:/^[0-9]{11,15}$/'],
                'password' => [
                    $request->isMethod('post') ? 'required' : 'nullable',
                    'string', 
                    'min:8', 
                    'regex:/[a-z]/',    // Must contain at least one lowercase letter
                    'regex:/[A-Z]/',    // Must contain at least one uppercase letter
                    'regex:/[0-9]/',    // Must contain at least one number
                    'regex:/[@$!%*?&#]/' // Must contain a special character
                ],        
                'roles' => [
                    'required', 
                    'array', 
                    'exists:roles,name' // Ensure each role exists in the database
                ],
            ],
            [
                'name.required'     => 'The name field is required.',
                'name.unique'       => 'This name is already in use.',
                'email.required'    => 'The email field is required.',
                'email.email'       => 'Please enter a valid email address.',
                'email.unique'      => 'This email is already in use.',
                'password.required' => 'The password field is required.',
                'password.min'      => 'The password must be at least 8 characters.',
                'password.regex'    => 'The password must include uppercase, lowercase, numbers, and special characters.',
                'roles.required'    => 'Please assign at least one role.',
                'roles.exists'      => 'One or more of the selected roles are invalid.',
            ]
        );

        DB::beginTransaction();
        try {
            $admin = Admin::findOrFail($id);

            // Update admin details
            $admin->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => $request->password ? Hash::make($request->password) : $admin->password, // Update password only if provided
            ]);
 
            $admin->syncRoles($request->roles); // sync roles
        }
        catch(\Exception $ex){
            DB::rollBack();
            // throw $ex;
            // dd($ex->getMessage());
            Toastr::error('Admin updated error', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        DB::commit();
        Toastr::success('Admin updated successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.admin-role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!$this->user || !$this->user->can('delete.admin-role')) {
            throw UnauthorizedException::forPermissions(['delete.admin-role']);
        }

        // dd($id);
        $admin = Admin::findOrFail($id);

        if( !empty($admin->image) ){
            @unlink($admin->image);
        }
        $admin->delete();

        Toastr::success('Admin User delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

}
