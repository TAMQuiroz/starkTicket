<?php

use Illuminate\Database\Seeder;
use App\User;

class TestUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(['name' => 'Cliente', 'email' => 'cliente@mail.com', 'role_id'=>1, 'password' => bcrypt('cliente')]);
        User::insert(['name' => 'Vendedor', 'email' => 'vendedor@mail.com', 'role_id'=>2, 'password' => bcrypt('vendedor')]);
        User::insert(['name' => 'Promotor', 'email' => 'promotor@mail.com', 'role_id'=>3, 'password' => bcrypt('promotor')]);
        User::insert(['name' => 'Administrador', 'email' => 'admin@mail.com', 'role_id'=>4, 'password' => bcrypt('admin')]);
    }
}
