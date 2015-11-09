<?php

use Illuminate\Database\Seeder;
use App\Models\ModuleAssigment;
use Carbon\Carbon;
class ModuleAssigmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
           ModuleAssigment::insert([ 'module_id' => 1,
           				'salesman_id' 	=> 2,
        				'status' 	=> 1,
        				'dateAssigments'	=>	Carbon::create(2011, 1, 1, 8, 0, 0)]);

           ModuleAssigment::insert([ 'module_id' => 2,
                        'salesman_id'   => 5,
                        'status'    => 1,
                        'dateAssigments'    =>  Carbon::create(2011, 1, 1, 8, 0, 0)]);
    }
}
