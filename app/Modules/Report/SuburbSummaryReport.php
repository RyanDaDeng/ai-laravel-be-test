<?php

namespace App\Modules\Report;

use App\Models\Property;

/**
 * Class SuburbSummaryReport
 * @package App\Modules\Report
 */
class SuburbSummaryReport extends AbstractSummaryReport
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
                'suburb', "=", $filters['suburb']
            )
            ->pluck('id')
            ->toArray();
    }
}
