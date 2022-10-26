<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{



    /**
     * @param Request $request
     * carrying > name > email > password > password_confirmation
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed',
        ];

        $error  =  Validator::make( $request->all(), $rules );

        if ($error->fails()) {
            return response()->json(['error' => 'registration failed' ,'data' => $error->errors()->all()], 400);
        }
        else{
            /**
             * If the user data is valid then we start registering the
             * user into the system database.
             */
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make( $request['password'] ),
            ]);

            /**
             * Next we create a token that we will use to identify
             * if whether the user is authenticated or not
             */
            $token = $user->createToken("creator"." ".Carbon::now(), ['getBooks'])->plainTextToken;

            $response_data = [
                'user' => $user,
                'token' => $token, 
            ];
            /**
             * Return the user information as a response the call
             */
            return response()->json($response_data,200);
        }
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        auth()->user()->tokens()->delete();    
        return response()->json(['message' => "user logout"], 200);
    }



    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $users = User::all();
        return response()->json($users, 200);
    }
    
}
