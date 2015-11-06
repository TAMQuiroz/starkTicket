<?php

use Illuminate\Database\Seeder;
use App\Models\Module;
use Carbon\Carbon;
class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
           Module::insert([  'name' => 'Punto 1',
           				'address' 	=> 'Calle 100',
        				'district' 	=> 'San Miguel',
        				'province'	=> 'Lima',
        				'state'		=> 'Lima',
        				'phone'		=> '214424214',
        				'email'		=> 'punto1@mail.com',
        				'cash'		=>  100.00,
        				'starTime'	=>	Carbon::create(2011, 1, 1, 8, 0, 0),
        				'endTime'	=>	Carbon::create(2011, 1, 1, 17, 0, 0),
        				'image'		=> 'images/examples/map1.PNG']);
    }
}
