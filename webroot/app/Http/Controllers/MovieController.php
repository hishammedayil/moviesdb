<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Movie;
use App\Repositories\GenreRepository;
use App\Services\ImageUploadService;
use App\Services\MovieService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MovieController extends Controller
{
    /**
     * @var MovieService
     */
    private $movieService;

    /**
     * @var GenreRepository
     */
    private $genreRepository;

    /**
     * @var ImageUploadService
     */
    private $imageUploadService;

    /**
     * MovieController constructor.
     * @param MovieService $movieService
     * @param GenreRepository $genreRepository
     * @param ImageUploadService $imageUploadService
     */
    public function __construct(
        MovieService $movieService,
        GenreRepository $genreRepository,
        ImageUploadService $imageUploadService
    ) {
        $this->movieService = $movieService;
        $this->genreRepository = $genreRepository;
        $this->imageUploadService = $imageUploadService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): View
    {
        return view('movies.list', ['movies' => $this->movieService->getPaginatedList(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): View
    {
        return view(
            'movies.form',
            [
                'movie' => new Movie(),
                'genres' => $this->genreRepository->allAsArray()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMovieRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMovieRequest $request): RedirectResponse
    {
        $movieData = $request->getFillables();

        try {
            $movieData['cover_image'] = $this->imageUploadService->upload($request->getCoverImage());
        } catch (Exception | GuzzleException $e) {
            return redirect()
                ->route('movies.create')
                ->withInput($request->input())
                ->withErrors([
                    'cover_image' => 'Invalid file provided'
                ]);
        }

        $this->movieService->save($movieData);

        return redirect()->route('movies.index');
    }

    /**
     * Display the specified movie.
     *
     * @param Movie $movie
     * @return View
     */
    public function show(Movie $movie): View
    {
        return view('movies.show', ['movie' => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Movie $movie
     * @return View
     */
    public function edit(Movie $movie): View
    {
        return view(
            'movies.form',
            [
                'movie' => $movie,
                'genres' => $this->genreRepository->allAsArray()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreMovieRequest $request
     * @param Movie $movie
     * @return RedirectResponse
     */
    public function update(StoreMovieRequest $request, Movie $movie): RedirectResponse
    {
        $movieData = $request->getFillables();

        try {
            $coverImage = $request->getCoverImage();
            if ($coverImage) {
                $movieData['cover_image'] = $this->imageUploadService->upload($request->getCoverImage());
            }
        } catch (Exception | GuzzleException $e) {
            return redirect()
                ->route('movies.edit', [$movie])
                ->withInput($request->input())
                ->withErrors([
                    'cover_image' => 'Invalid file provided'
                ]);
        }

        $this->movieService->save($movieData, $movie);

        return redirect()->route('movies.show', [$movie]);
    }
}
