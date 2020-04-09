<?php

use App\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creo un proveedor manua
        $prove = new Proveedor();
        $prove->nombre = 'Beto';
        $prove->apellido = 'Delgado';
        $prove->telefono = '4445577';
        $prove->email = 'beto@gmail.com';
        $prove->save();
        // luego genero con el factory dos mas
        factory(Proveedor::class)->times(2)->create();
    }
}
