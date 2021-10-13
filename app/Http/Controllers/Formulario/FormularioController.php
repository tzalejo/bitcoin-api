<?php

namespace App\Http\Controllers\Formulario;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use App\Formulario;
use App\Http\Requests\StoreFormularioRequest;
use App\Http\Requests\UpdateFormularioRequest;

class FormularioController extends ApiController
{
    use ApiResponser;
    public function index(Request $request)
    {
        // return $request;
        // filtro usando scope
        $moneda = $request->get('compra_moneda');
        $cliente = $request->get('cliente');
        $estado = $request->get('estado');
        $fechaDesde = $request->get('fechaDesde');
        $fechaHasta = $request->get('fechaHasta');
        $criptomoneda = $request->get('tipo_criptomoneda');

        return Formulario::orderBy('id', 'ASC')
            ->with('proveedor')
            ->with('cliente')
            ->compra_moneda($moneda)
            ->estado($estado)
            ->cliente_id($cliente)
            ->tipo_criptomoneda($criptomoneda)
            ->fecha($fechaDesde, $fechaHasta)
            ->get();
    }

    public function store(StoreFormularioRequest $request): \Illuminate\Http\JsonResponse
    {
        # creo la comision
        $formularioNuevo = Formulario::create([
            'web' => ucwords(strtolower($request->web)),
            'compra_moneda' => ucwords(strtolower($request->compra_moneda)),
            'comision_prove' => $request->comision_prove,
            'comision_vendedor' => $request->comision_vendedor,
            'valor_comision_prove' => $request->valor_comision_prove,
            'valor_comision_vendedor' => $request->valor_comision_vendedor,
            'criptomoneda' => $request->criptomoneda,
            'tipo_criptomoneda' => ucwords(
                strtolower($request->tipo_criptomoneda)
            ),
            'importe_compra' => $request->importe_compra,
            'fecha_compra' => $request->fecha_compra,
            'fecha' => $request->fecha_compra, // guardo la misma fecha pero en formato date
            'dolar' => $request->dolar,
            'estado' => strtolower($request->estado),
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

    public function update(
        UpdateFormularioRequest $request,
        Formulario $formulario
    )
    {
        $formulario->update([
            'web' => ucwords(strtolower($request->web)),
            'compra_moneda' => ucwords(strtolower($request->compra_moneda)),
            'comision_prove' => $request->comision_prove,
            'comision_vendedor' => $request->comision_vendedor,
            'valor_comision_prove' => $request->valor_comision_prove,
            'valor_comision_vendedor' => $request->valor_comision_vendedor,
            'criptomoneda' => $request->criptomoneda,
            'tipo_criptomoneda' => ucwords(
                strtolower($request->tipo_criptomoneda)
            ),
            'importe_compra' => $request->importe_compra,
            'fecha_compra' => $request->fecha_compra,
            'fecha' => $request->fecha_compra, // guardo la misma fecha pero en formato date
            'dolar' => $request->dolar,
            'estado' => strtolower($request->estado),
            'costo_criptomoneda_p' => $request->costo_criptomoneda_p,
            'costo_criptomoneda_v' => $request->costo_criptomoneda_v,
            'ganacia_criptomoneda' => $request->ganacia_criptomoneda,
            'cliente_id' => $request->cliente_id,
            'proveedor_id' => $request->proveedor_id,
            'user_id' => $request->user_id,
        ]);

        return $this->showOne($formulario);
    }

    public function destroy(Formulario $formulario): \Illuminate\Http\Response
    {
        $formulario->delete();
        return $this->successResponse(
            'Formulario eliminado correctamente',
            200
        );
    }
}
