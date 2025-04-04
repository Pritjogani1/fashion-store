<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
       
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:permissions,key',
            ]);

            Permission::create([
                'name' => $request->name,
                'key' => $request->slug,
            ]);

            return redirect()->route('admin.permission')->with('success', 'Permission added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the permission.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        try {
            return view('admin.permission.edit', compact('permission'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the permission.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        try {

            
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:permissions,key,' . $permission->id,
            ]);

            $permission->update([
                'name' => $request->name,
                'key' => $request->slug,
            ]);

            return redirect()->route('admin.permission')->with('success', 'Permission updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the permission.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return redirect()->route('admin.permission')->with('success', 'Permission deleted successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the permission.'], 500);
        }
    }
}

?>
