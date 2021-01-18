<?php

namespace Tests\Feature;

use App\Models\AnalyticType;
use App\Models\Property;
use App\Models\PropertyAnalytic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyAnalyticSummaryTest extends TestCase
{

    use RefreshDatabase;

    /**
     * test Property Summary Suburb Zero Test
     *
     * @return void
     */
    public function testPropertySummarySuburbDividedByZero()
    {
        $response = $this->get(route('property.stateSummary', ['value' => 'NSW']));

        $response->assertStatus(200);
        $response->assertJson(
            [
                "status" => "success",
                "data" => [
                    "max_value" => null,
                    "min_value" => null,
                    "median_value" => null,
                    "percentage_with_value" => null,
                    "percentage_without_value" => null
                ]
            ]
        );
    }

    /**
     * test Property Summary Suburb Success
     *
     * @return void
     */
    public function testPropertySummarySuburbSuccess()
    {

        $pro = Property::factory()->create(
            [
                'state' => 'NSW'
            ]
        );
        $an = AnalyticType::factory()->create();
        $pro1 = Property::factory()->create(
            [
                'state' => 'ACT'
            ]
        );
        $an1 = AnalyticType::factory()->create();


        // create property analytic to property one

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "22"
            ]
        );

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "221"
            ]
        );


        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "333"
            ]
        );

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "444"
            ]
        );


        // create property analytic to property two
        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro1->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "1"
            ]
        );


        $response = $this->get(route('property.stateSummary', ['value' => 'NSW']));


        $response->assertStatus(200);
        $response->assertJson(
            [
                "status" => "success",
                "data" => [
                    "max_value" => 444,
                    "min_value" => 22,
                    "median_value" => 277,
                    "percentage_with_value" => 99,
                    "percentage_without_value" => 80,
                ]
            ]
        );
    }

    /**
     * test Property Summary State
     *
     * @return void
     */
    public function testPropertySummaryState()
    {
        $pro = Property::factory()->create(
            [
                'suburb' => 'Wolli'
            ]
        );
        $an = AnalyticType::factory()->create();
        $pro1 = Property::factory()->create(
            [
                'suburb' => 'burwood'
            ]
        );
        $an1 = AnalyticType::factory()->create();


        // create property analytic to property one

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "22"
            ]
        );

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "221"
            ]
        );


        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "333"
            ]
        );

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "444"
            ]
        );


        // create property analytic to property two
        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro1->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "1"
            ]
        );


        $response = $this->get(route('property.suburbSummary', ['value' => 'Wolli']));


        $response->assertStatus(200);
        $response->assertJson(
            [
                "status" => "success",
                "data" => [
                    "max_value" => 444,
                    "min_value" => 22,
                    "median_value" => 277,
                    "percentage_with_value" => 99,
                    "percentage_without_value" => 80,
                ]
            ]
        );
    }


    /**
     * test Property Summary Country
     *
     * @return void
     */
    public function testPropertySummaryCountry()
    {
        $pro = Property::factory()->create(
            [
                'country' => 'AUS'
            ]
        );
        $an = AnalyticType::factory()->create();
        $pro1 = Property::factory()->create(
            [
                'country' => 'AU'
            ]
        );
        $an1 = AnalyticType::factory()->create();


        // create property analytic to property one

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "22"
            ]
        );

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "221"
            ]
        );


        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "333"
            ]
        );

        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro->getKey(),
                'analytic_type_id' => $an1->getKey(),
                'value' => "444"
            ]
        );


        // create property analytic to property two
        PropertyAnalytic::factory()->create(
            [
                'property_id' => $pro1->getKey(),
                'analytic_type_id' => $an->getKey(),
                'value' => "1"
            ]
        );


        $response = $this->get(route('property.countrySummary', ['value' => 'AUS']));


        $response->assertStatus(200);
        $response->assertJson(
            [
                "status" => "success",
                "data" => [
                    "max_value" => 444,
                    "min_value" => 22,
                    "median_value" => 277,
                    "percentage_with_value" => 99,
                    "percentage_without_value" => 80,
                ]
            ]
        );
    }
}
