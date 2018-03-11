<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('123456'),
            'is_admin' => 1,
            'remember_token' => str_random(10),
        ]);
    }
}
