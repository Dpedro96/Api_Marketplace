<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserService $userService, protected CartController $cartController){}

    public function getUser(){
        $user=$this->userService->getByUser();
        return response()->json($user, 201);
    }

    public function update(Request $request){
        $data=$request->validate([
            'name'=>'sometimes',
            'email'=>'sometimes'
        ]);
        if($this->userService->updateUser($data)){
            return response()->json(["Mensage"=>"Usuário Alterado com Sucesso!!"], 201);
        }
        return response()->json(["Mensage"=>"Erro ao Alterar Usuário"], 201);
    }

    public function storeModerator(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'confirm_password'=>'required'
        ]);
        $moderator=$this->userService->createModerator($data);
        $this->cartController->store($moderator['id']);
        return response()->json($moderator, 201);
    }

    public function destroy(){
        return response()->json($this->userService->delete(), 201);
    }
}
