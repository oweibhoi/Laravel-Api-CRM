<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginContoller extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('admin_token', ['create', 'update', 'delete']);
            
            return response()->json([
                'success' => true,
                'token' => $token->plainTextToken
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
