<?php

namespace Tests\Unit;

use App\Models\Genre;
use Tests\TestCase;

class GenreTest extends TestCase
{
    public function testCreateStoreAndRetrieve(): void
    {
        $genreName = 'Test Genre';
        $genre = new Genre();
        $genre->name = $genreName;
        $genre->save();
        $id = $genre->id;

        $genreRetrieved = Genre::findOrFail($id);

        $genre->delete();
        $this->assertTrue($genreRetrieved->name == $genreName);
    }
}
