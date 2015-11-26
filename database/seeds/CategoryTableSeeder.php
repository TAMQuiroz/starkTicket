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
                    'image' => 'images/conciertos.png',
                    'type' => 1,
                    'father_id' => null]);

        Category::insert([
                    'name' => 'Teatro',
                    'description'=> 'Descripcion de Teatro',
                    'image' => 'images/teatro.png',
                    'type' => 1,
                    'father_id' => null]);

        Category::insert([
                    'name' => 'Entretenimiento',
                    'description'=> 'Descripcion de Entretenimiento',
                    'image' => 'images/entretenimiento.png',
                    'type' => 1,
                    'father_id' => null]);

        Category::insert([
                    'name' => 'Deporte',
                    'description'=> 'Descripcion de Deporte',
                    'image' => 'images/deporte.png',
                    'type' => 1,
                    'father_id' => null]);

        Category::insert([
                    'name' => 'Opera/zarzuela',
                    'description'=> 'Descripcion de Opera/zarzuela',
                    'image' => 'images/opera.png',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Música',
                    'description'=> 'Descripcion de Música',
                    'image' => 'images/musica.png',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Rock',
                    'description'=> 'Descripcion de Rock',
                    'image' => 'images/rock.png',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Electrónica',
                    'description'=> 'Descripcion de Electrónica',
                    'image' => 'images/electronica.png',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Reggae',
                    'description'=> 'Descripcion de Reggae',
                    'image' => 'images/reggae.png',
                    'type' => 2,
                    'father_id' => 1]);
        Category::insert([
                    'name' => 'Drama',
                    'description'=> 'Descripcion de Drama',
                    'image' => 'images/drama.png',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Comedia',
                    'description'=> 'Descripcion de Comedia',
                    'image' => 'images/comedia.png',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Musical',
                    'description'=> 'Descripcion de Musical',
                    'image' => 'images/musical.png',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Ballet',
                    'description'=> 'Descripcion de Ballet',
                    'image' => 'images/ballet.png',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Adultos',
                    'description'=> 'Descripcion de Adultos',
                    'image' => 'images/adultos.png',
                    'type' => 2,
                    'father_id' => 2]);
        Category::insert([
                    'name' => 'Sociales',
                    'description'=> 'Descripcion de Sociales',
                    'image' => 'images/sociales.png',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Fiestas',
                    'description'=> 'Descripcion de Fiestas',
                    'image' => 'images/fiestas.png',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Peñas',
                    'description'=> 'Descripcion de Peñas',
                    'image' => 'images/peñas.png',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Tours',
                    'description'=> 'Descripcion de Tours',
                    'image' => 'images/tours.png',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Ferias',
                    'description'=> 'Descripcion de Ferias',
                    'image' => 'images/ferias.png',
                    'type' => 2,
                    'father_id' => 3]);
        Category::insert([
                    'name' => 'Futbol',
                    'description'=> 'Descripcion de Futbol',
                    'image' => 'images/futbol.png',
                    'type' => 2,
                    'father_id' => 4]);
        Category::insert([
                    'name' => 'Automovilistmo',
                    'description'=> 'Descripcion de Automovilismo',
                    'image' => 'images/automovilismo.png',
                    'type' => 2,
                    'father_id' => 4]);
        Category::insert([
                    'name' => 'Maratón',
                    'description'=> 'Descripcion de Maratón',
                    'image' => 'images/maraton.png',
                    'type' => 2,
                    'father_id' => 4]);

    }
}
