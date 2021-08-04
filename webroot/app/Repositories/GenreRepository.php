<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository
{
    /**
     * @var Genre
     */
    private $model;

    /**
     * GenreRepository constructor.
     * @param Genre $model
     */
    public function __construct(Genre $model)
    {
        $this->model = $model;
    }

    public function allAsArray(): array
    {
        return $this->model->all('id', 'name')->toArray();
    }
}
