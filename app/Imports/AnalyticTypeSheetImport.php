<?php

namespace App\Imports;

use App\Models\AnalyticType;
use App\Models\Property;
use App\Models\PropertyAnalytic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnalyticTypeSheetImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        //
        $rows->each(function ($row) {
            try {
                AnalyticType::query()->firstOrCreate(
                    [
                        'id' => $row['id'],
                    ],
                    [
                        'name' => $row['name'],
                        'units' => $row['units'],
                        'is_numeric' => $row['is_numeric'],
                        'num_decimal_places' => $row['num_decimal_places']
                    ]
                );
            } catch (\Throwable $exception) {
                Log::error($exception);
                dd('Analytic Type error', $row);
            }
        });
    }
}
