<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Http\Requests\UpdateTrendingMoviesRequest;
use App\Services\MovieService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UpdateTrendingMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trending-movies:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update trending movies';


    public function __construct(
        private readonly MovieService $movieService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        //Update trending movies by day
        try {
            $this->movieService->updateTrendingMovies('day');
            $this->info('The command was successful! (The trending movies by day are updated)');
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
            Log::error($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        \sleep(1);

        //Update trending movies by week
        try {
            $this->movieService->updateTrendingMovies('week');
            $this->info('The command was successful! (The trending movies by week are updated)');
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
            Log::error($e->getMessage());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return 0;
    }
}
