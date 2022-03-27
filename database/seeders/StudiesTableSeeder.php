<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StudiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('studies')->delete();
        
        \DB::table('studies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'lesson_id' => 1,
                'title' => 'Judul',
                'desc' => 'skasalksaldkasldkasld',
                'is_sharing' => 0,
                'created_at' => '2022-03-21 11:47:44',
                'updated_at' => '2022-03-21 11:47:44',
            ),
        ));
        
        
    }
}