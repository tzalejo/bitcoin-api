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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Proveedor::query()->orderBy('id', 'ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProveedorRequest $request)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
