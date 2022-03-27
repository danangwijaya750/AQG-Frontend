<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lessons')->delete();
        
        \DB::table('lessons')->insert(array (
            0 => 
            array (
                'created_at' => '2022-03-25 18:52:21',
                'id' => 1,
                'level_id' => 1,
                'title' => 'Bahasa Indonesia',
                'updated_at' => '2022-03-25 18:52:21',
            ),
            1 => 
            array (
                'created_at' => '2022-03-25 18:52:21',
                'id' => 2,
                'level_id' => 1,
                'title' => 'Pendidikan Kewarganegaraan',
                'updated_at' => '2022-03-25 18:52:21',
            ),
            2 => 
            array (
                'created_at' => '2022-03-25 18:52:21',
                'id' => 3,
                'level_id' => 1,
                'title' => 'Bahasa Inggris',
                'updated_at' => '2022-03-25 18:52:21',
            ),
            3 => 
            array (
                'created_at' => '2022-03-25 18:52:21',
                'id' => 4,
                'level_id' => 2,
                'title' => 'Fisika',
                'updated_at' => '2022-03-25 18:52:21',
            ),
            4 => 
            array (
                'created_at' => '2022-03-25 18:52:21',
                'id' => 5,
                'level_id' => 3,
                'title' => 'Biologi',
                'updated_at' => '2022-03-25 18:52:21',
            ),
            5 => 
            array (
                'created_at' => '2022-03-25 18:52:21',
                'id' => 6,
                'level_id' => 2,
                'title' => 'Agama Islam',
                'updated_at' => '2022-03-25 18:52:21',
            ),
            6 => 
            array (
                'created_at' => '2022-03-25 18:52:21',
                'id' => 7,
                'level_id' => 4,
                'title' => 'Basis Data',
                'updated_at' => '2022-03-25 18:52:21',
            ),
        ));
        
        
    }
}