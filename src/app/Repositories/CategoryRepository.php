<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository{
    public function __construct(protected Category $categoryModel){}

    public function create($data){
        return $this->categoryModel->create($data);
    }

    public function getAllCategory(){
        return $this->categoryModel->get();
    }

    public function getByIdCategory($id){
        return $this->categoryModel->find($id);
    }

    public function updateCategory($data, $id){
        return $this->categoryModel->find($id)->update($data);
    }

    public function deleteCategory($id){
        return $this->categoryModel->find($id)->delete();
    }
}