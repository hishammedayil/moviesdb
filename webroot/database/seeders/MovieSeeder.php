<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::factory()
            ->count(10)
            ->create();

        $genres = Genre::all();
        Movie::all()->each(function (Movie $movie) use ($genres) {
            $movie->genres()->attach(
                $genres->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
    }
}
