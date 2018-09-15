<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'name' => 'Durand',
            'email' => 'durand@chezlui.fr',
            'role' => 'admin',
            'password' => bcrypt('admin'),
            'settings' => '{"pagination": 8, "adult": true}',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Dupont',
            'email' => 'dupont@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => '{"pagination": 8, "adult": true}',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Martin',
            'email' => 'martin@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => '{"pagination": 8, "adult": true}',
            'email_verified_at' => Carbon::now(),
        ]);
    }
}