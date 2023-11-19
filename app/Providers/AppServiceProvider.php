<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use App\Services\TheMovieDbClient;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TheMovieDbClient::class, function (Application $app) {
            return new TheMovieDbClient();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('search', function($field, $string) {
            return $string ? $this->where($field, 'LIKE', '%'.$string.'%') : $this;
        });
    }
}
