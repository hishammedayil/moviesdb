<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MovieRepository
{
    /**
     * @var Movie
     */
    private $model;

    /**
     * MovieRepository constructor.
     * @param Movie $model
     */
    public function __construct(Movie $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $pageSize
     * @return LengthAwarePaginator
     */
    public function getPaginatedList(int $pageSize): LengthAwarePaginator
    {
        return $this->model->paginate($pageSize);
    }

    /**
     * @param array $movieData
     * @param Movie|null $movie
     * @return Movie
     */
    public function save(array $movieData, ?Movie $movie = null): Movie
    {
        if ($movie instanceof Movie) {
            $movie->update($movieData);
        } else {
            $movie = $this->model->create($movieData);
        }

        return $movie;
    }
}
