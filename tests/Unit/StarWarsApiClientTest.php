<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Classes\StarWars\ApiClient as StarWarsApiClient;

class StarWarsApiClientTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_initialization(): void
    {
        $starWarsApiClient = new StarWarsApiClient();
        $this->assertTrue($starWarsApiClient instanceof StarWarsApiClient);
    }
}
