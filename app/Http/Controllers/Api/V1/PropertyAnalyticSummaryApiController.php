<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiController;
use App\Http\Requests\PropertyAnalyticSummaryApiRequest;
use App\Modules\Report\CountrySummaryReport;
use App\Modules\Report\StateSummaryReport;
use App\Modules\Report\SuburbSummaryReport;

/**
 * @author Ryan Deng
 * @copyright NOT FREE, NOT OPEN SOURCE, NOT USED FOR COMMERCIAL WITHOUT CONSENT
 * Class PropertyAnalyticSummaryApiController
 * @package App\Http\Controllers\Api\V1
 */
class PropertyAnalyticSummaryApiController extends ApiController
{
    /**
     * @param PropertyAnalyticSummaryApiRequest $request
     * @param SuburbSummaryReport $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function suburbSummary(
        PropertyAnalyticSummaryApiRequest $request,
        SuburbSummaryReport $report
    )
    {
        // get only validated data
        $data = $request->validated();

        // create report
        $response = $report
            ->generateReport(
                [
                    'suburb' => $data['value'],
                ]
            )
            ->toArray();

        return $this->sendSuccess(
            [
                'data' => $response
            ]
        );
    }


    /**
     * @param PropertyAnalyticSummaryApiRequest $request
     * @param StateSummaryReport $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function stateSummary(
        PropertyAnalyticSummaryApiRequest $request,
        StateSummaryReport $report
    )
    {
        // get only validated data
        $data = $request->validated();

        // create report
        $response = $report
            ->generateReport(
                [
                    'state' => $data['value'],
                ]
            )
            ->toArray();

        return $this->sendSuccess(
            [
                'data' => $response
            ]
        );
    }



    /**
     * @param PropertyAnalyticSummaryApiRequest $request
     * @param CountrySummaryReport $report
     * @return \Illuminate\Http\JsonResponse
     */
    public function countrySummary(
        PropertyAnalyticSummaryApiRequest $request,
        CountrySummaryReport $report
    )
    {
        // get only validated data
        $data = $request->validated();

        // create report
        $response = $report
            ->generateReport(
                [
                    'country' => $data['value'],
                ]
            )
            ->toArray();

        return $this->sendSuccess(
            [
                'data' => $response
            ]
        );
    }

}
