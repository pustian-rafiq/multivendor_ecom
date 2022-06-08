<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UserTableSeeder::class);

        //  \App\User::factory(50)->create();
         factory( \App\User::class,50)->create();
    }
}
