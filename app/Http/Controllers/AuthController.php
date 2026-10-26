<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    
    {
        $request -> validate([
        "name" => "required|string|max:100",
        "email" => "required|string|email|max:191|unique:users",
        "password" => "required|string|min:8",
        "role" => "nullable|in:creator, editor, admin",
    ]);

    
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role ?? "creator",
        ]);
    
        $token = $user -> createToken("auth_token") -> plainTextToken;
        return res() -> json([
            'message' => 'Registrasi berhasil',
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $request)

    {
        $request -> validate([
            "email" => "required email",
            "password" => "required",
        ]);

        $user = User::where("email", $request->email)->first();
if (!$user || !Hash::check($request->password, $user->password)) {
    throw ValidationException::withMessages([
        "email" => ["credential invalid"]
    ]);
}

        $token = $user -> createToken("auth_token") -> plainTextToken;
        return response()->json([
            "message" => "login berhasil",
            "data" => $user,
            "access_token" => $token,
            "token_type" => "Bearer",
        ], 200);
    }
}
