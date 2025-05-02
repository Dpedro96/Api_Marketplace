<?php
namespace App\Services;

use App\Repositories\ImagenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ImageService{

    public function __construct(protected ImagenRepository $imagenRepository){}

    public function store(Request $request, string $folder)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . Uuid::uuid4() . '.' . $ext;
            $path = $image->storeAs($folder, $imageName, 'public');
            return 'storage/' . $path;
        }
        $defaultImagePath = 'image_default.png'; 
        return 'storage/' . $defaultImagePath; 
    }

    public function storeUser(Request $request)
    {
        $relativePath = $this->store($request, 'user');
        $this->imagenRepository->createUser($relativePath, Auth::id());
        return url($relativePath);
    }

    public function storeUserCreate(Request $request, $id)
    {
        $relativePath = $this->store($request, 'user');
        $this->imagenRepository->createUser($relativePath, $id);
        return url($relativePath);
    }

    public function storeCategory(Request $request, $id)
    {
        $relativePath = $this->store($request, 'category');
        $this->imagenRepository->createCategory($relativePath, $id);
        return url($relativePath);
    }

    public function storeProduct(Request $request, $id)
    {
        $relativePath = $this->store($request, 'product');
        $this->imagenRepository->createProduct($relativePath, $id);
        return url($relativePath);
    }
}