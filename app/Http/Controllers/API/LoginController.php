<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:8"
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Login Failed!, email or password wrong!',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login Successfully!',
            'data'    => $user,
            'token'   => $user->createToken('authToken')->accessToken
        ]);
    }

    public function logout(Request $request)
    {
        $removeToken = $request->user()->tokens()->delete();

        if ($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'Logout Successfully!',
            ]);
        }
    }
}
