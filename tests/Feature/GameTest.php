<?php

namespace Tests\Feature;

use Tests\TestCase;

class GameTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    //Maelys
    public function testAccessIndex(): void
    {
        $response = $this->get('/');

        $response->assertStatus(500);
    }

    public function testAjaxComparison(): void
    {
        $response = $this->post('/comparison_with_answer_song', [
            'song_id'   => 1,
        ]);

        $this->assertNotFalse($response->getContent());
        $response->assertStatus(200);
    }

    public function testAjaxSongBeginningWith(): void
    {
        $response = $this->get('/song_beginning_with/abc');
        $this->assertNotFalse($response->getContent());
        $response->assertStatus(200);
    }

    public function testAjaxStartGame(): void
    {
        $response = $this->post('/start_game');
        $this->assertNotFalse($response->getContent());
        $response->assertStatus(200);
    }

    public function testAjaxEndGame(): void
    {
        $response = $this->post('/end_game');
        $this->assertNotFalse($response->getContent());
        $response->assertStatus(200);
    }
}
