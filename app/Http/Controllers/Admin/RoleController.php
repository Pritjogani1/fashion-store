<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(5);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
           
            $request->validate([
                'name' => 'required|string|max:255',
                'permissions' => 'nullable|array', // Make permissions optional
                'permissions.*' => 'exists:permissions,id',
                'is_super_admin' => 'nullable|string|in:yes,no',
                 // Validate each permission ID exists
            ]);
           
           
            // Create the role
            $role = Role::create([
                'name' => $request->name,
                'is_super_admin' => $request->is_super_admin,
            ]);


            // Sync permissions with the role in the pivot table
            if ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            }

            return redirect()->route('admin.role')->with('success', 'Role added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating role: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'permissions' => 'nullable|array',
                'permissions.*' => 'exists:permissions,id',
            ]);

            // Update the role
            
            $role->update([
                'name' => $request->name,
            ]);

            // Sync permissions with the role in the pivot table
            if ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            } else {
                // If no permissions are selected, remove all existing permissions
                $role->permissions()->detach();
            }

            return redirect()->route('admin.role')->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating role: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('admin.role')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the role.'], 500);
        }
    }
}
