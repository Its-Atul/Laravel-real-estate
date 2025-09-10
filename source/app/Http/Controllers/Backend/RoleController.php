<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function AllPermission()
    {

        try {
                $permissions = Permission::orderBy('id', 'desc')->get();
                return view('backend.pages.permission.all_permission', compact('permissions'));
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AddPermission()
    {

        try {

            return view('backend.pages.permission.add_permission');

        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    } // End Method

    public function StorePermission(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'group_name' => 'required|string|max:255',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.unique' => 'The name has already been taken.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'group_name.required' => 'The group name field is required.',
            'group_name.string' => 'The group name must be a string.',
            'group_name.max' => 'The group name may not be greater than 255 characters.',
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            $permission = Permission::create([
                'name' => $request->name,
                'group_name' => $request->group_name,
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Permission Created Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.permission')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function EditPermission($encryptedId)
    {
        try{
            $id = decrypt($encryptedId);
            $permission = Permission::findOrFail($id);
            return view('backend.pages.permission.edit_permission', compact('permission'));

        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function UpdatePermission(Request $request)
    {
        $per_id = $request->id;

        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $per_id,
            'group_name' => 'required|string|max:255',
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',
            'group_name.required' => 'The group name field is required.',
            'group_name.string' => 'The group name must be a string.',
            'group_name.max' => 'The group name may not be greater than 255 characters.',
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            Permission::findOrFail($per_id)->update([
                'name' => $request->name,
                'group_name' => $request->group_name,
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Permission Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.permission')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }



    public function DeletePermission($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            // Start a database transaction
            DB::beginTransaction();

            // Find and delete the permission
            Permission::findOrFail($id)->delete();

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Permission Deleted Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function ImportPermission()
    {

        try{

            return view('backend.pages.permission.import_permission');

        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function Import(Request $request)
    {
        try{
                Excel::import(new PermissionImport, request()->file('import_file'));

                $notification = array(
                    'message' => 'Permission Imported Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function Export()
    {
        try{
            return Excel::download(new PermissionExport, 'permission.xlsx');

        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

    } // End Method

    /////////// Role ALL Method ///////////////


    public function AllRoles()
    {

        try{
            $roles = Role::all();
            return view('backend.pages.roles.all_roles', compact('roles'));
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method



    public function AddRoles()
    {
        try{

            return view('backend.pages.roles.add_roles');

        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function StoreRoles(Request $request)
    {
        try {
            // Validation rules
            $request->validate([
                'name' => 'required|string|max:255|unique:roles',
            ], [
                'name.required' => 'The role name field is required.',
                'name.string' => 'The role name must be a string.',
                'name.max' => 'The role name may not be greater than 255 characters.',
                'name.unique' => 'The role name has already been taken.',
            ]);

            // Start a database transaction
            DB::beginTransaction();

            // Create a new role
            Role::create([
                'name' => $request->name,
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Role Created Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.roles')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function EditRoles($encryptedId)
    {
        $id = decrypt($encryptedId);
        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles', compact('roles'));
    } // End Method


    public function UpdateRoles(Request $request)
    {
        try {
            // Validation rules
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $request->id,
            ], [
                'name.required' => 'The role name field is required.',
                'name.string' => 'The role name must be a string.',
                'name.max' => 'The role name may not be greater than 255 characters.',
                'name.unique' => 'The role name has already been taken.',
            ]);

            // Start a database transaction
            DB::beginTransaction();

            $role_id = $request->id;

            // Update the role
            Role::findOrFail($role_id)->update([
                'name' => $request->name,
            ]);

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Role Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.roles')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function DeleteRoles($encryptedId)
    {
        try {
            $id = decrypt($encryptedId);
            // Start a database transaction
            DB::beginTransaction();

            // Find the role by ID and delete it
            Role::findOrFail($id)->delete();

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Role Deleted Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    /////////// Add Role Permission all Method ////////////


    public function AddRolesPermission()
    {
        try {
            $roles = Role::all();
            $permissions = Permission::all();
            $permission_groups = User::getpermissionGroups();
            return view('backend.pages.rolesetup.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
        } catch (\Exception $e) {

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function RolePermissionStore(Request $request)
    {
        try {
        // Validate the incoming request
        $request->validate([
            'role_id' => 'required',
            'permission' => 'required|array',
            'permission.*' => 'exists:permissions,id',
        ], [
            'role_id.required' => 'The role ID field is required.',
            'permission.required' => 'At least one permission is required.',
            'permission.array' => 'Invalid data format for permissions.',
            'permission.*.exists' => 'One or more selected permissions are invalid.',
        ]);


            // Start a database transaction
            DB::beginTransaction();

            $data = [];
            $permissions = $request->permission;

            foreach ($permissions as $key => $item) {
                $data['role_id'] = $request->role_id;
                $data['permission_id'] = $item;
                DB::table('role_has_permissions')->insert($data);
            } // end foreach

            // Commit the transaction
            DB::commit();

            $notification = [
                'message' => 'Role Permission Added Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('all.roles.permission')->with($notification);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method



    public function AllRolesPermission()
    {
        try {
            // Fetch all roles
            $roles = Role::all();

            // Return the view with roles
            return view('backend.pages.rolesetup.all_roles_permission', compact('roles'));
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AdminEditRoles($encryptedId)
    {
        try {
            $id = decrypt($encryptedId);
            // Find the role by ID
            $role = Role::findOrFail($id);

            // Get all permissions and permission groups
            $permissions = Permission::all();
            $permission_groups = User::getpermissionGroups();

            // Return the view with role, permissions, and permission groups
            return view('backend.pages.rolesetup.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method


    public function AdminRolesUpdate(Request $request, $id)
    {
        try {
            // Validate the request
            $request->validate([
                'permission' => 'array',
                'permission.*' => [
                    'required',
                    Rule::in(Permission::pluck('id')->toArray()),
                ],
            ], [
                'permission.array' => 'Invalid permissions format.',
                'permission.*.required' => 'Please select at least one permission.',
                'permission.*.in' => 'Invalid permission selected.',
            ]);

            // Find the role by ID
            $role = Role::findOrFail($id);

            // Get permissions from the request
            $permissions = $request->permission;

            // Sync the permissions to the role
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }

            // Set success notification
            $notification = [
                'message' => 'Role Permission Updated Successfully',
                'alert-type' => 'success'
            ];

            // Redirect with success notification
            return redirect()->route('all.roles.permission')->with($notification);
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

    public function AdminDeleteRoles($encryptedId)
    {
        try {

            $id = decrypt($encryptedId);
            // Find the role by ID
            $role = Role::findOrFail($id);

            // Check if the role is not null and then delete
            if (!is_null($role)) {
                $role->delete();
            }

            // Set success notification
            $notification = [
                'message' => 'Role Permission Deleted Successfully',
                'alert-type' => 'success'
            ];

            // Redirect with success notification
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            // Handle the exception, you might want to log it or provide a generic error message
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    } // End Method

}
