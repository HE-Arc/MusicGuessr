<?php

namespace Tests\Unit;

use App\Models\SongRequest;
use Tests\TestCase;

class SongRequestTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testCreateStoreAndRetrieve(): void
    {

        $songRequest = new SongRequest;
        $songRequest->artist_name = "NewJeans";
        $songRequest->song_name= "Gods";
        $songRequest->save();

        $songRequestRetrieved = SongRequest::where('artist_name', "NewJeans")->first();

        $this->assertTrue($songRequestRetrieved->song_name == "Gods");
    }
}
