<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test Add A New Property Api no body
     *
     * @return void
     */
    public function testAddANewPropertyApiNoBody()
    {
        $response = $this->post(
            route('property.post'),
            [

            ]
        );

        $response->assertJsonFragment(
            [
                "status" => "error",
                "code" => "INVALID"
            ]
        );

        $response->assertStatus(400);
    }


    /**
     * test Add A New Property Api Success
     *
     * @return void
     */
    public function testAddANewPropertyApiSuccess()
    {
        $response = $this->post(
            route('property.post'),
            [
                "state" => "NSW",
                "country" => "Australia",
                "suburb" => "Wolli Creek"
            ]
        );

        $response->assertJsonFragment(
            [
                "status" => "success",
            ]
        );

        $response->assertStatus(200);

        $this->assertDatabaseHas(
            'properties',
            [
                "state" => "NSW",
                "country" => "Australia",
                "suburb" => "Wolli Creek"
            ]
        );
    }
}
