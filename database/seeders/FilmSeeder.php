<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $genres = ['Drama', 'Action', 'Comedy', 'Thriller', 'Sci-Fi', 'Horror', 'Animation', 'Romance', 'Crime', 'Adventure'];
        $countries = ['USA', 'UK', 'France', 'Germany', 'Spain', 'Italy', 'Japan', 'South Korea', 'Mexico', 'Canada'];

        for ($i = 0; $i < 20; $i++) {
            \App\Models\Film::create([
                'name' => $faker->unique()->sentence(3),
                'year' => $faker->year(),
                'genre' => $faker->randomElement($genres),
                'country' => $faker->randomElement($countries),
                'duration' => $faker->numberBetween(80, 200),
                'img_url' => $faker->imageUrl(255, 255, 'film', true),
            ]);
        }
    }
}
