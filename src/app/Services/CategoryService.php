<?php 
namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\URL;

class CategoryService{
    public function __construct(protected CategoryRepository $categoryRepository){}

    public function create($data){
        return $this->categoryRepository->create($data);
    }
    public function getAll()
    {
        $categories = $this->categoryRepository->getAllCategory();
        foreach ($categories as $category) {
            $category->image_url = URL::to($category->imagen_path);
        }
        return $categories;
    }

    public function getById($id)
    {
        $category = $this->categoryRepository->getByIdCategory($id);
        if ($category) {
            $category->image_url = URL::to($category->imagen_path);
        }
        return $category;
    }

    public function update($data,$id){
        return $this->categoryRepository->updateCategory($data,$id);
    }

    public function delete($id){
        return $this->categoryRepository->deleteCategory($id);
    }
}