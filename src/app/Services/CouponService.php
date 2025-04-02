<?php

namespace App\Services;

use App\Repositories\CouponRepository;

class CouponService{
    public function __construct(protected CouponRepository $couponRepository){}

    public function create($data){
        return $this->couponRepository->createCoupon($data);
    }

    public function getAll(){
        return $this->couponRepository->getAllCoupon();
    }

    public function getById($id){
        return $this->couponRepository->getByIdCoupon($id);
    }

    public function update($request, $id){
        return $this->couponRepository->updateCoupon($request,$id);
    }

    public function delete($id){
        return $this->couponRepository->deleteCoupon($id);
    }
}
