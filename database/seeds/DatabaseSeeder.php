<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         // creo el usuario director.
         $user= new User();
         $user->name = 'Alejandro';
         $user->email = 'tzalejo@gmail.com';
         $user->password = bcrypt('secret');
         $user->save();
         
    }
}
