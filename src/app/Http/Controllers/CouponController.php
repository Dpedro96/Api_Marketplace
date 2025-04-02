<?php

namespace App\Http\Controllers;

use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(protected CouponService $couponService){}

    public function store(Request $request){
        $data = $request->validate([
            'code'=>'required',
            'startDate'=>'required',
            'endDate'=>'required',
            'discountPercentage'=>'required'
        ]);
        $coupon = $this->couponService->create($data);
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

    public function update(Request $request, $id){
        $data = $request->validate([
            'code'=>'sometimes',
            'startDate'=>'sometimes',
            'endDate'=>'sometimes',
            'discountPercentage'=>'sometimes'
        ]);
        $coupon = $this->couponService->update($data,$id);
        return response()->json($coupon, 201);
    }

    public function destroy($id){
        $coupon = $this->couponService->delete($id);
        return response()->json($coupon, 201);
    }
}
