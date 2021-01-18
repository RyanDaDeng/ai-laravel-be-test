<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyAnalyticSummaryTest extends TestCase
{
    /**
     * test Property Summary Suburb
     *
     * @return void
     */
    public function testPropertySummarySuburb()
    {
        //TODO
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * test Property Summary State
     *
     * @return void
     */
    public function testPropertySummaryState()
    {
        //TODO
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    /**
     * test Property Summary Country
     *
     * @return void
     */
    public function testPropertySummaryCountry()
    {
        //TODO
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
