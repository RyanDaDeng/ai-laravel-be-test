<?php

namespace App\Imports;

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
