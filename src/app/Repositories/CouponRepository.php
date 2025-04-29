<?php
namespace App\Repositories;

use App\Models\Coupon;

class CouponRepository{
    public function __construct(protected Coupon $couponModel){}

    public function createCoupon($data){
        return $this->couponModel->create($data);
    }

    public function getAllCoupon(){
        return $this->couponModel->get();
    }

    public function getByIdCoupon($id){
        return $this->couponModel->find($id);
    }

    public function updateCoupon($request,$id){
        $coupon = $this->couponModel->findOrFail($id);
        $coupon->update($request);
        return $coupon;
    }

    public function deleteCoupon($id){
        return $this->couponModel->find($id)->delete();
    }
}
