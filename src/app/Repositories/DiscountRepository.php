<?php
namespace App\Repositories;

use App\Models\Discount;

class DiscountRepository{
    public function __construct(protected Discount $discountModel){}

    public function createDiscount($data){
        return $this->discountModel->create($data);
    }

    public function getAllDiscount(){
        return $this->discountModel->get();
    }

    public function getByIdDiscount($id){
        return $this->discountModel->findOrfail($id);
    }

    public function updateDiscount($data,$id){
        return $this->discountModel->findOrFail($id)->update($data);
    }

    public function deleteDiscount($id){
        return $this->discountModel->findOrFail($id)->delete();
    }
}