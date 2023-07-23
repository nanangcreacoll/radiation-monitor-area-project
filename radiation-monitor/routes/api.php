<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndoorMonitoringController;
use App\Http\Controllers\OutdoorMonitoringController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/store-data-outdoor-monitor', [OutdoorMonitoringController::class, 'storeData'])->middleware('verifyApiKey');
Route::post('/store-data-indoor-monitor', [IndoorMonitoringController::class, 'storeData'])->middleware('verifyApiKey');
Route::get('/fetch-data-indoor-monitor', [OutdoorMonitoringController::class, 'fetchDataIndoorMonitor'])->middleware('verifyApiKey');
Route::get('/dose-rate-chart', [DashboardController::class, 'getDoseRateDataChart'])->middleware('verifyApiKey');