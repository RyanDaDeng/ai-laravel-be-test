<?php


namespace App\Modules\PropertyManagement\Services;


use App\Models\Property;

class PropertyService
{
    public function create(
        $data
    )
    {

        return Property::query()
            ->create(
                $data
            );
    }

}
