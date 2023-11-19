<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->boolean('adult')->default(0);
            $table->string('title');
            $table->string('backdrop_path');
            $table->string('status')->nullable();
            $table->string('tagline')->nullable();
            $table->integer('budget')->nullable();
            $table->string('original_language');
            $table->string('original_title');
            $table->text('overview');
            $table->string('poster_path');
            $table->float('popularity');
            $table->string('release_date');
            $table->boolean('video')->default(0);
            $table->float('vote_average');
            $table->integer('vote_count');
            $table->integer('revenue')->nullable();
            $table->integer('runtime')->nullable();
            $table->boolean('trendingday')->default(0);
            $table->boolean('trendingweek')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
