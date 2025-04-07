<?php
namespace App\Services;

use App\Repositories\DiscountRepository;

class DiscountService{
    public function __construct(protected DiscountRepository $discountRepository){}

    public function create($data){
        return $this->discountRepository->createDiscount($data);
    }

    public function getAll(){
        return $this->discountRepository->getAllDiscount();
    }

    public function getById($id){
        return $this->discountRepository->getByIdDiscount($id);
    }

    public function update($data,$id){
        return $this->discountRepository->updateDiscount($data,$id);
    }

    public function delete($id){
        return $this->discountRepository->deleteDiscount($id);
    }
}