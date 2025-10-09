<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $permissions = Role::with('permissions')->paginate(2);
        return view('pages.roles.index', compact('permissions'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy(function($perm){
            return explode('.', $perm->name)[0]; // group by module prefix
        });
        return view('pages.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(['name' => 'required|unique:roles,name']);
        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permissions ?? []);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function($perm){
            return explode('.', $perm->name)[0];
        });
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions ?? []);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success','Role deleted');
    }

    public function show(string $id)
    {
        //
    }
}
