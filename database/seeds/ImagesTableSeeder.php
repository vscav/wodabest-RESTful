<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'public/img/model';
        $dest = 'public/img/upload/';
        if(is_dir($path))
        {
            $handle = opendir($path);
            while (($file = readdir($handle)) !== false)
            {
                if ($file != '.' && $file != '..' && $file != '.DS_Store')
                {
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $options = [
                        'jpg',
                        'JPG',
                        'jpeg',
                        'JPEG',
                        'png',
                        'PNG'
                    ];

                    if (in_array($extension, $options))
                    {
                         $title = str_slug(basename($file, ".".$extension));
                         $filename = $file;

                         copy($path . '/' . $filename, $dest . $filename);

                        DB::table('images')->insert([
                            'user_id' => rand(1, 3),
                            'category_id' => rand(1, 7),
                            'title' => $title,
                            'filename' => $filename,
                            'description' => Str::random(50),
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
            closedir($handle);
        }
    }
}
