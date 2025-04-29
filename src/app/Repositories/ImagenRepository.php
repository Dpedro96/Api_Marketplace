<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ImagenRepository{
    public function __construct(protected User $userModel, protected Category $categoryModel, protected Product $productModel){}

    public function createUser($imagePath,$user_id){
        return $this->userModel->findOrFail($user_id)->update(['imagen_name'=>$imagePath]);
    }

    public function createCategory($imagePath,$id){
        return $this->categoryModel->findOrFail($id)->update(['imagen_path'=>$imagePath]);
    }

    public function createProduct($imagePath,$id){
        return $this->productModel->findOrFail($id)->update(['imagen_path'=>$imagePath]);
    }
}