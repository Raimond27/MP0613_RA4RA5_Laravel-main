<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $films = \App\Models\Film::all();
        $actors = \App\Models\Actor::all();

        // Asignar aleatoriamente actores a películas (2-4 actores por película)
        foreach ($films as $film) {
            $numActors = $faker->numberBetween(2, 4);
            $randomActors = $actors->random($numActors);

            foreach ($randomActors as $actor) {
                // Evitar registros duplicados
                if (!$film->actors()->where('actor_id', $actor->id)->exists()) {
                    $film->actors()->attach($actor->id, [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
