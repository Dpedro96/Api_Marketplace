<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository{
    public function __construct(protected User $userModel){}

    public function getByUserAuth($id){
        return $this->userModel->findOrFail($id);
    }

    public function updateUserAuth($data,$id){
        return $this->userModel->findOrFail($id)->update($data);
    }

    public function createModeratorUser($data){
        return $this->userModel->create($data);
    }

    public function deleteUser($id){
        return $this->userModel->findOrFail($id)->delete();
    }
}