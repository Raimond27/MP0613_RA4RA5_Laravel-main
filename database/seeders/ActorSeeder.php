<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $countries = ['USA', 'UK', 'France', 'Germany', 'Spain', 'Italy', 'Japan', 'South Korea', 'Mexico', 'Canada', 'Australia'];

        for ($i = 0; $i < 30; $i++) {
            \App\Models\Actor::create([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'birthdate' => $faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
                'country' => $faker->randomElement($countries),
                'img_url' => $faker->imageUrl(255, 255, 'actor', true),
            ]);
        }
    }
}
