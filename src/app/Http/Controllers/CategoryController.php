<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService){}

    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);
        $category = $this->categoryService->create($data);
        return response()->json($data, 201);
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
            'nome'=>'sometimes',
            'description'=>'sometimes'
        ]);
        $category=$this->categoryService->update($data,$id);
    }

    public function destroy($id){
        $bool=$this->categoryService->delete($id);
    }
}
