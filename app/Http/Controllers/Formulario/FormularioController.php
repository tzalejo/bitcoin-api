<?php

namespace App\Http\Controllers\Formulario;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use App\Formulario;

class FormularioController extends ApiController
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
        return Formulario::query()
                    ->with('proveedor')
                    ->with('cliente')
                    ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request;

        $datosValidos = Validator::make($request->all(),[  
            'web' => 'required',
            'compra_moneda' => 'required',
            'comision_prove' => 'required|numeric',
            'comision_vendedor' => 'required|numeric',
            'valor_comision_prove' => 'required|numeric',
            'valor_comision_vendedor' => 'required|numeric',
            'criptomoneda' => 'required|numeric', 
            'tipo_criptomoneda' => 'required', 
            'importe_compra' => 'required|numeric', 
            'fecha_compra' => 'required', 
            'dolar' => 'required|numeric',
            'estado' => 'required',
            'costo_criptomoneda_p' => 'required|numeric',
            'costo_criptomoneda_v' => 'required|numeric',
            'ganacia_criptomoneda' => 'required|numeric',
            'cliente_id' => 'required|numeric',
            'proveedor_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);
        // return $datosValidos;
         # verifico si hubo errores en la validaciones..
        if ($datosValidos->fails()) {
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }

        # creo la comision
        $formularioNuevo = Formulario::create([
            'web' => $request->web,
            'compra_moneda' => $request->compra_moneda,
            'comision_prove' => $request->comision_prove,
            'comision_vendedor' => $request->comision_vendedor,
            'valor_comision_prove' => $request->valor_comision_prove,
            'valor_comision_vendedor' => $request->valor_comision_vendedor,
            'criptomoneda' => $request->criptomoneda,
            'tipo_criptomoneda' => $request->tipo_criptomoneda,
            'importe_compra' => $request->importe_compra,
            'fecha_compra' => $request->fecha_compra,
            'dolar' => $request->dolar,
            'estado' => $request->estado,
            'costo_criptomoneda_p' => $request->costo_criptomoneda_p,
            'costo_criptomoneda_v' => $request->costo_criptomoneda_v,
            'ganacia_criptomoneda' => $request->ganacia_criptomoneda,
            'cliente_id' => $request->cliente_id,
            'proveedor_id' => $request->proveedor_id,
            'user_id' => $request->user_id,
        ]);
        # retorno ok
        return $this->showOne($formularioNuevo);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function show(Formulario $formulario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formulario $formulario)
    {
        // return $formulario;
        $datosValidos = Validator::make($request->all(),[
            'web' => 'required',
            'compra_moneda' => 'required',
            'comision_prove' => 'required|numeric',
            'comision_vendedor' => 'required|numeric',
            'valor_comision_prove' => 'required|numeric',
            'valor_comision_vendedor' => 'required|numeric',
            'criptomoneda' => 'required|numeric', 
            'tipo_criptomoneda' => 'required', 
            'importe_compra' => 'required|numeric', 
            'fecha_compra' => 'required', 
            'dolar' => 'required|numeric',
            'estado' => 'required',
            'costo_criptomoneda_p' => 'required|numeric',
            'costo_criptomoneda_v' => 'required|numeric',
            'ganacia_criptomoneda' => 'required|numeric',
            'cliente_id' => 'required|numeric',
            'proveedor_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

         # verifico si hubo errores en la validaciones..
         if ($datosValidos->fails()) {
            $errors = $datosValidos->errors();
            # retorno error 400..
            return $this->errorResponse($errors, 400);
        }

        $formulario->update([
            'web' => $request->web,
            'compra_moneda' => $request->compra_moneda,
            'comision_prove' => $request->comision_prove,
            'comision_vendedor' => $request->comision_vendedor,
            'valor_comision_prove' => $request->valor_comision_prove,
            'valor_comision_vendedor' => $request->valor_comision_vendedor,
            'criptomoneda' => $request->criptomoneda,
            'tipo_criptomoneda' => $request->tipo_criptomoneda,
            'importe_compra' => $request->importe_compra,
            'fecha_compra' => $request->fecha_compra,
            'dolar' => $request->dolar,
            'estado' => $request->estado,
            'costo_criptomoneda_p' => $request->costo_criptomoneda_p,
            'costo_criptomoneda_v' => $request->costo_criptomoneda_v,
            'ganacia_criptomoneda' => $request->ganacia_criptomoneda,
            'cliente_id' => $request->cliente_id,
            'proveedor_id' => $request->proveedor_id,
            'user_id' => $request->user_id,
        ]);

        return $this->showOne($formulario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formulario $formulario)
    {
        $formulario->delete();
        return $this->successResponse('Formulario eliminado correctamente');
    }
}
