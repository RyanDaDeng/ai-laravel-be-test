<?php


namespace App\Modules\PropertyManagement\Services;


use App\Models\AnalyticType;
use App\Models\Property;
use App\Models\PropertyAnalytic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PropertyAnalyticService
{

    /**
     * create a new property
     * @param array $data
     * @return Model
     */
    public function createProperty(
        array $data
    )
    {
        return Property::query()
            ->create(
                $data
            );
    }

    /**
     * unpdate a property
     * @param Property $property
     * @param array $data
     * @return bool
     */
    public function updateProperty(
        Property $property,
        array $data
    )
    {
        return $property->update($data);
    }


    /**
     * get property by id
     * @param $id
     * @return Model|Property
     */
    public function getPropertyById($id)
    {
        return Property::query()->where('id', $id)->first();
    }

    /**
     * get analytic type by id
     * @param $id
     * @return Model|AnalyticType
     */
    public function getAnalyticTypeById($id)
    {
        return AnalyticType::query()->where('id', $id)->first();
    }


    /**
     * Assign analytic to a property
     * @param Property $property
     * @param AnalyticType $analyticType
     * @param $value
     */
    public function assignAnalyticToProperty(
        Property $property,
        AnalyticType $analyticType,
        $value
    )
    {
        // attach a new type
        $property
            ->analytic_types()
            ->attach(
                $analyticType->getKey(),
                [
                    'value' => $value
                ]
            );
    }

    /**
     * Check if property analytic exists
     * @param $propertyId
     * @param $analyticTypeId
     * @return Model|PropertyAnalytic
     */
    public function getPropertyAnalyticById(
        $propertyId,
        $analyticTypeId
    )
    {
        return PropertyAnalytic::query()
            ->where('property_id', $propertyId)
            ->where('analytic_type_id', $analyticTypeId)
            ->first();
    }

    /**
     * Update a property analytic
     * @param PropertyAnalytic $propertyAnalytic
     * @param $value
     * @return bool
     */
    public function updatePropertyAnalytic(
        PropertyAnalytic $propertyAnalytic,
        $value
    )
    {
        return $propertyAnalytic->update(
            [
                'value' => $value
            ]
        );
    }

    /**
     * get all analytics for a property
     * @param $propertyId
     * @return Collection
     */
    public function getAllAnalyticForProperty($propertyId)
    {
        return Property::query()
            ->where('property_id', $propertyId)
            ->with('analytic_types')
            ->get();
    }
}
