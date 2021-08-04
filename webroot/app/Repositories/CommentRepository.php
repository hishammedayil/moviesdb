<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    /**
     * @var Comment
     */
    private $model;

    /**
     * CommentRepository constructor.
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function getCommentsByMovieId(int $movieId)
    {
        return $this->model->whereMovieId($movieId)->with('user')->orderByDesc('created_at')->get();
    }

    public function save(array $commentData, ?Comment $comment = null): Comment
    {
        if ($comment instanceof Comment) {
            $comment->update($commentData);
        } else {
            $comment = $this->model->create($commentData);
            $comment = $this->model->whereId($comment->id)->with('user')->first();
        }

        return $comment;
    }
}
