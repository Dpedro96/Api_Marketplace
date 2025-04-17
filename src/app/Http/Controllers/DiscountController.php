<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Services\DiscountService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct(protected DiscountService $discountService){}

    public function store(StoreDiscountRequest $request){
        return response()->json($this->discountService->create($request->validated()), 201);
    }

    public function index(){
        return response()->json($this->discountService->getAll(), 201);
    }

    public function show($id){
        return response()->json($this->discountService->getById($id), 201);
    }

    public function update(UpdateDiscountRequest $request,$id){
        return response()->json($this->discountService->update($request->validated(),$id), 201);
    }

    public function destroy($id){
        return response()->json($this->discountService->delete($id), 201);
    }
}
