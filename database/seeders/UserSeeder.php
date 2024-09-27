<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Create random users
        for ($i = 0; $i < 10; $i++) { // Adjust the number of users as needed
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Use a default password or generate a random one
                'role' => $faker->randomElement(['admin', 'customer']), // Assign random role
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
