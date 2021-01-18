<?php

namespace App\Modules\Report;

use App\Models\PropertyAnalytic;
use Illuminate\Support\Collection;

abstract class AbstractSummaryReport
{
    private $minValue = 0;
    private $maxValue = 0;
    private $medianValue = 0;
    private $percentageWithValue = 0;
    private $percentageWithoutValue = 0;

    /**
     * @param array $filters
     * @return array
     */
    abstract public function getPropertyIds(array $filters = []): array;


    /**
     * @param array $filters
     * @return $this
     */
    public function generateReport(array $filters = [])
    {
        // get a list of filtered property IDs
        $filterIds = $this->getPropertyIds($filters);

        // pass property ids to get a list of property analytic entries
        $inputData = Collection::make($this->getInputData($filterIds));

        // use entries to calculate the following values
        $this->calculateMaxValue($inputData);
        $this->calculateMinValue($inputData);
        $this->calculateMedianValue($inputData);
        $this->calculatePercentageWithoutValue($inputData);
        $this->calculatePercentageWithValue($inputData);
        return $this;
    }


    /**
     * @param array $filteredIds
     * @return array
     */
    public function getInputData(array $filteredIds): array
    {
        return PropertyAnalytic::query()
            ->select('property_id', 'value')
            ->whereIn('property_id', $filteredIds)
            ->get()
            ->toArray();
    }

    /**
     * @return float
     */
    public function getSumOfValues(): float
    {
        return PropertyAnalytic::query()->sum('value');
    }

    /**
     * @return int
     */
    public function getCountOfProperties(): int
    {
        return PropertyAnalytic::query()->count();
    }

    /**
     * @param Collection $collection
     */
    public function calculateMinValue(Collection $collection)
    {
        $this->minValue = $collection->min('value');
    }

    /**
     * @param Collection $collection
     */
    public function calculateMaxValue(Collection $collection)
    {
        $this->maxValue = $collection->max('value');
    }

    /**
     * @param Collection $collection
     */
    public function calculateMedianValue(Collection $collection)
    {
        $this->medianValue = $collection->median('value');
    }

    /**
     * @param Collection $collection
     */
    public function calculatePercentageWithValue(Collection $collection)
    {
        $totalSum = $this->getSumOfValues();
        $totalValue = $collection->sum('value');

        $value = ($totalValue / $totalSum) * 100;
        $this->percentageWithValue = $totalSum == 0 ? null : floor($value);
    }

    /**
     * @param Collection $collection
     */
    public function calculatePercentageWithoutValue(Collection $collection)
    {
        $totalCount = $this->getCountOfProperties();
        $totalFilteredCount = $collection->count();
        $value = ($totalFilteredCount / $totalCount) * 100;
        $this->percentageWithoutValue = $totalFilteredCount == 0 ? null :floor($value);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'max_value' => (float)$this->maxValue,
            'min_value' => (float)$this->minValue,
            'median_value' => (float)$this->medianValue,
            'percentage_with_value' => (float)$this->percentageWithValue,
            'percentage_without_value' => (float)$this->percentageWithoutValue
        ];
    }

}
