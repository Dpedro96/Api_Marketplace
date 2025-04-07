<?php

namespace App\Http\Controllers;

use App\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct(protected DiscountService $discountService){}

    public function store(Request $request){
        $data=$request->validate([
            'description'=>'required',
            'startDate'=>'required',
            'endDate'=>'required',
            'discountPercentage'=>'required', 
            'product_id'=>'required'
        ]);
        return response()->json($this->discountService->create($data), 201);
    }

    public function index(){
        return response()->json($this->discountService->getAll(), 201);
    }

    public function show($id){
        return response()->json($this->discountService->getById($id), 201);
    }

    public function update(Request $request,$id){
        $data=$request->validate([
            'description'=>'sometimes',
            'startDate'=>'sometimes',
            'endDate'=>'sometimes',
            'discountPercentage'=>'sometimes'
        ]);
        return response()->json($this->discountService->update($data,$id), 201);
    }

    public function destroy($id){
        return response()->json($this->discountService->delete($id), 201);
    }
}
