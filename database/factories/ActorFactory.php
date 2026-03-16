<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Actor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countries = ['USA', 'UK', 'France', 'Germany', 'Spain', 'Italy', 'Japan', 'South Korea', 'Mexico', 'Canada', 'Australia'];

        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'birthdate' => $this->faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'country' => $this->faker->randomElement($countries),
            'img_url' => $this->faker->imageUrl(255, 255, 'actor', true),
        ];
    }
}
