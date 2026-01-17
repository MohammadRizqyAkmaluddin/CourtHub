<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:values,email',
            'password'  => 'required|min:8',
            'phone'     => 'required|string|max:15',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'message' => 'Successfully Registered',
            'token'   => $token,
            'user'    => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Wrong Credential'
            ], 401);
        }

        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'message'   => 'You are Logged in',
            'token'     => $token,
            'user'      => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
