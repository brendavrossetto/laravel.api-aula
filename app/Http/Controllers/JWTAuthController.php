<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException; // Importação da exceção JWTException
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthController extends Controller
{
    public function register(Request $request) {
        // Validação dos dados de entrada
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Geração do token JWT
        $token = JWTAuth::fromUser($user);

        // Retorno da resposta com os dados do usuário e o token
        return response()->json(compact('user', 'token'), 201); 
    }

    public function login(Request $request) {
        $cred = $request->only('email', 'password'); 

        try {
            // Tentativa de autenticação
            if (!JWTAuth::attempt($cred)) {
                return response()->json([
                    'error' => 'Invalid credentials'
                ], 401);
            }

            // Se chegou aqui, a autenticação foi bem-sucedida
            $user = auth()->user();

            // Geração do token JWT
            $token = JWTAuth::fromUser($user);

            // Retorno da resposta com os dados do usuário e o token
            return response()->json(compact('user', 'token'), 200);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token'
            ], 500);
        }
    }
}
