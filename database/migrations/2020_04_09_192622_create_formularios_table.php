<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->id();
            
            $table->string('web');
            $table->string('compra_moneda',20);// peso, dolar, euro, monedavirtual
            $table->float('comision_prove');
            $table->float('comision_vendedor');
            $table->float('valor_comision_prove');
            $table->float('valor_comision_vendedor');
            $table->float('criptomoneda'); 
            $table->string('tipo_criptomoneda',20);
            
            $table->float('importe_compra');
            $table->string('fecha_compra');
            $table->float('dolar');
            $table->string('estado',1); // v: venta y p: prresupuesto
            $table->float('costo_criptomoneda_p');
            $table->float('costo_criptomoneda_v');

            $table->float('ganacia_criptomoneda'); // guardo la ganancia de la critomoneda


            // relaciones
            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->unsignedInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formularios');
    }
}
