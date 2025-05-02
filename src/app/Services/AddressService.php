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
        return $this->addressRepository->getAll(Auth::id());
    }

    public function getById($id){
        $address = $this->addressRepository->getById($id,Auth::id());
        if (!$address) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Endereço não encontrado.");
        }
        return $address;
    }

    public function update($request, $id){
        return $this->addressRepository->update($id, Auth::id(), $request);
    }

    public function delete($id){
        return $this->addressRepository->delete($id, Auth::id());
    }
}
