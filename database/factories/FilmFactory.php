<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = ['Drama', 'Action', 'Comedy', 'Thriller', 'Sci-Fi', 'Horror', 'Animation', 'Romance', 'Crime', 'Adventure'];
        $countries = ['USA', 'UK', 'France', 'Germany', 'Spain', 'Italy', 'Japan', 'South Korea', 'Mexico', 'Canada'];

        return [
            'name' => $this->faker->unique()->sentence(3),
            'year' => $this->faker->year(),
            'genre' => $this->faker->randomElement($genres),
            'country' => $this->faker->randomElement($countries),
            'duration' => $this->faker->numberBetween(80, 200),
            'img_url' => $this->faker->imageUrl(255, 255, 'film', true),
        ];
    }
}
