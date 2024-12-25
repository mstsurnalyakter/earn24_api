<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersAuthController extends Controller
{
    public function login(Request $request){
        $user = User::where("email", $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
           return response()->json(['error'=>'Invalid credentials',"success"=>false],401);
        }

        // $token=$user->createToken("myApp")->plainTextToken;

        $succes = ['token'=>$user->createToken('myApp')->plainTextToken];
        $succes['name']=$user->name;
        return ['success'=>'true','result'=>$succes,"message"=>"User created successfully"];

    }
    public function signup(Request $request){
        $input = $request->input();
        $input['password'] = bcrypt($input['password']);
        $user=User::create($input);
        $succes = ['token'=>$user->createToken('myApp')->plainTextToken];
        $succes['name']=$user->name;
        return ['success'=>'true','result'=>$succes,"message"=>"User created successfully"];
    }
}
