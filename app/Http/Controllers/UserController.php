<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            "name" => "required|string|max:100",
            "email" => "required|string|unique:users,email",
            "password" => "required|string|confirmed|min:6"
        ]);

        $user = User::create([
            "name" => $fields['name'],
            "email" => $fields['email'],
            "role" => "customer",
            "password" => bcrypt($fields['password'])
        ]);

        $token = $user->crateToken('tokenku')->plainTextToken;

        $reponse =[
            'user' => $user,
            'token' => $token
        ];

        return response ($response, 201);
    }

    public function login (Request $request)
    {
        $fields = $request->validate([
            "email" => "required|string",
            "password" => "required|string"
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!user || !hash::check ($fields['password'], $user->password)) {
            return response([
                'massage' => 'unauthorized'
            ],401);
        }

        $token = $user->createToken('tokenku') -> plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return respons($response, 201);
       
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return[
            'massage' => 'logged out'
        ];
    }
}
