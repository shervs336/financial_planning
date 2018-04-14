<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=1; $i <= 25; $i++){
          DB::table('users')->insert([
            'name' => $faker->name,
            'username' => $i == 1 ? 'admin' : $faker->username,
            'password' => bcrypt('password'),
            'role' => $i == 1 ? 'admin' : 'client'
          ]);
        }

    }
}
