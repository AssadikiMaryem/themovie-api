<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    
    // protected $primaryKey = 'movie_id';

    // public $incrementing = false;

    protected $fillable = [
        'movie_id',
        'adult',
        'title',
        'backdrop_path',
        'status',
        'tagline',
        'budget',
        'original_language',
        'original_title',
        'overview',
        'poster_path',
        'popularity',
        'release_date',
        'video',
        'vote_average',
        'vote_count',
        'revenue',
        'runtime',
        'trendingday',
        'trendingweek',
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getVoteAverageAttribute(): string
    {
        return intval($this->attributes['vote_average'] * 10);
    }
}
