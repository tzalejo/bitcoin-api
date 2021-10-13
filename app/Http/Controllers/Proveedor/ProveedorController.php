<?php
namespace App\Http\Controllers\Proveedor;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Proveedor;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends ApiController
{
    use ApiResponser;
    
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->showAll(Proveedor::query()->orderBy('id', 'ASC')->get());
    }

    public function store(StoreProveedorRequest $request): \Illuminate\Http\JsonResponse
    {
        $proveedorNuevo = Proveedor::create([
            'dni' => $request->dni,
            'apellido' => ucwords(strtolower($request->apellido)),
            'nombre' => ucwords(strtolower($request->nombre)),
            'email' => $request->email,
            'telefono' => $request->telefono
        ]);
        return $this->showOne($proveedorNuevo);
    }

    public function update(UpdateProveedorRequest $request, Proveedor $proveedor): \Illuminate\Http\JsonResponse
    {
        $proveedor->update([
            'dni' => $request->dni,
            'apellido' => ucwords(strtolower($request->apellido)),
            'nombre' => ucwords(strtolower($request->nombre)),
            'email' => $request->email,
            'telefono' => $request->telefono
        ]);

        return $this->showOne($proveedor);
    }

}
