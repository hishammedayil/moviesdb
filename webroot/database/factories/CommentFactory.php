<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::all()->random(1)->first()->id;
        return [
            'movie_id' => Movie::all()->random(1)->first()->id,
            'comment' => $this->faker->paragraph(2, true),
            'created_by_id' => $userId,
            'updated_by_id' => $userId,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
