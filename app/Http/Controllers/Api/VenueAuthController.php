<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'city_id'       => 'required|exists:cities,id',
            'email'         => 'required|email|unique:venues,email',
            'password'      => 'required|min:8',
            'phone'         => 'required|max:15',
            'description'   => 'required|string',
            'rules'         => 'required|string',
            'address'       => 'required|string',
            'bank_account'  => 'nullable|string'
        ]);

        $data['password'] = Hash::make($data['password']);
        $venue = Venue::create($data);

        $token = $venue->createToken('venue-token')->plainTextToken;

        return response()->json([
            'message'   => 'Venue registered succesfully',
            'token'     => $token,
            'venue'     => $venue
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $venue = Venue::where('email', $request->email)->first();

        if(!$venue || !Hash::check($request->password, $venue->password)) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        $token = $venue->createToken('venue-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'venue' => $venue->only('id','name','email','city_id')
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
