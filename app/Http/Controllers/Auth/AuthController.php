<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
//    }
//
//    public function login(Request $request){
//        $validator = Validator::make($request->all(),[
//            'email' => 'required|string',
//            'password' => 'required|string'
//        ]);
//        if($validator->failed()){
//            return response()->json($validator->errors(),422);
//        }
//        if(!$token = JWTAuth::attempt($validator->validated())){
//            return response()->json(['error' => 'Unauthorized'],401);
//        }
//        return $this->respondWithToken($token);
//    }
//
//    public function respondWithToken($token){
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'user' => auth()->user()
//        ]);
//    }
//
//    public function register(Request $request){
//        $validator = Validator::make($request->all(),[
//            'name' => 'required|string',
//            'email' => 'required|string|unique:users,email',
//            'password' => 'required|string|confirmed'
//        ]);
//        if($validator->fails()){
//            return response()->json($validator->errors()->toJson(),400);
//        }
//
//        $user = new User();
//        $user->name = $request->input('name');
//        $user->email = $request->input('email');
//        $user->password = $request->input('password');
//        $user->save();
//
//        $response = [
//            'user' => $user,
//            'message' => $user
//        ];
//        return response($response, 201);
//    }
//
//    public function logout(){
//        auth()->logout();
//        return response()->json(['message' => 'Successfully logged out']);
//    }


    public function login(Request $request){
            $field = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email',$field['email'])->first();
        if(!$user || !Hash::check($field['password'],$user->password)){
            return response([
               'message' => 'Email or Password incorrect'
            ],401);
        }

        $token = $user->createToken('veggietoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'admin_name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
            // role,
            'admin_phone' => ['required', 'string', 'min:9', 'max:10', 'regex:/^0[0-9]{9}/'],
            'address' => ['required', 'string'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = new User();
        $user->admin_name = $request->input('admin_name');
        $user->email = $request->input('email');
        $user->admin_phone = $request->input('admin_phone');
        $user->address = $request->input('address');
        $user->password = Hash::make($request->input("password"));
        $user->save();

        $token = $user->createToken('veggietoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
