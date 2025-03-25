<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
USE Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request as AuthRequest;
use App\Models\User;




class SessionController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }
        // public function store(Request $request)
        // {
        
        //   $attributes =   $request->validate([
        //         'email'=>'required|email',
        //         'password'=>'required|min:6',
        //     ]);
        //    if(!Auth::attempt($attributes)){
        //     throw ValidationException::withMessages([
        //         'email' => ['The provided credentials are incorrect.'],
        //         'password' => ['The provided password is incorrect.'],
        //     ]);
        //    }
        //     request()->session()->regenerate();
        //     return redirect('/');
        // }   
    
    public function authenticate(AuthRequest $request) {
        
        try{
            $credentials = $request->only(["email", "password"]);
            
            if(Auth::guard("user")->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect(route("homepage"));
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

    public function logout()
    {
        try{
        session()->forget('cart');
        Auth::guard('user')->logout();
        return redirect('/')->with('success', 'Goodbye!');
        }
        catch(\Exception $e) {
            return back()->withErrors([
              'message' => 'An error occurred while logging out.',
            ]);
        }
    }




    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        try{
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
        }
        catch(\Exception $e) {
            return response()->json([
               'success' => false,
               'message' => 'An error occurred while updating the user.'
                    ]);
        }
    }



}
