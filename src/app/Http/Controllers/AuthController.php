<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService, protected CartController $cartController){}

    public function register(RegisterAuthRequest $request){
        $data = $this->authService->register($request->validated());
        $this->cartController->store($data['id']);
        return response()->json($data, 200);
    }

    public function login(LoginAuthRequest $request){
        $token = $this->authService->login($request->validated());
        return response()->json(['mensage'=>'Logado com sucesso',$token], 201);
    }
}
