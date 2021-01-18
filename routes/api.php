<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\PropertyApiController;
use \App\Http\Controllers\Api\V1\PropertyAnalyticApiController;
use App\Http\Controllers\Api\V1\PropertyAnalyticSummaryApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Property
 */
Route::post('/v1/properties', [PropertyApiController::class, 'store'])->name('property.post');

/**
 * Property Analytic Assignment
 */
Route::post('/v1/properties/{property_id}/analytics', [PropertyAnalyticApiController::class, 'assign'])->name('property.analytic.assign');
Route::put('/v1/properties/{property_id}/analytics/{analytic_id}', [PropertyAnalyticApiController::class, 'updateAssign'])->name('property.updateAssign');

/**
 * Property Analytics
 */
Route::get('/v1/properties/{property_id}/analytics', [PropertyAnalyticApiController::class, 'getAllAnalytic'])->name('property.getAllAnalytic');


/**
 * Report
 */
Route::get('/v1/property-analytics-reports/state-report', [PropertyAnalyticSummaryApiController::class, 'stateSummary'])->name('property.stateSummary');
Route::get('/v1/property-analytics-reports/country-report', [PropertyAnalyticSummaryApiController::class, 'countrySummary'])->name('property.countrySummary');
Route::get('/v1/property-analytics-reports/suburb-report', [PropertyAnalyticSummaryApiController::class, 'suburbSummary'])->name('property.suburbSummary');

