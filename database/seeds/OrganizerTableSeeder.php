<?php

use Illuminate\Database\Seeder;
use App\Models\Organizer;

class OrganizerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organizer::insert([ 'organizerName' 		=> 'Organizador 1', 
        					'organizerLastName'		=> 'Apellido 1', 
        					'businessName'		 	=> 'Locuron S.A.C',
        					'ruc'				 	=> '12345678912',
        					'countNumber'			=> 939494319,
        					'telephone'				=> 977299156,
        					'dni'					=> '46898966',
        					'email'					=> 'organizador@mail.com',
        					'address'				=> 'Calle las calles #666',
        					'image'					=> 'image/example/Local.jpg']);
    }
}
