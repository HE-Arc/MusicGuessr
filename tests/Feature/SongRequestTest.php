<?php

namespace Tests\Feature;

use App\Models\SongRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SongRequestTest extends TestCase
{
    public function testCreateRequestPageTest(): void
    {
        $response = $this->get('/');
        $response = $this->get('/song_requests/create');
        $response->assertStatus(200);
    }
    public function SendStoreRequestTest(): void
    {
        $response = $this->get('/');
        $response = $this->post('/song_requests', [
            'song_name' => 'Song Name',
            'artist_name' => 'Artist Name',
        ]);
        $response->assertStatus(200);

        $songRequest = SongRequest::where('song_name', 'Song Name')->where('artist_name', 'Artist Name')->first();
        $this->assertTrue(!is_null($songRequest));
    }
}
