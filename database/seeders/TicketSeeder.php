<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create random tickets
        for ($i = 0; $i < 10; $i++) {
            DB::table('tickets')->insert([
                'user_id' => rand(1, 10), // Assuming you have 10 users
                'issue' => $faker->sentence,
                'status' => $faker->randomElement(['open', 'closed']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
