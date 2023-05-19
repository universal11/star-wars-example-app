<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilmEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_species_classifications(): void
    {
        $response = $this->get("/api/Film/getSpeciesClassificationsByEpisode/1");

        $response->assertStatus(200);
    }
}
