<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Services\ImageService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService, protected ImageService $imageService){}

    public function store(StoreCategoryRequest $request){
        $data = $request->validated();
        unset($data['image']);    
        $category = $this->categoryService->create($data);
        $image = $this->imageService->storeCategory($request, $category['id']);
        return response()->json([$category, "image" => $image], 201);
    }
    

    public function index(){
        $categories=$this->categoryService->getAll();
        return response()->json($categories, 200);
    }

    public function show($id){
        $category=$this->categoryService->getById($id);
        return response()->json($category, 200);
    }

    public function update(UpdateCategoryRequest $request, $id){
        return response()->json($this->categoryService->update($request->validated(),$id), 200);
    }

    public function destroy($id)
    {
        $bool = $this->categoryService->delete($id);
        if($bool){
            return response()->json(['message' => 'Categoria deletada com sucesso.'], 200);
        }else{
            return response()->json(['message' => 'Categoria não encontrada.'], 404);
        }
    }

    public function input_image(UploadImageRequest $request, $id){
        $request->validated();
        return response()->json($this->imageService->storeCategory($request, $id), 200);
    }
}
