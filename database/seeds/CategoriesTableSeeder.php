<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['3D', 'Design', 'Identité graphique', 'Illustration', 'Peinture', 'Photographie', 'Web Design'];
        DB::table('categories')->insert([
            [
                'name' => $names[0],
                'slug' => str_slug($names[0])
            ],
            [
                'name' => $names[1],
                'slug' => str_slug($names[1])
            ],
            [
                'name' => $names[2],
                'slug' => str_slug($names[2])
            ],
            [
                'name' => $names[3],
                'slug' => str_slug($names[3])
            ],
            [
                'name' => $names[4],
                'slug' => str_slug($names[4])
            ],
            [
                'name' => $names[5],
                'slug' => str_slug($names[5])
            ],
            [
                'name' => $names[6],
                'slug' => str_slug($names[6])
            ],
        ]);
    }
}
