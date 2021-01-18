<?php

namespace Database\Seeders;

use App\Imports\SampleDataImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Property::factory(10)->create();

        Excel::import(new SampleDataImport(), storage_path('/dummy/BackEndTest_TestData_v1.1.xlsx'));
    }
}
