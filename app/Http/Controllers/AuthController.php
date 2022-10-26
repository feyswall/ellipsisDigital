<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function register(Request $request){
        $valid_user = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed',
        ]);

        $user = User::create([
            'name' => $valid_user['name'],
            'email' => $valid_user['email'],
            'password' => Hash::make( $valid_user['password'] ),
        ]);

        $token = $user->createToken("creator")->plainTextToken;

        $response_data = [
            'user' => $user,
            'token' => $token, 
        ];
        return response()->json($response_data);
    }


    public function logout(){
        auth()->user()->tokens()->delete();    
        return response()->json(['message' => "user logout"]);
    }


    public function index(){
        $users = User::all();
        return response()->json($users);
    }
    
}
