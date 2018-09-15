<?php

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('image_user')->insert([
            0 => [
                'image_id' => 39,
                'user_id' => 3,
                'rating' => 1,
            ],
            1 => [
                'image_id' => 40,
                'user_id' => 3,
                'rating' => 2,
            ],
            2 => [
                'image_id' => 37,
                'user_id' => 3,
                'rating' => 2,
            ],
            3 => [
                'image_id' => 43,
                'user_id' => 3,
                'rating' => 2,
            ],
            4 => [
                'image_id' => 39,
                'user_id' => 2,
                'rating' => 5,
            ],
            5 => [
                'image_id' => 37,
                'user_id' => 2,
                'rating' => 5,
            ],
            6 => [
                'image_id' => 41,
                'user_id' => 2,
                'rating' => 3,
            ],
            7 => [
                'image_id' => 36,
                'user_id' => 2,
                'rating' => 2,
            ],
            7 => [
                'image_id' => 31,
                'user_id' => 3,
                'rating' => 3,
            ],
            8 => [
                'image_id' => 32,
                'user_id' => 3,
                'rating' => 3,
            ]
        ]);
    }
}