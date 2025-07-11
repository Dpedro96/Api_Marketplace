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
        return $this->discountModel->findOrFail($id);
    }

    public function getByIdProductDiscount($id_product){
        return $this->discountModel->where('product_id',$id_product)->get();
    }

    public function updateDiscount($data,$id){
        $discount = $this->discountModel->findOrFail($id);
        $discount->update($data);
        return $discount;
    }

    public function deleteDiscount($id){
        return $this->discountModel->findOrFail($id)->delete();
    }
}