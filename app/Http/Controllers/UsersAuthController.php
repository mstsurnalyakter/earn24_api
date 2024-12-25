<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsersAuthController extends Controller
{
    public function login(Request $request){
        Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string',
        ])->validate();
        

        if (!Auth::attempt($request->only('phone', 'password'))) {
            throw ValidationException::withMessages(['phone' => trans('auth.failed')]);
        }

        // $request->session()->regenerate();
        return response()->json([
            'success' => true,
            'message' => 'Login successful.'
        ]);
    }

    public function signup(Request $request){
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful. Please log in.'
        ]);
        
      
    }
}