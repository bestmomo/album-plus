<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('notifications')->insert([
            0 => [
                'id' => '6bd79182-0d88-48b7-8e4e-59dbf3371763',
                'type' => 'App\Notifications\ImageRated',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => '2',
                'data' => '{"image":"hVCKABCaItIPhop9nQZBoZb7CFFwgGCYYTLgQEvE.jpeg","image_id":31,"rate":3,"user":3}'
            ],
            1 => [
                'id' => '6c7b833c-4a12-44d5-8fbe-f542e688b865',
                'type' => 'App\Notifications\ImageRated',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => '2',
                'data' => '{"image":"RvlsdZqwNw6fIWoQCsb13uFw1W4DiDRHuU4tZONT.jpeg","image_id":32,"rate":5,"user":3}'
            ],
        ]);
    }
}