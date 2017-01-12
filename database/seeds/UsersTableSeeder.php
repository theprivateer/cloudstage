<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'   => 'Phil Stephens',
            'email' => 'phil@iseekplant.com.au',
            'password'  => bcrypt('password')
        ]);
    }
}
    