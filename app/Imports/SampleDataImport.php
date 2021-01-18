<?php

namespace App\Imports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SampleDataImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            0 => new PropertySheetImport(),
            1 => new AnalyticTypeSheetImport(),
            2 => new PropertyAnalyticSheetImport()
        ];
    }
}
