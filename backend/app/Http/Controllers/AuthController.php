<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'mensagem' => 'Credenciais inválidas.',
            ], 401);
        }

        $user = $request->user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'mensagem' => 'Login realizado com sucesso.',
            'data' => [
                'usuario' => $user,
                'token' => $token,
            ]
        ]);
    }
}
