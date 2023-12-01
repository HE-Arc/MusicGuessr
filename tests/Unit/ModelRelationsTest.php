<?php

namespace Tests\Unit;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use Tests\TestCase;

class ModelRelationsTest extends TestCase
{
    /**
     * Test the many-to-many relationship between Artist and Genre.
     */
    public function testArtistGenreRelation(): void
    {
        $artist = new Artist();
        $artist->name = 'artist_name';
        $artist->spotify_id = 'spotify_id';
        $artist->save();
        $artistId = $artist->id;

        $artist2 = new Artist();
        $artist2->name = 'artist_name2';
        $artist2->spotify_id = 'spotify_id2';
        $artist2->save();
        $artist2Id = $artist2->id;

        $genre = new Genre();
        $genre->name = 'Test Genre';
        $genre->save();
        $genreId = $genre->id;

        $genre2 = new Genre();
        $genre2->name = 'Test Genre 2';
        $genre2->save();
        $genre2Id = $genre2->id;

        $artist->genres()->attach($genreId);
        $artist->genres()->attach($genre2Id);

        $artist2->genres()->attach($genreId);

        $this->assertTrue($artist->genres()->count() == 2);
        $this->assertTrue($artist2->genres()->count() == 1);

        $this->assertTrue($genre->artists()->count() == 2);
        $this->assertTrue($genre2->artists()->count() == 1);

        //delete everything
        $artist->delete();
        $artist2->delete();
        $genre->delete();
        $genre2->delete();
    }

    /**
     * Test the many-to-many relationship between User and Song.
     */
    public function testUserSongRelation(): void
    {
        $user = new User();
        $user->name = 'user_name';
        $user->password = 'password';
        $user->email = 'user1@mail';
        $user->save();

        $user2 = new User();
        $user2->name = 'user_name2';
        $user2->password = 'password2';
        $user2->email = 'user2@mail';
        $user2->save();

        $artist = new Artist();
        $artist->name = 'artist_name';
        $artist->spotify_id = 'spotify_id';
        $artist->save();

        $album = new Album();
        $album->name = 'album_name';
        $album->save();

        $song = new Song();
        $song_name = 'song_name';
        $song = new Song();
        $song->spotify_id = 'spotify_id';
        $song->year = 2020;
        $song->track_name = $song_name;
        $song->track_popularity = 70;
        $song->album_id = $album->id;
        $song->artist_id = $artist->id;
        $song->duration_ms = 1000;
        $song->save();

        $song2 = new Song();
        $song_name2 = 'song_name2';
        $song2->spotify_id = 'spotify_id2';
        $song2->year = 2020;
        $song2->track_name = $song_name2;
        $song2->track_popularity = 70;
        $song2->album_id = $album->id;
        $song2->artist_id = $artist->id;
        $song2->duration_ms = 1000;
        $song2->save();

        $user->songs()->attach($song->id);
        $user->songs()->attach($song2->id);

        $user2->songs()->attach($song->id);

        $this->assertTrue($user->songs()->count() == 2);
        $this->assertTrue($user2->songs()->count() == 1);

        $this->assertTrue($song->users()->count() == 2);
        $this->assertTrue($song2->users()->count() == 1);

        //delete everything
        $user->delete();
        $user2->delete();
        $song->delete();
        $song2->delete();
        $artist->delete();
        $album->delete();
    }

    /**
     * Test the one-to-many relationship between Artist and Song.
     */
    public function testArtistSongRelation(): void
    {
        $artist = new Artist();
        $artist->name = 'artist_name';
        $artist->spotify_id = 'spotify_id';
        $artist->save();

        $album = new Album();
        $album->name = 'album_name';
        $album->save();

        $song = new Song();
        $song_name = 'song_name';
        $song = new Song();
        $song->spotify_id = 'spotify_id';
        $song->year = 2020;
        $song->track_name = $song_name;
        $song->track_popularity = 70;
        $song->album_id = $album->id;
        $song->artist_id = $artist->id;
        $song->duration_ms = 1000;
        $song->save();

        $this->assertTrue($artist->songs()->count() == 1);
        $this->assertTrue($song->artist()->first()->name == 'artist_name');

        //delete everything
        $song->delete();
        $artist->delete();
        $album->delete();
    }

    /**
     * Test the one-to-many relationship between Album and Song.
     */
    public function testAlbumSongRelation(): void
    {
        $artist = new Artist();
        $artist->name = 'artist_name';
        $artist->spotify_id = 'spotify_id';
        $artist->save();

        $album = new Album();
        $album->name = 'album_name';
        $album->save();

        $song = new Song();
        $song_name = 'song_name';
        $song = new Song();
        $song->spotify_id = 'spotify_id';
        $song->year = 2020;
        $song->track_name = $song_name;
        $song->track_popularity = 70;
        $song->album_id = $album->id;
        $song->artist_id = $artist->id;
        $song->duration_ms = 1000;
        $song->save();

        $this->assertTrue($album->songs()->count() == 1);
        $this->assertTrue($song->album()->first()->name == 'album_name');

        //delete everything
        $song->delete();
        $artist->delete();
        $album->delete();
    }
}
