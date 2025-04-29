<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService, protected CartController $cartController){}

    public function register(RegisterAuthRequest $request){
        $data = $this->authService->register($request->validated());
        $this->cartController->store($data['id']);
        return response()->json($data, 201);
    }

    public function login(LoginAuthRequest $request){
        $token = $this->authService->login($request->validated());
    
        if (!$token) {
            return response()->json(['message' => 'Email ou senha incorretos'], 401);
        }
    
        return response()->json([
            'message' => 'Logado com sucesso',
            'token' => $token
        ], 200);
    }
    

   /* public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                'message' => 'Logout realizado com sucesso.'
            ], 200);
        }
        return response()->json([
            'message' => 'Usuário não autenticado.'
        ], 401);
    }*/
}
