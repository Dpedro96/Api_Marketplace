<?php
namespace App\Repositories;

use App\Models\Address;

class AddressRepository{
    public function __construct(protected Address $addressModel){}

    public function create($data){
        return $this->addressModel->create($data);
    }

    public function getAll($id){
        return $this->addressModel->where('user_id',$id)->get();
    }

    public function getById($id,$user_id){
        return $this->addressModel->where('id', $id)->where('user_id', $user_id)->first();
    }

    public function update($id, $user_id, $data){
        $address = $this->getById($id, $user_id);
        return $address->update($data);
    }

    public function delete($id, $user_id){
        return $this->getById($id, $user_id);         
    }

}
