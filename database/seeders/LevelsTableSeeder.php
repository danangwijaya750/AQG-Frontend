<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('levels')->delete();
        
        \DB::table('levels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'SD',
                'created_at' => '2022-03-20 21:39:43',
                'updated_at' => '2022-03-20 21:39:43',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'SMP',
                'created_at' => '2022-03-20 21:39:43',
                'updated_at' => '2022-03-20 21:39:43',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'SMA',
                'created_at' => '2022-03-20 21:39:43',
                'updated_at' => '2022-03-20 21:39:43',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'SMK',
                'created_at' => '2022-03-20 21:39:43',
                'updated_at' => '2022-03-20 21:39:43',
            ),
        ));
        
        
    }
}