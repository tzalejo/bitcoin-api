<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'web', 
        'compra_moneda', 
        'comision_prove', 
        'comision_vendedor', 
        'valor_comision_prove', // valor de la comision prove
        'valor_comision_vendedor', // valor de la comision vendedor
        'criptomoneda', 
        'tipo_criptomoneda', 
        'importe_compra', 
        'fecha_compra', 
        'dolar',
        'estado',
        'costo_criptomoneda_p',  // es cuanto sale la criptomoneda con respecto a la comision del proveedor (comision + criptomoneda)
        'costo_criptomoneda_v',  // es cuanto sale la criptomoneda con respecto a la comision del vendedor (comision + criptomoneda)
        'ganacia_criptomoneda',  // ganancia en criptomoneda
        'cliente_id',
        'proveedor_id',
        'user_id'
    ];

    public function proveedor() {
        return $this->belongsTo(Proveedor::class);
    }

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }



}
