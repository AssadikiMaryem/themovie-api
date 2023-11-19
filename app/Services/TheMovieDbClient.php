<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TheMovieDbClient
{
    private const THE_MOVIE_DB_API_URL = "https://api.themoviedb.org/3/";

    /**
     * @throws \Exception
     */
    public function getTrendingMovies(string $timeWindow = 'day'): array
    {
        if (!in_array($timeWindow, ['day', 'week'])) {
            throw new \Exception('Time window is not valid, available options are day and week');
        }

        $response = Http::withToken(env('THE_MOVIE_DB_API_KEY'))
            ->get(self::THE_MOVIE_DB_API_URL . 'trending/movie/' . $timeWindow);

        $responseData = $response->json();

        if ($response->status() == 200 && isset($responseData['results'])) {
            return $responseData['results'];
        }

        $responseBody = $response->body();
        throw new \Exception("Unable to get trending movies. $responseBody");
    }

    /**
     * @throws \Exception
     */
    public function getMovieDetails(int $id): array
    {
        $response = Http::withToken(env('THE_MOVIE_DB_API_KEY'))
            ->get(self::THE_MOVIE_DB_API_URL . 'movie/' . $id);

        $responseData = $response->json();

        if ($response->status() != 200) {
            $responseBody = $response->body();
            throw new \Exception("Unable to get movie details. $responseBody");
        }

        return $responseData;
    }
}
