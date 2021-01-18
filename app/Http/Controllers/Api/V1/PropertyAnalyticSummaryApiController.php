<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiController;
use App\Http\Requests\CreatePropertyApiRequest;
use App\Http\Requests\PropertyAnalyticSummaryApiRequest;
use App\Modules\PropertyManagement\Services\PropertyAnalyticService;

/**
 * @author Ryan Deng
 * @copyright NOT FREE, NOT OPEN SOURCE, NOT USED FOR COMMERCIAL WITHOUT CONSENT
 * Class PropertyAnalyticSummaryApiController
 * @package App\Http\Controllers\Api\V1
 */
class PropertyAnalyticSummaryApiController extends ApiController
{
    /**
     * Create a new property
     * @param CreatePropertyApiRequest $request
     * @param PropertyAnalyticService $propertyService
     * @return \Illuminate\Http\JsonResponse
     */
    public function summary(
       PropertyAnalyticSummaryApiRequest $request
    )
    {
        // get only validated data
        $data = $request->validated();

        // create property
        $response = $propertyService
            ->createProperty(
                [
                    'suburb' => $data['suburb'],
                    'state' => $data['state'],
                    'country' => $data['country'],
                ]
            );

        return $this->sendSuccess(
            [
                'data' => $response
            ]
        );
    }

}
