<?php
declare(strict_types=1);

namespace App\Services;

use App\Console\Commands\UpdateTrendingMovies;
use App\Http\Requests\UpdateTrendingMoviesRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MovieService
{
    public function __construct(
        private readonly TheMovieDbClient $theMovieDbClient
    ) {
    }

    /**
     * @throws \Exception
     */

    //Update Trending Movies by time_window (Day, Week)
    public function updateTrendingMovies(string $timeWindow): void
    {
        //Throw Exception if the time window not valid
        if (!in_array($timeWindow, ['day', 'week'])) {
            throw new \Exception('Time window is not valid, available options are day and week');
        }
        //Get trending movies by time window
        $newTrendingMovies = $this->theMovieDbClient->getTrendingMovies($timeWindow);

        //Get trending movie ids
        $newTrendingMovieIds = array_column($newTrendingMovies, 'id');

        //Get trending movies from database
        $oldTrendingMovies = Movie::select('movie_id')->ofTrendingTime($timeWindow)->get();

        $oldTrendingMovieIds = array_column($oldTrendingMovies->toArray(), 'movie_id');

        //Return the trending movies from the NewTrendingMovies that are not present in the old trending movies (from database)
        $trendingMovies = array_diff($newTrendingMovieIds, $oldTrendingMovieIds);

        foreach ($trendingMovies as $movieId) {
            $movie = Movie::where('movie_id', $movieId)->first();

            //if the movie exist in the database then change the status of trending to 1
            if ($movie !== null) {
                $movie->update(["trending$timeWindow" => 1]);
            } else {
                //Get the movie details
                $movieDetails = $this->theMovieDbClient->getMovieDetails($movieId);

                // Change the key 'id' to 'movie_id'
                $movieDetails['movie_id'] = $movieDetails['id'];

                unset($movieDetails['id']);

                $movieDetails["trending$timeWindow"] = 1;

                //Call the method createNewMovie to create new movie in the database
                $this->createNewMovie($movieDetails);
            }
        }

        $moviesNoLongerTrending = array_diff($oldTrendingMovieIds, $newTrendingMovieIds);

        Movie::whereIn('movie_id', $moviesNoLongerTrending)
            ->update(["trending$timeWindow" => 0]);
    }

    //Create new trending movie
    private function createNewMovie(array $movieDetails): Void
    {
        $rules = [
            'movie_id' => 'required|integer',
            'adult' => 'nullable|boolean',
            'title' => 'required|string',
            'backdrop_path' => 'required|string',
            'status' => 'nullable|string',
            'tagline' => 'nullable|string',
            'budget' => 'required|integer',
            'original_language' => 'nullable|string',
            'original_title' => 'required|string',
            'overview' => 'required|string',
            'poster_path' => 'required|string',
            'popularity' => 'nullable|numeric',
            'release_date' => 'required|string',
            'video' => 'nullable|boolean',
            'vote_average' => 'required|numeric',
            'vote_count' => 'nullable|integer',
            'revenue' => 'nullable|integer',
            'runtime' => 'nullable|integer',
            'trendingday' => 'nullable|boolean',
            'trendingweek' => 'nullable|boolean',
        ];

        //Create a validator instance using validator facade
        $validator = Validator::make($movieDetails, $rules);

        //Throw an Exception if the validation fails
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Retrieve the validated data
        $validated = $validator->validated();

        //Store the movie in DB
        Movie::create($validated);
    }
}
