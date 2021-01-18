<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\PropertyAnalytic;
use App\Modules\Report\AbstractSummaryReport;
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
