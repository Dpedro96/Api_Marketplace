<?php
namespace App\Services;

use App\Repositories\AddressRepository;
use Illuminate\Support\Facades\Auth;

class AddressService{
    public function __construct(protected AddressRepository $addressRepository){}

    public function create($data){
        $user_id=Auth::id();
        $data+=array('user_id'=>$user_id);
        return $this->addressRepository->create($data);
    }

    public function getAll(){
        $user_id=Auth::id();
        return $this->addressRepository->getAll($user_id);
    }

    public function update($date, $id){
        $user_id=Auth::id();
        $addressUp = $this->addressRepository->getById($id, $user_id);
        $addressUp[0]->update($date);
        return $addressUp[0];
    }

    public function delete($id){
        $user_id=Auth::id();
        $addresss = $this->addressRepository->getById($id,$user_id);
        return $addresss[0]->delete();
    }
}
