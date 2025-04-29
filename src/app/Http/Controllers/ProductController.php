<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UploadImageRequest;
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
        return response()->json($this->productService->getAll(), 200);
    }

    public function show($id){
        return response()->json($this->productService->getById($id), 200);
    }

    public function update(UpdateProductRequest $request, $id){
        return response()->json($this->productService->update($request->validated(),$id), 200);
    }

    public function destroy($id){
        return response()->json($this->productService->delete($id), 204);
    }

    public function input_image(UploadImageRequest $request, $id){
        $request->validated();
        return response()->json($this->imageService->storeProduct($request, $id), 204);
    }
}
