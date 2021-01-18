<?php


namespace App\Modules\Report;

use App\Models\Property;

class CountrySummaryReport extends AbstractSummaryReport
{
    /**
     * @param array $filters
     * @return array
     */
    public function getPropertyIds(array $filters = []): array
    {
        return Property::query()
            ->select('id')
            ->where(
                'suburb', "=", $filters['country']
            )
            ->pluck('id')
            ->toArray();
    }
}
