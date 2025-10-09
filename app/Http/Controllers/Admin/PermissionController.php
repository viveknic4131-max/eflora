<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class PermissionController extends Controller
{
     public function index(Request $request)
    {
          $perPage = $request->get('perPage', 2);
        $permissions = Permission::orderBy('id','desc')->paginate($perPage);
        return view('pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('pages.permissions.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate(['name' => 'required|unique:permissions,name']);
    //     Permission::create(['name' => $request->name]);
    //     return redirect()->route('permissions.index')->with('success', 'Permission created.');
    // }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:permissions,name',
        'guard' => 'required|in:web,api',
    ]);

    try {
        Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index')
                         ->with('success', 'Permission created successfully.');

    } catch (QueryException $e) {
        Log::error('Permission creation failed: '.$e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Database error. Try again.');
    } catch (\Exception $e) {
        Log::error('Unexpected error: '.$e->getMessage());
        return redirect()->back()->withInput()->with('error', 'Something went wrong.');
    }
}

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('pages.permissions.index')->with('success', 'Permission deleted.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function assignToRole(Request $request, Permission $permission)
    {
        $request->validate(['role' => 'required|exists:roles,name']);
        $permission->assignRole($request->role);
        return back()->with('success', 'Permission assigned to role.');
    }

}
