<?php

namespace Tests\Unit;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Song;
use Tests\TestCase;

class SongTest extends TestCase
{
    public function testCreateStoreAndRetrieve(): void
    {
        $artist = new Artist();
        $artist->name = "artist_name";
        $artist->spotify_id = "spotify_id";
        $artist->save();

        $album = new Album();
        $album->name = "album_name";
        $album->save();


        $song_name = "song_name";
        $song = new Song();
        $song->spotify_id = "spotify_id";
        $song->year = 2020;
        $song->track_name = $song_name;
        $song->track_popularity = 70;
        $song->album_id = $album->id;
        $song->artist_id = $artist->id;
        $song->duration_ms = 1000;

        $song->save();
        $retrieved_song = Song::find($song->id);

        $song->delete();
        $artist->delete();
        $album->delete();

        $this->assertTrue($retrieved_song->track_name == $song_name);
    }
}
