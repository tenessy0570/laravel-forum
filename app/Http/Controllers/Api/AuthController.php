<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (User::where('email', $request->email)->first()) {
            return response()->json([
                'success' => false,
                'error' => 'email is already used'
            ], 401);
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => Str::random(95)
        ]);

        $user->save();

        return response()->json([
            'success' => true,
            'token' => $user->token
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'error' => 'Incorrect data'
            ], 401);
        }

        $user = $request->user();
        $user->generateToken();


        return response()->json([
            'success' => true,
            'token' => $user->token
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user;

        $user->token = '';
        $user->save();

        return response()->json([
            'success' => true
        ], 200);
    }
}
