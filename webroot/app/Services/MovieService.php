<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Movie;
use App\Repositories\MovieRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class MovieService
 * @package App\Services
 */
class MovieService
{
    /**
     * @var MovieRepository
     */
    private $movieRepository;

    /**
     * MovieService constructor.
     * @param MovieRepository $movieRepository
     */
    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    /**
     * @param int $pageSize
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(int $pageSize): LengthAwarePaginator
    {
        return $this->movieRepository->getPaginatedList($pageSize);
    }

    /**
     * @param array $movieData
     * @param Movie|null $movie
     * @return Movie
     */
    public function save(array $movieData, ?Movie $movie = null): Movie
    {
        $genres = $movieData['genres'];
        $movie = $this->movieRepository->save($movieData, $movie);
        $movie->genres()->detach();
        $movie->genres()->attach($genres);

        return $movie;
    }
}
