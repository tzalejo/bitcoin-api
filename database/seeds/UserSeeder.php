<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
        $user->email_verified_at = now();
        $user->save();
        factory(User::class)->times(2)->create();
    }
}
