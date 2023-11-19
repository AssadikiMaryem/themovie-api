<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Movie;

class MovieService
{
    public function __construct(
        private readonly TheMovieDbClient $theMovieDbClient
    ) {
    }

    /**
     * @throws \Exception
     */
    public function updateTrendingMovies(string $timeWindow): void
    {
        if (!in_array($timeWindow, ['day', 'week'])) {
            throw new \Exception('Time window is not valid, available options are day and week');
        }

        $newTrendingMovies = $this->theMovieDbClient->getTrendingMovies($timeWindow);

        $newTrendingMovieIds = array_column($newTrendingMovies, 'id');

        $oldTrendingMovies = Movie::select('movie_id')->where("trending$timeWindow", 1)->get();

        $oldTrendingMovieIds = array_column($oldTrendingMovies->toArray(), 'movie_id');

        $trendingMovies = array_diff($newTrendingMovieIds, $oldTrendingMovieIds);

        foreach ($trendingMovies as $movieId) {
            $movie = Movie::where('movie_id', $movieId)->first();

            if ($movie !== null) {
                $movie->update(["trending$timeWindow" => 1]);
            } else {
                $movieDetails = $this->theMovieDbClient->getMovieDetails($movieId);

                // Change the key 'id' to 'movie_id'
                $movieDetails['movie_id'] = $movieDetails['id'];

                unset($movieDetails['id']);

                $movieDetails["trending$timeWindow"] = 1;

                Movie::create($movieDetails);
            }
        }

        $moviesNoLongerTrending = array_diff($oldTrendingMovieIds, $newTrendingMovieIds);

        Movie::whereIn('movie_id', $moviesNoLongerTrending)
            ->update(["trending$timeWindow" => 0]);
    }
}
