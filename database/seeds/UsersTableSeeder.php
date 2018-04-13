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
        DB::table('users')->insert([
          'name' => $faker->name,
          'username' => 'admin',
          'password' => bcrypt('password'),
          'role' => 'admin'
        ]);
    }
}
