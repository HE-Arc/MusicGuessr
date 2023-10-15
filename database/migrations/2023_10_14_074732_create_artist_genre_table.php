<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artist_genre', function (Blueprint $table) {
            $table->foreignId('artist_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('genre_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['artist_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_genre');
    }
};
