<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(protected CouponService $couponService){}

    public function store(StoreCouponRequest $request){
        $coupon = $this->couponService->create($request->validated());
        return response()->json($coupon, 201);
    }

    public function index(){
        $coupons = $this->couponService->getAll();
        return response()->json($coupons, 201);
    }

    public function show($id){
        $coupon = $this->couponService->getById($id);
        return response()->json($coupon, 201);
    }

    public function update(UpdateCouponRequest $request, $id){
        $coupon = $this->couponService->update($request->validated(),$id);
        return response()->json($coupon, 201);
    }   

    public function destroy($id){
        $coupon = $this->couponService->delete($id);
        return response()->json($coupon, 201);
    }
}
