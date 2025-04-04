<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService){}

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'stock'=>'required',
            'price'=>'required',
            'category_id'=>'required'
        ]);
        $product=$this->productService->create($data);
        return response()->json($data, 201);
    }

    public function index(){
        $products=$this->productService->getAll();
        return response()->json($products, 201);
    }

    public function show($id){
        $product=$this->productService->getById($id);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id){
        $data=$request->validate([
            'name'=>'sometimes',
            'stock'=>'sometimes',
            'price'=>'sometimes'
        ]);
        $product=$this->productService->update($data,$id);
        return response()->json($product, 201);
    }

    public function destroy($id){
        $product=$this->productService->delete($id);
        return response()->json($product, 201);
    }
}
