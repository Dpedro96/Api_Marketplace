<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService{

    public function register($data){
        $data['password']=Hash::make($data['password']);
        return User::create($data);
    }

    public function login($credentials){
        if(!Auth::attempt($credentials)){
            return response(['mensage'=>'Não Autorizado'], 401);
        }
        $user=User::where('email',$credentials['email'])->first();
        return $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
    }
}
