<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User; // Add this import
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class AdminController extends Controller
{

    public function index() {
        return view("admin.admin-loginpage");
    }
    public function dashboard() {
        return view("admin.admin");
    }

    public function authenticate(Request $request) {
  
       
            $credentials = $request->only(["email", "password"]);
            
            if(Auth::guard("admin")->attempt($credentials)) {
               
                $request->session()->regenerate();
                return redirect(route("admin.dashboard"));
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
            }

            public function logout() {
                Auth::guard("admin")->logout();
                return redirect(route("admin.login"));
            }
public function customers()
{
    $users = User::all();
    $users = User::paginate(5);
    return view('admin.admin-customers', compact('users'));
}

public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.customers')->with('success', 'Customer deleted successfully');
}

public function editUser($id)
{
    $user = User::findOrFail($id);
    return view('admin.admin-edituser', compact('user'));
}

public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);
    
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'nullable'
    ]);

    $user->update($validatedData);
    return redirect()->route('admin.customers')->with('success', 'Customer updated successfully');
}

public function orders()
{
   
    $orders = Order::with(['user', 'items'])->latest()->get();
    
    return view('admin.admin-orders', compact('orders'));
}

public function orderDetails(Order $order)
{
    $order->load(['user', 'items']);
    return view('admin.order-details', compact('order'));
}

public function updateOrderStatus(Request $request, $orderId)
{
    $order = Order::findOrFail($orderId);
    $order->update(['status' => $request->status]);
    
    return response()->json([
        'success' => true,
        'message' => 'Order status updated successfully'
    ]);
}
}
