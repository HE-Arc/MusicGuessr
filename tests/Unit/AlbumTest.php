<?php

namespace Tests\Unit;

use App\Models\Album;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testCreateStoreAndRetrieve(): void
    {
        $albumName = "Test Album";
        $album = new Album;
        $album->name = $albumName;
        $album->save();
        $id = $album->id;

        $albumRetrieved = Album::find($id);
        $albumRetrieved->delete();
        $this->assertTrue($albumRetrieved->name == $albumName);
    }
}
