<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelacionClieteProveedorUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // relaciones
        Schema::table('formularios',function(Blueprint $table){
            $table->bigInteger('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('set null')->onUpdate('cascade');
            $table->bigInteger('proveedor_id')->unsigned()->nullable();
            $table->foreign('proveedor_id')->references('id')->on('proveedors')->onDelete('set null')->onUpdate('cascade');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

        });
   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Elimino la relaciones..
        Schema::table('formularios',function(Blueprint $table){
            $table->dropForeign('formularios_cliente_id_foreign');
            $table->dropColumn('cliente_id');
            
            $table->dropForeign('formularios_proveedor_id_foreign');
            $table->dropColumn('proveedor_id');
            
            $table->dropForeign('formularios_user_id_foreign');
            $table->dropColumn('user_id');

        });

    }
}
