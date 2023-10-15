<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LazyCollection::make(function () {
            $file_path = 'seeds/playlist_2010to2022_improved.csv';
            $handle = fopen(public_path($file_path), 'r');

            while (($line = fgetcsv($handle, 4096)) !== false) {
                $dataString = implode(', ', $line);
                $row = explode(';', $dataString);
                yield $row;
            }

            fclose($handle);
        })
            ->skip(1)
            ->chunk(1000)
            ->each(function (LazyCollection $chunk) {
                foreach ($chunk as $row) {
                    $index_year = 1;
                    $index_track_id = 2;
                    $index_track_name = 3;
                    $index_track_popularity = 4;
                    $index_album = 5;
                    $index_artist_id = 6;
                    $index_artist_name = 7;
                    $index_artist_genres = 8;
                    $index_artist_popularity = 9;
                    $index_danceability = 10;
                    $index_energy = 11;
                    $index_key = 12;
                    $index_loudness = 13;
                    $index_mode = 14;
                    $index_speechiness = 15;
                    $index_acousticness = 16;
                    $index_instrumentalness = 17;
                    $index_liveness = 18;
                    $index_valence = 19;
                    $index_tempo = 20;
                    $index_duration_ms = 21;
                    //if data is null, skip
                    if (!array_key_exists($index_duration_ms, $row) || $row[$index_duration_ms] == null) {
                        continue;
                    }

                    $artist_id = null;
                    if (DB::table('artists')->where('spotify_id', $row[$index_artist_id])->exists()) {
                        $artist_id = DB::table('artists')->where('spotify_id', $row[$index_artist_id])->first()->id;
                    } else {
                        $artist = new Artist();
                        $artist->spotify_id = $row[$index_artist_id];
                        $artist->name = $row[$index_artist_name];
                        $artist->save();
                        $genre_array = $this->stringToArray($row[$index_artist_genres]);
                        foreach ($genre_array as $genre_name) {
                            $genre = Genre::firstOrCreate(['name' => $genre_name]);
                            $artist->genres()->attach($genre);
                        }

                        $artist_id = $artist->id;
                    }

                    $album = Album::firstOrCreate(['name' => $row[$index_album]]);
                    $album_id = $album->id;

                    Song::create([
                        'year'             => $row[$index_year],
                        'spotify_id'       => $row[$index_track_id],
                        'track_name'       => $row[$index_track_name],
                        'track_popularity' => $row[$index_track_popularity],
                        'album_id'         => $album_id,
                        'artist_id'        => $artist_id,
                        'duration_ms'      => $row[$index_duration_ms],
                        'loudness'         => $row[$index_loudness],
                        'danceability'     => $row[$index_danceability],
                        'energy'           => $row[$index_energy],
                        'key'              => $row[$index_key],
                        'tempo'            => $row[$index_tempo],
                        'acousticness'     => $row[$index_acousticness],
                        'speechiness'      => $row[$index_speechiness],
                    ]);
                }
            });
    }

    public function stringToArray($string): array
    {
        $string = str_replace('[', '', $string);
        $string = str_replace(']', '', $string);
        $string = str_replace('\'', '', $string);
        $array = explode(',', $string);
        foreach ($array as $key => $value) {
            $array[$key] = trim($value);
        }

        return $array;
    }
}
