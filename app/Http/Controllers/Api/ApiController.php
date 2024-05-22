<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
/**
 * @OA\Info(
 *     title="User API",
 *     version="1.0.0",
 *     description="Documentation for my RESTful API built with Laravel."
 * )
 */
class ApiController extends Controller
{
 /**
 * @OA\Post(
 *      path="user/registration",
 *      operationId="User-registration",
 *      tags={"Users"},
 *      summary="Get list of users",
 *      description="Returns list of users",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation"
 *       ),
 *      @OA\Response(response=400, description="Bad request"),
 * )
 */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'registration successful',
            'token' => $user->createToken('api-token')->plainTextToken
        ],200);
    }

    /**
 * @OA\Post(
 *      path="user/login",
 *      operationId="User-login",
 *      tags={"Users"},
 *      summary="Get list of users",
 *      description="Returns list of users",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation"
 *       ),
 *      @OA\Response(response=400, description="Bad request"),
 * )
 */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        return response()->json([
            'status' => true,
            'message' => 'user login successful',
            'token' => $user->createToken('api-token')->plainTextToken
        ],200);
    }

 /**
 * @OA\Get(
 *      path="user/profile",
 *      operationId="getUsersList",
 *      tags={"Users"},
 *      summary="Get list of users",
 *      description="Returns list of users",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation"
 *       ),
 *      @OA\Response(response=400, description="Bad request"),
 * )
 */

    public function profile(){
        $userdata= auth()->user();
        return response()->json([
            'status' => true,
            'message' => 'user profile',
            'data' => $userdata,
            'id' => auth()->user()->id
        ],200);
        //return response()->json($request->user());
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'loggout out',
            'data' => []
        ],200);
    }

    
}
