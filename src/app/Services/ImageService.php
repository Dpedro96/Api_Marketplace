<?php
namespace App\Services;

use App\Repositories\ImagenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ImageService{

    public function __construct(protected ImagenRepository $imagenRepository){}

    public function store(Request $request, string $folder){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.Uuid::uuid4().'.'.$ext;
            $path = $image->storeAs($folder, $imageName);
            return $path; 
        }
        return null;
    }    

    public function storeUser(Request $request){
        $path = $this->store($request, 'user');
        $this->imagenRepository->createUser($path, Auth::id());
        return $path;
    }
    
    public function storeCategory(Request $request, $id){
        $path = $this->store($request, 'category');
        $this->imagenRepository->createCategory($path, $id);
        return $path;
    }
    
    public function storeProduct(Request $request, $id){
        $path = $this->store($request, 'product');
        $this->imagenRepository->createProduct($path, $id);
        return $path;
    }
}