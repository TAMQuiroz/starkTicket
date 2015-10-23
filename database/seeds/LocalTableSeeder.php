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
        Local::insert([  'name' 	=> 'Local 1', 
        				'capacity'	=> 400, 
        				'address' 	=> 'Calle uno #862',
        				'district' 	=> 'San Borja',
        				'province'	=> 'Lima',
        				'state'		=> 'Lima',
        				'image'		=> asset('images/examples/Local.jpg'),
        				'row'		=> 20,
        				'column'	=> 20]);
    }
}
