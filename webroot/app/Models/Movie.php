<?php

namespace App\Models;

use Database\Factories\MovieFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Movie
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $released_on
 * @property int $rating
 * @property string $ticket_price
 * @property string $country
 * @property string $cover_image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read Collection|Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read array $genre_ids
 * @method static MovieFactory factory(...$parameters)
 * @method static Builder|Movie newModelQuery()
 * @method static Builder|Movie newQuery()
 * @method static Builder|Movie query()
 * @method static Builder|Movie whereCountry($value)
 * @method static Builder|Movie whereCoverImage($value)
 * @method static Builder|Movie whereCreatedAt($value)
 * @method static Builder|Movie whereDescription($value)
 * @method static Builder|Movie whereId($value)
 * @method static Builder|Movie whereName($value)
 * @method static Builder|Movie whereRating($value)
 * @method static Builder|Movie whereReleasedOn($value)
 * @method static Builder|Movie whereTicketPrice($value)
 * @method static Builder|Movie whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'released_on',
        'rating',
        'ticket_price',
        'country',
        'cover_image'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getGenreIdsAttribute(): array
    {
        return array_column($this->genres()->get(['id'])->toArray(), 'id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movies_genres', 'movie_id', 'genre_id');
    }
}
