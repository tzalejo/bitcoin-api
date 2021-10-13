<?php

namespace App\Http\Controllers\Cliente;

use App\Cliente;
use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClienteController extends ApiController
{
    use ApiResponser;
    public function index(): \Illuminate\Http\Response
    {
        return Cliente::query()->orderBy('apellido','ASC')->get();
    }

    public function store(StoreClienteRequest $request): \Illuminate\Http\JsonResponse
    {
        $clienteNuevo = Cliente::create([
            'dni' => $request->dni,
            'apellido' => ucwords(strtolower($request->apellido)),
            'nombre' => ucwords(strtolower($request->nombre)),
            'email' => $request->email,
            'telefono' => $request->telefono
        ]);
        return $this->showOne($clienteNuevo);
    }

    public function show(Cliente $cliente): \Illuminate\Http\JsonResponse
    {
        // return $cliente;
        return $this->showOne($cliente);
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente): \Illuminate\Http\JsonResponse
    {
        $cliente->update([
            'dni' => $request->dni,
            'apellido' => ucwords(strtolower($request->apellido)),
            'nombre' => ucwords(strtolower($request->nombre)),
            'email' => $request->email,
            'telefono' => $request->telefono
        ]);

        return $this->showOne($cliente);

    }
    
}
