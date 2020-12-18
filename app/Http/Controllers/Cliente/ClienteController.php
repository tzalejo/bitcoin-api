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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::query()->orderBy('apellido','ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        // return $cliente;
        return $this->showOne($cliente);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
