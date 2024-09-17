<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('View Role', Auth::user());
        $user = Auth::user();
        if($user->hasRole('Super Admin'))
        {
            $roles = Role::get();
        }
        else
        {
            $roles = Role::where('id','!=', 1)->get();
        }
        $data['roles'] = $roles;
        $data['title'] = "List Role";
        return view('role.index', $data);
    }

    public function create()
    {
        $this->authorize('Create Role', Auth::user());
        $permissionGroups = PermissionGroup::with('permissions')->get();
        $data['title'] = "Create Role";
        $data['permissionGroups'] = $permissionGroups;
        return view('role.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('Create Role', Auth::user());
        try
        {
            DB::transaction(function () use ($request)
            {
                $role = Role::create(['name' => $request->name]);

                $permissionsArray = [];
                if (isset($request->permissions))
                {
                    $permissionsArray = $request->permissions;
                }
                $permissions = Permission::whereIn('id', $permissionsArray)->get();
                $role->syncPermissions($permissions);
            });

            return redirect()->route('role.index')->withSuccess('Create role success');
        }
        catch (\Exception $e)
        {
            $message = $e->getMessage();
			if (isset($e->errorInfo[2]))
			{
				$message = $e->errorInfo[2];
			}
			return redirect()->back()->withError($message);
        }
    }

    public function edit($id)
    {
        $this->authorize('Edit Role', Auth::user());
        $role = Role::with('permissions')->find($id);
        $permissionGroups = PermissionGroup::with('permissions')->get();
        $data['title'] = "Edit Role";
        $data['role'] = $role;
        $data['permissionGroups'] = $permissionGroups;
        return view('role.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->authorize('Edit Role', Auth::user());
        try
        {
            DB::transaction(function () use ($request, $id)
            {
                $role = Role::find($id);
                $role->name = $request->name;
                $role->save();

                $permissionsArray = [];
                if (isset($request->permissions))
                {
                    $permissionsArray = $request->permissions;
                }
                $permissions = Permission::whereIn('id', $permissionsArray)->get();
                $role->syncPermissions($permissions);
            });

            return redirect()->route('role.index')->withSuccess('Update role success');
        }
        catch (\Exception $e)
        {
            $message = $e->getMessage();
			if (isset($e->errorInfo[2]))
			{
				$message = $e->errorInfo[2];
			}
			return redirect()->back()->withError($message);
        }
    }

    public function destroy($id)
    {
        $this->authorize('Delete Role', Auth::user());
        $role = Role::find($id);
        foreach ($role->permissions as $permission )
        {
            $permission->removeRole($role);
        }
        $role->delete();

        return redirect()->back()->withSuccess('Delete role success');
    }
}
