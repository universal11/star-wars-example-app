<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StarshipEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_by_pilot_name(): void
    {
        $response = $this->get("/api/Starship/getByPilotName/Luke%20Skywalker");

        $response->assertStatus(200);
    }
}
