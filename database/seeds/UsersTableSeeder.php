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
            'name'   => 'John Snow',
            'email' => 'john@stark.com',
            'password'  => bcrypt('winter')
        ]);
    }
}
    