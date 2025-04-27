<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService, protected ImageService $imageService){}

    public function store(StoreProductRequest $request){
        $data=$request->validated();
        $image=[];
        unset($data['image']);
        $product=$this->productService->create($data);
        if($request->hasFile('image')){
            $image=$this->imageService->storeProduct($request,$product['id']);
        }
        return response()->json([$product,"imagem"=>$image], 201);
    }

    public function index(){
        $products=$this->productService->getAll();
        return response()->json($products, 201);
    }

    public function show($id){
        $product=$this->productService->getById($id);
        return response()->json($product, 201);
    }

    public function update(UpdateProductRequest $request, $id){
        $product=$this->productService->update($request->validated(),$id);
        return response()->json($product, 201);
    }

    public function destroy($id){
        $product=$this->productService->delete($id);
        return response()->json($product, 201);
    }
}
