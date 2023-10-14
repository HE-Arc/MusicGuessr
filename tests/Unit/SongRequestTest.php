<?php

namespace Tests\Unit;

use App\Models\SongRequest;
use Tests\TestCase;

class SongRequestTest extends TestCase
{
    public function testCreateStoreAndRetrieve(): void
    {

        $songRequest = new SongRequest;
        $songRequest->artist_name = "NewJeans";
        $songRequest->song_name= "Gods";
        $songRequest->save();
        $id = $songRequest->id;

        $songRequestRetrieved = SongRequest::find($id);
        $songRequestRetrieved->delete();
        $this->assertTrue($songRequestRetrieved->song_name == "Gods");
    }
}
