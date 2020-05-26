<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Nils Landrodie',
                'email' => 'nilsland31@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            /*[
                'name' => 'Mattéo Popoff',
                'email' => 'pmatteo98@gmail.com',
                'password' => Hash::make('password')
            ],*/
            [
                'name' => 'Cloé Quirin',
                'email' => 'cloequirin3@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Léa Rostoker',
                'email' => 'lea.rostoker.12@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            /*[
                'name' => 'Vincent Scavinner',
                'email' => 'vscavinner@gmail.com',
                'password' => Hash::make('password')
            ]*/
        ]);
    }
}
