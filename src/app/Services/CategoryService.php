<?php 
namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService{
    public function __construct(protected CategoryRepository $categoryRepository){}

    public function create($data){
        return $this->categoryRepository->create($data);
    }

    public function getAll(){
        return $this->categoryRepository->getAllCategory();
    }

    public function getById($id){
        return $this->categoryRepository->getByIdCategory($id);
    }

    public function update($data,$id){
        return $this->categoryRepository->updateCategory($data,$id);
    }

    public function delete($id){
        return $this->categoryRepository->deleteCategory($id);
    }
}