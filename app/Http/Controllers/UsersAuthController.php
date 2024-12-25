<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'success' => false], 400);
        }

        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found', 'success' => false], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Incorrect password', 'success' => false], 401);
        }

        $success = [
            'token' => $user->createToken('myApp')->plainTextToken,
            'name' => $user->name
        ];

        return response()->json([
            'success' => true,
            'result' => $success,
            'message' => 'User logged in successfully'
        ]);
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone|length:11',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'success' => false], 400);
        }

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