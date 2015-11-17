<?php

use Illuminate\Database\Seeder;
use App\Models\Business;
class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::insert([
            'business_name'	=>	'Teleticke',
            'ruc'			=>	12345678912,
            'address'		=>	'Monte del destino #423 Mordor Tierra Media',
            'reserve_time'  =>  24,
            'logo'			=>	asset('images/logo.jpg'),
            'favicon'		=>	asset('images/teletickeico.jpg'),
        ]);
    }
}
