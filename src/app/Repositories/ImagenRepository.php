<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ImagenRepository{
    public function __construct(protected User $userModel, protected Category $categoryModel, protected Product $productModel){}

    public function createUser($nameImage,$user_id){
        return $this->userModel->findOrFail($user_id)->update(['imagen_name'=>$nameImage]);
    }

    public function createCategory($nameImage,$id){
        return $this->categoryModel->findOrFail($id)->update(['imagen_path'=>$nameImage]);
    }

    public function createProduct($nameImage,$id){
        return $this->productModel->findOrFail($id)->update(['imagen_path'=>$nameImage]);
    }
}