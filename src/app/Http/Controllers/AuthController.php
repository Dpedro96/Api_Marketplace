<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService, protected CartController $cartController){}

    public function register(Request $request){
        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'confirm_password'=>'required'
        ]);
        $data = $this->authService->register($validated);
        $this->cartController->store($data['id']);
        return response()->json($data, 200);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $token = $this->authService->login($credentials);
        return response()->json(['mensage'=>'Logado com sucesso',$token], 201);
    }
}
