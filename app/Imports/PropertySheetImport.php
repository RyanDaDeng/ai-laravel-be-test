<?php

namespace App\Imports;

use App\Models\Property;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PropertySheetImport implements WithHeadingRow, ToCollection
{
    public function collection(Collection $rows)
    {
        //
        $rows->each(function ($row) {
            Property::query()
                ->firstOrCreate(
                    [
                        'id' => $row['property_id'],
                    ],
                    [
                        'suburb' => $row['suburb'],
                        'state' => $row['state'],
                        'country' => $row['counrty'],
                    ]
                )->save();
        });
    }
}
