<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(AlbumsTableSeeder::class);
        $this->call(AlbumImageTableSeeder::class);
        $this->call(RatingsTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
    }
}
