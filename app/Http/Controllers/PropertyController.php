<?php

namespace App\Http\Controllers;

use App\Helpers\ApiController;
use App\Http\Requests\CreatePropertyApiRequest;
use App\Modules\PropertyManagement\Services\PropertyService;

class PropertyController extends ApiController
{
    /**
     * Create a new property
     * @param CreatePropertyApiRequest $request
     * @param PropertyService $propertyService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        CreatePropertyApiRequest $request,
        PropertyService $propertyService
    )
    {
        $data = $request->validated();

        $response = $propertyService
            ->create(
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
