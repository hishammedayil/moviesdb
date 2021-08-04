<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence($this->faker->numberBetween(1, 5)),
            'description' => $this->faker->paragraph,
            'released_on' => $this->faker->date,
            'rating' => $this->faker->numberBetween(1, 5),
            'ticket_price' => $this->faker->randomFloat(2, 0, 999),
            'country' => $this->faker->country,
            'cover_image' => $this->faker->imageUrl
        ];
    }
}
