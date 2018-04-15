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
          $id = DB::table('users')->insertGetId([
            'firstname' => $faker->firstName,
            'middlename' => $faker->lastName,
            'lastname' => $faker->lastName,
            'username' => $i == 1 ? 'admin' : $faker->username,
            'password' => bcrypt('password'),
            'contact_number' => $faker->phoneNumber,
            'email_address' => $faker->email,
            'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'role' => $i == 1 ? 'admin' : 'client',
            'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
            'updated_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null)
          ]);

          if($i != 1){

            DB::table('educations')->insert([
              'user_id' => $id,
              'current_tuition' => floor($faker->numberBetween(1000,30000)),
              'current_child_age' => floor($faker->numberBetween(1,15)),
              'age_to_enter_college' => floor($faker->numberBetween(16,20)),
              'years_in_college' => floor($faker->numberBetween(1,15)),
              'assumed_annual_increase_tuition_fee' => floor($faker->numberBetween(1,10)),
              'future_annual_increase_tuition_fee' => floor($faker->numberBetween(1,10)),
              'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
              'updated_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null)
            ]);

            DB::table('retirements')->insert([
              'user_id' => $id,
              'monthly_income' => floor($faker->numberBetween(10000,50000)),
              'inflation_rate' => floor($faker->numberBetween(1,10)),
              'current_age' => floor($faker->numberBetween(18,59)),
              'retirement_age' => floor($faker->numberBetween(60,65)),
              'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
              'updated_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null)
            ]);

            DB::table('emergency_funds')->insert([
              'user_id' => $id,
              'monthly_income' => floor($faker->numberBetween(10000,50000)),
              'advisable_fund' => floor($faker->numberBetween(10000,200000)),
              'allotment_of_income' => floor($faker->numberBetween(1,30)),
              'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
              'updated_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null)
            ]);

            DB::table('accumulations')->insert([
              'user_id' => $id,
              'annual_increase_savings_yr_1_5' => floor($faker->numberBetween(1,10)),
              'annual_increase_savings_yr_6_10' => floor($faker->numberBetween(1,10)),
              'annual_increase_savings_yr_11_up' => floor($faker->numberBetween(1,10)),
              'annual_return_investment_yr_1_5' => floor($faker->numberBetween(1,10)),
              'annual_return_investment_yr_6_10' => floor($faker->numberBetween(1,10)),
              'annual_return_investment_yr_11_up' => floor($faker->numberBetween(1,10)),
              'starting_amount_monthly' => floor($faker->numberBetween(1000,10000)),
              'years_to_accumulate_fund' => floor($faker->numberBetween(10,60)),
              'start_up_fund' => floor($faker->numberBetween(1000,30000)),
              'created_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
              'updated_at' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null)
            ]);
          }
        }

    }
}
