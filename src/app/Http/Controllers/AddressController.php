<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Services\AddressService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AddressController extends Controller
{
    public function __construct(protected AddressService $addressService){}

    public function store(StoreAddressRequest $request){
        return response()->json($this->addressService->create($request->validated()), 201);
    }

    public function index(){
        return response()->json($this->addressService->getAll(), 200);
    }

    public function show($id){
        try {
            $address = $this->addressService->getById($id);
            return response()->json($address, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Endereço não encontrado.'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erro ao buscar o endereço.'], 500);
        }
    }

    public function update(UpdateAddressRequest $request,$id){
        return response()->json($this->addressService->update($request->validated(), $id), 200);
    }

    public function destroy($id){
        $this->addressService->delete($id);
        return response()->noContent();
    }
}
