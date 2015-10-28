<?php

use Illuminate\Database\Seeder;
use App\Models\accessPromotion;



class AccessPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

 	accessPromotion::insert(['description'=> 'CUALQUIER MODO DE PAGO']);
    
	accessPromotion::insert(['description'=> 'TODAS LAS TARJETAS']);
    
	accessPromotion::insert(['description'=> 'TARJETA INTERBANK']);
    
	accessPromotion::insert(['description'=> 'TARJETA BBVA']);
    

	accessPromotion::insert(['description'=> 'TARJETA CMR'	]);
    

    }
}
