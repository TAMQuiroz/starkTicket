<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class TestUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([  'name' => 'Cliente','lastname' => 'ApellidoC', 'di_type'=> config('constants.national'), 'di' => '46898966', 'address'=>'Av. Cliente #532 San Borja',
                        'email' => 'cliente@mail.com', 'phone' => '944133643', 'points'=>0, 'birthday'=>Carbon::create(1991,1,8)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>1, 'password' => bcrypt('cliente')]);

        User::insert([  'name' => 'Vendedor','lastname' => 'ApellidoV', 'di_type'=> config('constants.national'), 'di' => '54312666', 'address'=>'Av. Vendedor #532 San Borja',
                        'email' => 'vendedor@mail.com', 'phone' => '944133643', 'birthday'=>Carbon::create(1994,2,14)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>2, 'password' => bcrypt('vendedor')]);

        User::insert([  'name' => 'Promotor','lastname' => 'ApellidoP', 'di_type'=> config('constants.international'), 'di' => '42362311', 'address'=>'Av. Promotor #532 San Borja',
                        'email' => 'promotor@mail.com', 'phone' => '944133643', 'birthday'=>Carbon::create(1984,6,24)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>3, 'password' => bcrypt('promotor')]);

        User::insert([  'name' => 'Admin','lastname' => 'ApellidoA', 'di_type'=> config('constants.international'), 'di' => '64222267', 'address'=>'Av. Admin #532 San Borja',
                        'email' => 'admin@mail.com', 'phone' => '944133643', 'birthday'=>Carbon::create(1994,1,24)->toDateString(), 
                        'iniDate'=>Carbon::today(), 'role_id'=>4, 'password' => bcrypt('admin')]);




    }
}
