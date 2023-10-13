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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string("spotify_id");
            $table->integer("year");
            $table->string("track_name");
            $table->integer("track_popularity");
            $table->foreignId("album_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("artist_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer("duration_ms")->nullable();
            $table->float("loudness")->nullable();
            $table->float("danceability")->nullable();
            $table->float("energy")->nullable();
            $table->integer("key")->nullable();
            $table->float("tempo")->nullable();
            $table->float("acousticness")->nullable();
            $table->float("speechiness")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
