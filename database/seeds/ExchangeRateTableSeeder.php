<?php

use Illuminate\Database\Seeder;
use App\Models\ExchangeRate;
use Carbon\Carbon;
class ExchangeRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
           ExchangeRate::insert([  'buyingRate' => 2.98,'sellingRate' => 3.01, 'status'=> 1, 'startDate' => Carbon::create(2015,10,8)->toDateString(), 'finishDate' => null]);
            
    }
}
