<?php

namespace App\Modules\Report;

use App\Models\Property;

/**
 * Class StateSummaryReport
 * @package App\Modules\Report
 */
class StateSummaryReport extends AbstractSummaryReport
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
                'suburb', "=", $filters['state']
            )
            ->pluck('id')
            ->toArray();
    }
}
