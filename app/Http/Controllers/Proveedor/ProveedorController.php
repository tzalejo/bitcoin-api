<?php

namespace App\Http\Controllers\Proveedor;

use App\Http\Controllers\ApiController;
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
    public function store(Request $request)
    {
        // lo dejo no requerido porque voy a agregar a veces prove solo el apellido..
        $datosValidos = Validator::make($request->all(), [
            'dni' => '',
            'apellido' => 'required',
            'nombre' => '',
            'email' => '',
            'telefono' => '',
        ]);
        if ($datosValidos->fails()) {
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }
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
    public function update(Request $request, Proveedor $proveedor)
    {
        $datosValidos = Validator::make($request->all(), [
            'dni' => '',
            'apellido' => 'required',
            'nombre' => '',
            'email' => '',
            'telefono' => '',
        ]);
        if ($datosValidos->fails()) {
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }

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
