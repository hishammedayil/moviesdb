<?php

namespace App\Http\Controllers;

use App\Events\NewComment;
use App\Http\Requests\StoreCommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var Guard
     */
    private $guard;

    /**
     * @var BroadcastManager
     */
    private $broadcastManager;


    /**
     * CommentController constructor.
     * @param CommentRepository $movieRepository
     * @param Guard $guard
     * @param BroadcastManager $broadcastManager
     */
    public function __construct(CommentRepository $movieRepository, Guard $guard, BroadcastManager $broadcastManager)
    {
        $this->commentRepository = $movieRepository;
        $this->guard = $guard;
        $this->broadcastManager = $broadcastManager;
    }

    /**
     * Return a json array of the comments.
     *
     */
    public function index(int $movieId): JsonResponse
    {
        return response()->json($this->commentRepository->getCommentsByMovieId($movieId));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @param int $movieId
     * @return JsonResponse
     */
    public function store(StoreCommentRequest $request, int $movieId): JsonResponse
    {
        $commentData = [
            'movie_id' => $movieId,
            'created_by_id' => $this->guard->id(),
            'updated_by_id' => $this->guard->id(),
        ];
        $commentData = array_merge($commentData, $request->only(['comment']));

        $comment = $this->commentRepository->save($commentData);

        $this->broadcastManager->event(new NewComment($comment))->toOthers();

        return response()->json($comment);
    }
}
