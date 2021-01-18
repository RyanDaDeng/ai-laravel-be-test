<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiController;
use App\Http\Requests\AddNewAnalyticToPropertyApiRequest;
use App\Modules\PropertyManagement\Services\PropertyAnalyticService;

/**
 * @author Ryan Deng
 * @copyright NOT FREE, NOT OPEN SOURCE, NOT USED FOR COMMERCIAL WITHOUT CONSENT
 * Class PropertyAnalyticApiController
 * @package App\Http\Controllers\Api\V1
 */
class PropertyAnalyticApiController extends ApiController
{
    /**
     * Add an analytic to a property
     * @param $propertyId
     * @param AddNewAnalyticToPropertyApiRequest $request
     * @param PropertyAnalyticService $propertyAnalyticService
     * @return \Illuminate\Http\JsonResponse
     */
    public function assign(
        $propertyId,
        AddNewAnalyticToPropertyApiRequest $request,
        PropertyAnalyticService $propertyAnalyticService
    )
    {

        $data = $request->validated();

        // check if item exists
        // alternative way is using findOrFail, or using Model binding in URI, both works.
        // the reason i do below because its easy for me to do unit test

        $property = $propertyAnalyticService
            ->getPropertyById(
                $propertyId
            );

        if (!$property) {
            return $this->sendError(
                [
                    'message' => 'Property is not found.'
                ]
            );
        }

        // check if analytic type exists
        $analyticType = $propertyAnalyticService
            ->getAnalyticTypeById(
                $data['analytic_type_id']
            );

        if (!$analyticType) {
            return $this->sendError(
                [
                    'message' => 'analytic type is not found.'
                ]
            );
        }

        // assign analytic to property
        $propertyAnalyticService->assignAnalyticToProperty(
            $property,
            $analyticType,
            $data['value']
        );

        return $this->sendSuccess(
            [
                'data' => 'A new analytic type is assigned to property ID#' . $propertyId
            ]
        );
    }


    /**
     * Update an analytic to a property
     * @param $propertyId
     * @param $analyticId
     * @param AddNewAnalyticToPropertyApiRequest $request
     * @param PropertyAnalyticService $propertyAnalyticService
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAssign(
        $propertyId,
        $analyticId,
        AddNewAnalyticToPropertyApiRequest $request,
        PropertyAnalyticService $propertyAnalyticService
    )
    {
        $data = $request->validated();

        // check if item exists
        // alternative way is using findOrFail, or using Model binding in URI, both works.
        // the reason i do below because its easy for me to do unit test

        $propertyAnalytic = $propertyAnalyticService
            ->getPropertyAnalyticById(
                $propertyId,
                $analyticId
            );


        // assign analytic to property
        $propertyAnalyticService->updatePropertyAnalytic(
            $propertyAnalytic,
            $data['value']
        );

        return $this->sendSuccess(
            [
                'data' => 'A new analytic type is assigned to property ID#' . $propertyId
            ]
        );
    }


    /**
     * @param $propertyId
     * @param PropertyAnalyticService $propertyAnalyticService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAnalytic(
        $propertyId,
        PropertyAnalyticService $propertyAnalyticService
    )
    {
        // check if item exists
        // alternative way is using findOrFail, or using Model binding in URI, both works.
        // the reason i do below because its easy for me to do unit test

        $property = $propertyAnalyticService
            ->getPropertyById(
                $propertyId
            );

        if (!$property) {
            return $this->sendError(
                [
                    'message' => 'Property is not found.'
                ]
            );
        }

        return $this->sendSuccess(
            [
                'data' => $propertyAnalyticService
                    ->getAllAnalyticForProperty($propertyId)
                    ->toArray()
            ]
        );
    }
}
