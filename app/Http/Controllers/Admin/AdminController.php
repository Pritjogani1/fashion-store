<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User; // Add this import
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{

    public function index() {
        return view("admin.admin-loginpage");
    }
    public function dashboard() {
        try {
            $orders = Order::with(['user', 'items','address'])->latest()->get();
            $totalOrders = Order::count();
            $totalRevenue = Order::where('status', 'delivered')->sum('total');
            $totalCategories = Category::count();
            $totalProducts = Product::count();
            return view("admin.admin", compact('orders', 'totalOrders', 'totalRevenue', 'totalCategories', 'totalProducts'));
        }
        catch(\Exception $e) {
            return back()->withErrors([
                'message' => 'An error occurred while fetching orders.',
            ]);
        }

    }

    public function authenticate(Request $request) {
  
        try {
            $credentials = $request->only(["email", "password"]);
            
            if(Auth::guard("admin")->attempt($credentials)) {
               
                $request->session()->regenerate();
                return redirect(route("admin.dashboard"));
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
        catch(\Exception $e) {
            return back()->withErrors([
                'message' => 'An error occurred while authenticating the user.',
            ]);
        }
            }

            public function logout() {
                try {
                Auth::guard("admin")->logout();
                return redirect(route("admin.login"));
                }
                catch(\Exception $e) {
                    return back()->withErrors([
                        'message' => 'An error occurred while logging out the user.',
                    ]);
                }
            }
public function customers()
{
    try {
    $users = User::all();
    $users = User::paginate(5);
    return view('admin.admin-customers', compact('users'));
    }
    catch(\Exception $e) {
        return back()->withErrors([
           'message' => 'An error occurred while fetching users.',
        ]);
    }
}

public function deleteUser($id)
{
    try {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.customers')->with('success', 'Customer deleted successfully');
    }   
    catch(\Exception $e) {
        return back()->withErrors([
            'message' => 'An error occurred while deleting the user.',
        ]);
    }
}

public function editUser($id)
{
    try {
    $user = User::findOrFail($id);
    return view('admin.admin-edituser', compact('user'));
    }
    catch(\Exception $e) {
        return back()->withErrors([
            'message' => 'An error occurred while fetching the user.',
        ]);
    }
}

public function updateUser(Request $request, $id)
{
    try {
        
    
    $user = User::findOrFail($id);
    
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'nullable'
    ]);

    $user->update($validatedData);
    return redirect()->route('admin.customers')->with('success', 'Customer updated successfully');
    }
    catch(\Exception $e) {
        return back()->withErrors([
           'message' => 'An error occurred while updating the user.',
        ]);
    }
}

public function orders()
{
    try {
    $orders = Order::with(['user', 'items', 'address'])->latest()->get();
  
    return view('admin.admin-orders', compact('orders'));
        }
        catch(\Exception $e) {
            return back()->withErrors([
                'message' => 'An error occurred while fetching orders.',
            ]);
        }
}

public function orderDetails(Order $order)
{
    try {
    $order->load(['user', 'items', 'address']);
   
    return view('admin.order-details', compact('order'));
    }
    catch(\Exception $e) {
        return back()->withErrors([
           'message' => 'An error occurred while fetching order details.',
        ]);
    }
}

public function updateOrderStatus(Request $request, $orderId)
{
    try {
    $order = Order::findOrFail($orderId);
    $order->update(['status' => $request->status]);
    
    return response()->json([
        'success' => true,
        'message' => 'Order status updated successfully'
    ]);
    }
    catch(\Exception $e) {
        return response()->json([
           'success' => false,
           'message' => 'An error occurred while updating the order status.'
        ]);
     }
}
}
