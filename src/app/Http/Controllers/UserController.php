<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
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
        return response()->json($this->userService->getByUser(), 200);
    }

    public function update(UpdateUserRequest $request){
        $this->userService->updateUser($request->validated());
        return response()->json(["Mensage"=>"Usuário atualizado com sucesso."], 200);
    }

    public function storeModerator(RegisterAuthRequest $request){
        $moderator=$this->userService->createModerator($request->validated());
        $this->cartController->store($moderator['id']);
        return response()->json($moderator, 201);
    }

    public function destroy(){
        return response()->json($this->userService->delete(), 204);
    }

    public function input_image(UploadImageRequest $request){
        $request->validated();
        return response()->json($this->imageService->storeUser($request), 201);
    }
}
