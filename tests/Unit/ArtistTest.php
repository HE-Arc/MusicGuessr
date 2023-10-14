<?php

namespace Tests\Unit;

use App\Models\Artist;
use Tests\TestCase;

class ArtistTest extends TestCase
{
    public function testCreateStoreAndRetrieve(): void
    {
        $name = "artist_name";
        $artist = new Artist();
        $artist->name = $name;
        $artist->spotify_id = "spotify_id";
        $artist->save();
        $id = $artist->id;

        $artistRetrieved = Artist::find($id);

        $this->assertTrue($artistRetrieved->name == $name);
    }
}
