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
        $prove->dni = '12345678';
        $prove->nombre = 'Beto';
        $prove->apellido = 'Delgado';
        $prove->telefono = '4445577';
        $prove->email = 'beto@gmail.com';
        $prove->save();
        // luego genero con el factory dos mas
        factory(Proveedor::class)->times(5)->create();
    }
}
