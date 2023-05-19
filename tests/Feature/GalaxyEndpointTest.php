<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GalaxyEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_total_population(): void
    {
        $response = $this->get("/api/Galaxy/getTotalPopulation");

        $response->assertStatus(200);
    }
}
