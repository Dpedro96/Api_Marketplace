<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Services\CategoryService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService, protected ImageService $imageService){}

    public function store(StoreCategoryRequest $request){
        $data=$request->validated();
        unset($data['image']);
        $category = $this->categoryService->create($data);
        if($request->hasFile('image')){
            $image=$this->imageService->storeCategory($request,$category['id']);
        }
        return response()->json([$category,$image], 201);
    }

    public function index(){
        $categories=$this->categoryService->getAll();
        return response()->json($categories, 201);
    }

    public function show($id){
        $category=$this->categoryService->getById($id);
        return response()->json($category, 201);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name'=>'sometimes',
            'description'=>'sometimes'
        ]);
        return response()->json($this->categoryService->update($data,$id), 201);
    }

    public function destroy($id){
        $bool=$this->categoryService->delete($id);
    }

    public function input_image(CreateUserRequest $request){
        $request->validated();
        return response()->json($this->imageService->store($request), 200);
    }
}
