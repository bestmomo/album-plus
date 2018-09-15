<?php

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('albums')->delete();
        
        \DB::table('albums')->insert(array (
            0 => 
            array (
                'name' => 'Album 1',
                'slug' => 'album-1',
                'user_id' => 1,
                'created_at' => '2018-02-25 12:07:18',
                'updated_at' => '2018-02-25 12:07:18',
            ),
            1 => 
            array (
                'name' => 'Album 2',
                'slug' => 'album-2',
                'user_id' => 1,
                'created_at' => '2018-02-25 12:07:24',
                'updated_at' => '2018-02-25 12:07:24',
            ),
            2 => 
            array (
                'name' => 'Album 3',
                'slug' => 'album-3',
                'user_id' => 1,
                'created_at' => '2018-02-25 12:07:28',
                'updated_at' => '2018-02-25 12:07:28',
            ),
        ));
        
        
    }
}