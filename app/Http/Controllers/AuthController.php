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
            'email' => 'required|email|unique:users',
            'password' => 'required_with:password_confirmation|string|confirmed',
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



    public function login(Request $request){

        $rules = [
            'email' => "required|email",
            'password' => "required"
        ];

        $validate = Validator::make( $request->all(), $rules );

        if( $validate->fails() ){
            return response()->json([ 'error' => "Incorrect Email", 'data' => $validate->errors()->all() ], 400);
        }else{
            $user = User::select('id', 'name', 'email', 'password')->where('email', '=', $request->email )->first();

            if( $user != null ){

                if( !Hash::check( $request->password, $user->password )  ){
                    return  response()->json(['error' => 'Invalid email or password'], 400);
                }

                $tokenString = $request->email.' '.Carbon::now();

                $token = $user->createToken($tokenString)->plainTextToken;

                $response_data = [
                    'user' => $user,
                    'token' => $token,
                ];
                return response()->json( $response_data, 200 );

            }else{
                return response()->json(['error' => 'Invalid email or password'], 400);
            }

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
