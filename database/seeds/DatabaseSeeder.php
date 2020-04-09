<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         # $this->call(UsersTableSeeder::class);
         $this->truncateTables([
            'users', 'clientes', 'proveedors' //, 'roles', 'materias','cursos','comisiones', 'matriculas', 'cuotas', 'estudiantes' , 'pagos', 'curso_materia'
        ]);
        
        # La creación de datos de roles debe ejecutarse primero
        // $this->call(RoleTablaSeeder::class);
        # Los usuarios necesitarán los roles previamente generados
        $this->call(UserSeeder::class);
        
        # Cliente
        $this->call(ClienteSeeder::class);
        # Proveedores
        $this->call(ProveedorSeeder::class);
        
        // $this->call(CursoSeeder::class);
        // $this->call(ComisionSeeder::class);
        // $this->call(MatriculaSeeder::class);
        // $this->call(CuotaSeeder::class);
        // $this->call(PagoSeeder::class);
        // $this->call(CursoMateriaSeeder::class);

        # ejecuto la instalacion de passport! -Gracias Roimar!!!
        Artisan::call('passport:install');       
    }
     /**
     * Creo una fc para desactivar y activar la revision de foreign key,
     * es muy util porque a veces las tablas tienen restricciones q no
     * dejan correr al seed.
     *
     *
     */
    protected function truncateTables(array $tables)
    {
        
        # para desactivar la revision de llave foranea en la bd
        Schema::disableForeignKeyConstraints();
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        # para activar la revision.
        Schema::enableForeignKeyConstraints();
    }
}
