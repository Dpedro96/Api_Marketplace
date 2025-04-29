<?php
namespace App\Services;

use App\Repositories\DiscountRepository;

class DiscountService{
    public function __construct(protected DiscountRepository $discountRepository){}

    public function create($data){
        $discounts = $this->discountRepository->getByIdProductDiscount($data['product_id']);
        $currentTotalDiscount = $discounts->sum('discountPercentage');
        $newTotal = $currentTotalDiscount + $data['discountPercentage'];
        if ($newTotal > 100) {
            throw new \Exception('A soma dos descontos para este produto não pode ultrapassar 100%.');
        }
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