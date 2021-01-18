<?php

namespace Tests\Feature;

use App\Models\AnalyticType;
use App\Models\Property;
use App\Models\PropertyAnalytic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyAnalyticTest extends TestCase
{
    use RefreshDatabase;
    /**
     * test Create A New Analytic To Property Api Invalid Request
     *
     * @return void
     */
    public function testCreateANewAnalyticToPropertyApiInvalidRequest()
    {

        $response = $this->post(
            route('property.analytic.assign', ['property_id' => 1]),
            [

            ]
        );

        $response->assertJsonFragment(
            [
                "status" => "error",
                "code" => "INVALID",
                "message" => "The analytic type id field is required."
            ]
        );
        $response->assertStatus(400);
    }

    /**
     * test Create A New Analytic To Property Api PropertyNotFound
     *
     * @return void
     */
    public function testCreateANewAnalyticToPropertyApiPropertyNotFound()
    {

        $response = $this->post(
            route('property.analytic.assign', ['property_id' => 1]),
            [
                'analytic_type_id' => 1,
                'value' => "2"
            ]
        );


        $response->assertJsonFragment(
            [
                "status" => "error",
                "message" => "Property is not found."
            ]
        );
        $response->assertStatus(400);
    }


    /**
     * test Create A New Analytic To Property Api Success
     *
     * @return void
     */
    public function testCreateANewAnalyticToPropertyApiSuccess()
    {

        $pro = Property::factory()->create();
        $an = AnalyticType::factory()->create();

        $response = $this->post(
            route('property.analytic.assign', ['property_id' => $pro->getKey()]),
            [
                'analytic_type_id' => $an->getKey(),
                'value' => "2"
            ]
        );


        $response->assertJsonFragment(
            [
                "status" => "success",
            ]
        );
        $response->assertStatus(200);

        $this->assertDatabaseHas(
            'property_analytics',
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "2"
            ]
        );
    }


    /**
     * test update Analytic To Property Api
     *
     * @return void
     */
    public function testUpdateAnalyticToPropertyApi()
    {
        $pro = Property::factory()->create();
        $an = AnalyticType::factory()->create();
        $data = PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "333"
            ]
        );

        $response = $this->put(
            route('property.updateAssign', [
                'property_id' => $pro->getKey(),
                'analytic_id' => $an->getKey(),
            ]),
            [
                'value' => "2"
            ]
        );


        $response->assertJsonFragment(
            [
                "status" => "success",
            ]
        );
        $response->assertStatus(200);

        $this->assertEquals("2", $data->refresh()->value);
    }


    /**
     * test Get All Analytics For A Property Api
     *
     * @return void
     */
    public function testGetAllAnalyticsForAPropertyApi()
    {
        $pro = Property::factory()->create();
        $an = AnalyticType::factory()->create();
        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "333"
            ]
        );

        $response = $this->get(
            route('property.getAllAnalytic', [
                'property_id' => $pro->getKey(),
                'analytic_id' => $an->getKey(),
            ])
        );

        $this->assertCount(1, $response->json('data.0.analytic_types'));
        $response->assertJsonFragment(
            [
                "status" => "success",
            ]
        );
        $response->assertStatus(200);
    }
}
