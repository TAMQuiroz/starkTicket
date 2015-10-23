<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([  'name' => 'Categoria 1', 
        				'description'=> 'Descripcion de categoria 1', 
        				'image' => asset('images/examples/Local.jpg'),
                        'type' => 1, 
                        'father_id' => null]);
    }
}
