<?php

namespace App\Imports;

use App\Models\PropertyAnalytic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PropertyAnalyticSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        //
        $rows->each(function ($row) {

            try {
                PropertyAnalytic::query()->firstOrCreate(
                    [
                        'property_id' => $row['property_id'],
                        'analytic_type_id' => $row['anaytic_type_id'],
                    ],
                    [
                        'value' => $row['value']
                    ]
                );
            } catch (\Throwable $exception) {
                Log::error($exception);
                dd('Property Analytic error', $row);
            }


        });
    }
}
