<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
// use Illuminate\Support\Facades\Config;
use JWTAuth;

class AdminController extends Controller
{
    function __construct(){
        Auth::shouldUse('admins');
    }
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        return response()->json([
            'response' => 'success',
            'result' => [
                'token' => $token,
                'message' => 'I am Admin user',
            ],
        ]);
    }

    public function logout(){
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

}
