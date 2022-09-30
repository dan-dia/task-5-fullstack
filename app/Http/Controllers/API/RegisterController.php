<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|confirmed",
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);


        return response()->json([
            'status' => true,
            'message' => "Registration Account Successfully!",
            'data' => $user
        ]);
    }
}
