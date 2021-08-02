<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormularioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
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
            // 'fecha' => '',
            'dolar' => 'required|numeric',
            'estado' => 'required',
            'costo_criptomoneda_p' => 'required|numeric',
            'costo_criptomoneda_v' => 'required|numeric',
            'ganacia_criptomoneda' => 'required|numeric',
            'cliente_id' => 'required|numeric',
            'proveedor_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
    }
}
