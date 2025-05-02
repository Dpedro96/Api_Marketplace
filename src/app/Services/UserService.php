<?php 
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
    
class UserService{
    public function __construct(protected UserRepository $userRepository){}

    public function getByUser(){
        $user = $this->userRepository->getByUserAuth(Auth::id());
        if ($user) {
            $user->image_url = URL::to($user->imagen_name);
        }
        return $user;
    }

    public function updateUser($data){
        return $this->userRepository->updateUserAuth($data,Auth::id());
    }

    public function createModerator($data){
        $data['password']=Hash::make($data['password']);
        $data+=array('role'=>'MODERATOR');
        return $this->userRepository->createModeratorUser($data);
    }

    public function delete(){
        return $this->userRepository->deleteUser(Auth::id());
    }
}