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
        Category::insert([
                    'name' => 'Conciertos',
                    'description'=> 'Descripcion de Conciertos',
                    'image' => 'images/examples/category.jpg',
                    'type' => 1,
                    'father_id' => null]);

        Category::insert([
                    'name' => 'Teatro',
                    'description'=> 'Descripcion de Teatro',
                    'image' => 'images/examples/category.jpg',
                    'type' => 1,
                    'father_id' => null]);

        Category::insert([
                    'name' => 'Entretenimiento',
                    'description'=> 'Descripcion de Entretenimiento',
                    'image' => 'images/examples/category.jpg',
                    'type' => 1,
                    'father_id' => null]);

        Category::insert([
                    'name' => 'Deporte',
                    'description'=> 'Descripcion de Deporte',
                    'image' => 'images/examples/category.jpg',
                    'type' => 1,
                    'father_id' => null]);

        Category::insert([
                    'name' => 'Opera/zarzuela',
                    'description'=> 'Descripcion de Opera/zarzuela',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Música',
                    'description'=> 'Descripcion de Música',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Rock',
                    'description'=> 'Descripcion de Rock',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Electrónica',
                    'description'=> 'Descripcion de Electrónica',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Reggae',
                    'description'=> 'Descripcion de Reggae',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Drama',
                    'description'=> 'Descripcion de Drama',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Comedia',
                    'description'=> 'Descripcion de Comedia',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Musical',
                    'description'=> 'Descripcion de Musical',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Ballet',
                    'description'=> 'Descripcion de Ballet',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Adultos',
                    'description'=> 'Descripcion de Adultos',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Sociales',
                    'description'=> 'Descripcion de Sociales',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Fiestas',
                    'description'=> 'Descripcion de Fiestas',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Peñas',
                    'description'=> 'Descripcion de Peñas',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Tours',
                    'description'=> 'Descripcion de Tours',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Ferias',
                    'description'=> 'Descripcion de Ferias',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Futbol',
                    'description'=> 'Descripcion de Futbol',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 4]);
        Category::insert([
                    'name' => 'Automovilistmo',
                    'description'=> 'Descripcion de Automovilistmo',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 4]);
        Category::insert([
                    'name' => 'Maratón',
                    'description'=> 'Descripcion de Maratón',
                    'image' => 'images/examples/subcategory.jpg',
                    'type' => 2,
                    'father_id' => 4]);

    }
}
