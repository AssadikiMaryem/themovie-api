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
            $table->boolean('adult');
            $table->string('title');
            $table->string('backdrop_path');
            $table->string('status');
            $table->string('tagline');
            $table->integer('budget');
            $table->string('original_language');
            $table->string('original_title');
            $table->string('overview');
            $table->string('poster_path');
            $table->string('media_type');
            $table->integer('popularity');
            $table->string('release_date');
            $table->boolean('video');
            $table->integer('vote_average');
            $table->integer('vote_count');
            $table->integer('revenue');
            $table->integer('runtime');
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
