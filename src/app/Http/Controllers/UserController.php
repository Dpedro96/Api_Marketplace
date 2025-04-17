<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\ImageService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(protected UserService $userService, protected CartController $cartController, protected ImageService $imageService){}

    public function getUser(){
        $user=$this->userService->getByUser();
        return response()->json($user, 201);
    }

    public function update(UpdateUserRequest $request){
        $this->userService->updateUser($request->validated());
        return response()->json(["Mensage"=>"Erro ao Alterar Usuário"], 201);
    }

    public function storeModerator(RegisterAuthRequest $request){
        $moderator=$this->userService->createModerator($request->validated());
        $this->cartController->store($moderator['id']);
        return response()->json($moderator, 201);
    }

    public function destroy(){
        return response()->json($this->userService->delete(), 201);
    }

    public function input_image(CreateUserRequest $request){
        $request->validated();
        return response()->json($this->imageService->store($request), 200);
    }
}
