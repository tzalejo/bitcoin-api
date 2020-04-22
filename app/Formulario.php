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
        'fecha', 
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

    // Scope, los filtros que vamos a utilizar..

    public function scopeCompra_moneda($query, $compra_moneda) {
        if ($compra_moneda) {
            # code...
            $moneda = ucwords(strtolower($compra_moneda));
            return $query->where('compra_moneda', 'LIKE' , "%$moneda%");
        }
        
    }

    public function scopeFecha($query, $fechaDesde, $fechaHasta) {
        // '2020-04-13 15:14:29'
        // DateTime::createFromFormat('Y-m-d H:i:s', '2020-04-13 15:14:29');
        if ($fechaDesde) {
            # code...
            if ($fechaHasta) {
                # code...
                $miDesde = date($fechaDesde);
                $miHasta = date($fechaHasta);
                return $query->whereBetween('fecha', [$miDesde, $miHasta]);
            }
        }
    }

    public function scopeTipo_criptomoneda($query, $tipo_criptomoneda) {
        if ($tipo_criptomoneda) {
            # code...
            $moneda = ucwords(strtolower($tipo_criptomoneda));
            return $query->where('tipo_criptomoneda', 'LIKE' , "%$moneda%");
        }
        
    }

    public function scopeEstado($query, $estado) {
        if ($estado) {
            # code...
            $estadoNuevo = strtolower($estado);
            return $query->where('estado' ,$estadoNuevo);
        }
        
    }

    public function scopeCliente_id($query, $cliente_id) {
        if ($cliente_id) {
            # code...
            return $query->where('cliente_id' ,$cliente_id);
        }
        
    }
}
