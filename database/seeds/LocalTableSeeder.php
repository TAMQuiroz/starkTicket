<?php

use Illuminate\Database\Seeder;
use App\Models\Local;

class LocalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Local::insert([  'name' 	=> 'Explanada del Jockey', 
        				'capacity'	=> 400, 
        				'address' 	=> 'Calle uno 862',
        				'district' 	=> 'San Borja',
        				'province'	=> 'Lima',
        				'state'		=> 'Lima',
        				'image'		=> 'images/examples/map1.PNG',
        				'rows'		=> null,
        				'columns'	=> null]);

        Local::insert([  'name'     => 'Maria Angola', 
                        'capacity'  => 100, 
                        'address'   => 'Av. Gregorio Escobedo 450',
                        'district'  => 'Miraflores',
                        'province'  => 'Lima',
                        'state'     => 'Lima',
                        'image'     => 'images/examples/map1.PNG',
                        'rows'      => 10,
                        'columns'   => 10]);
    }
}
