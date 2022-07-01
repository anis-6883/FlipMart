<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
* @group Auth Management
*
* APIs to manage the Authentication Routes
**/

class AuthController extends Controller
{
    public function register(Request $req)
    {
        $attributes = $req->validate([
            'username' => ['required', 'unique:users,username', 'min:8', 'max:255'],
            'email' => ['required', 'unique:users,email', 'email', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8', 'max:255']
        ]);

        $user = User::create([
            'username' => $attributes['username'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['username']),
        ]);

        $token = $user->createToken('TOKEN_' . uniqid())->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $req)
    {
        $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required',]
        ]);

        $user = User::where('email', $req->email)->first();

        if($user && Hash::check($req->password, $user->password))
        {
            $token = $user->createToken('TOKEN_' . uniqid())->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];
    
            return response($response, 201);
        }
        else
        {
            return response(['error' => 'Unauthorized'], 401);
        }

        
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        $response = ['success' => 'Logout Successfully!'];
        return response($response, 200);
    }
}
