<?php

use Illuminate\Database\Seeder;
use App\Models\politics;
class politicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
           politics::insert([  'name' => 'Politica Reserva','description' => 'Las reservas se guardan durante 1 día', 'state'=> 'Activo']);

            politics::insert([  'name' => 'Cancelacion Evento','description' => 'Si el cantante no se muere ni se enferma y ya se vendieron tickets no se puede cancelar el evento', 'state'=> 'Inactivo']);

    }
}
