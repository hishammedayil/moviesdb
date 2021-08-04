<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * @return array
     */
    private static function getGenres(): array
    {
        return array_map(function ($val) {
            $now = now();
            return [
                'slug' => preg_replace('/\s+/', '-', strtolower($val)),
                'name' => $val,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }, [
            'Action',
            'Adventure',
            'Animated',
            'Biography',
            'Comedy',
            'Crime',
            'Dance',
            'Disaster',
            'Documentary',
            'Drama',
            'Erotic',
            'Family',
            'Fantasy',
            'Found Footage',
            'Historical',
            'Horror',
            'Independent',
            'Legal',
            'Live Action',
            'Martial Arts',
            'Musical',
            'Mystery',
            'Noir',
            'Performance',
            'Political',
            'Romance',
            'Satire',
            'Science Fiction',
            'Short',
            'Silent',
            'Slasher',
            'Sports',
            'Spy',
            'Superhero',
            'Supernatural',
            'Suspense',
            'Teen',
            'Thriller',
            'War',
            'Western'
        ]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert(self::getGenres());
    }
}
