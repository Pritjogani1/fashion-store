<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use App\Models\Role;
 use App\Models\Admin;
 use Illuminate\Support\Facades\Hash;
 
 class AuthAdminController extends Controller
 {
     /**
      * Display a listing of the resource.
      */
     public function index()
     {
         $admins = Admin::with('role')->paginate(5);
         return view('admin.auth-admin.index', compact('admins'));
     }
 
     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         $roles = Role::all();
         return view('admin.auth-admin.create', compact('roles'));
     }
 
     /**
      * Store a newly created resource in storage.
      */
     public function store(Request $request)
     {

         try {
             
     
             $admin = Admin::create([
                 'name' => $request['name'],
                 'email' => $request['email'],
                 'role_id' => $request['role'],
                 'password' =>  bcrypt($request['password'])
             ]);
           
        

             return redirect()->route('admin.admins.index')
                 ->with('success', 'Admin created successfully');
         } catch (\Exception $e) {
            dd($e);
             return redirect()->back()
                 ->withInput()
                 ->with('error', 'Failed to create admin: ' . $e->getMessage());
         }
     }
 
     /**
      * Show the form for editing the specified resource.
      */
     public function edit(Admin $admin)
     {
         $roles = Role::all();
         return view('admin.auth-admin.edit', compact('admin', 'roles'));
     }
 
     /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, Admin $admin)
     {
         try {
          
      
             $admin->update([
                 'name' => $request['name'],
                 'email' => $request['email'],
                 'role_id' => $request['role'],
                 'password' => bcrypt($request['password']),
             ]);
 
             return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully');
         } catch (\Exception $e) {
             return back()->withInput()->with('error', 'Failed to update admin: ' . $e->getMessage());
         }
     }
 
     /**
      * Remove the specified resource from storage.
      */
     public function destroy(Admin $admin)
     {
         try {
         
             $admin->delete();
             return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully');
         } catch (\Exception $e) {
             return back()->with('error', 'Failed to delete admin: ' . $e->getMessage());
         }
     }
 }