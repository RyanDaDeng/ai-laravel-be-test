<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    /**
     * test Add A New Property Api
     *
     * @return void
     */
    public function testAddANewPropertyApi()
    {
        //TODO
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
