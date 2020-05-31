<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
class UserController extends Controller
{
    function __construct(){
        Auth::shouldUse('users');
    }
    public function login(){
         
        $credentials = request(['email', 'password']);

        try {
            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return $this->respondWithToken($token);
    }

    public function logout(){
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token' => "{$token}",
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function getUser(){
        $user = Auth::user();
        return response(['response' => $user]);
    }

}
