<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        try{
      
     $attributes = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password',
            'phone'=>'required|numeric',
        ]);
      $user =   User::create($attributes);
        Auth::login($user);
        return redirect('/dashboard');
    }   

catch(\Exception $e) {
    return back()->withErrors([
       'message' => 'An error occurred while creating the user.',
    ]);
}
    }

}
