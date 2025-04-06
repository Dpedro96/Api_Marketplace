<?php 
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService{
    public function __construct(protected UserRepository $userRepository){}

    public function getByUser(){
        return $this->userRepository->getByUserAuth(Auth::id());
    }

    public function updateUser($data){
        return $this->userRepository->updateUserAuth($data,Auth::id());
    }

    public function createModerator($data){
        if(!($data['password']==$data['confirm_password'])){
            return false;
        }
        $data['password']=Hash::make($data['password']);
        $data+=array('role'=>'MODERATOR');
        return $this->userRepository->createModeratorUser($data);
    }

    public function delete(){
        return $this->userRepository->deleteUser(Auth::id());
    }
}