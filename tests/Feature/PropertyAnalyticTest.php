<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyAnalyticTest extends TestCase
{
    /**
     * test Create A New Analytic To Property Api
     *
     * @return void
     */
    public function testCreateANewAnalyticToPropertyApi()
    {
        //TODO
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    /**
     * test update Analytic To Property Api
     *
     * @return void
     */
    public function testUpdateAnalyticToPropertyApi()
    {
        //TODO
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    /**
     * test Get All Analytics For A Property Api
     *
     * @return void
     */
    public function testGetAllAnalyticsForAPropertyApi()
    {
        //TODO
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
