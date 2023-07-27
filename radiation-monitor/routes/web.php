<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndoorMonitoringController;
use App\Http\Controllers\OutdoorMonitoringController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//dashboard
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dose-rate-chart', [DashboardController::class, 'getDoseRateChart'])->middleware('verifyApiKey');
Route::get('/latest-dose-rate-outdoor', [DashboardController::class, 'getLatestDoseRate'])->middleware('verifyApiKey');
Route::get('/latest-dose-rate-indoor', [DashboardController::class, 'getLatestDoseRate'])->middleware('verifyApiKey');
Route::get('/highest-dose-rate', [DashboardController::class, 'getHighestDoseRate'])->middleware('verifyApiKey');

//outdoor monitor
Route::get('/outdoor-monitor', [OutdoorMonitoringController::class, 'index']);
Route::get('/outdoor-monitor-data-tables', [OutdoorMonitoringController::class, 'tables']);
Route::get('/outdoor-dose-rate-chart', [OutdoorMonitoringController::class, 'getDataChart'])->middleware('verifyApiKey');
Route::get('/latest-outdoor-temperature', [OutdoorMonitoringController::class, 'getLatestData'])->middleware('verifyApiKey');
Route::get('/outdoor-temperature-chart', [OutdoorMonitoringController::class, 'getDataChart'])->middleware('verifyApiKey');
Route::get('/latest-outdoor-humidity', [OutdoorMonitoringController::class, 'getLatestData'])->middleware('verifyApiKey');
Route::get('/outdoor-humidity-chart', [OutdoorMonitoringController::class, 'getDataChart'])->middleware('verifyApiKey');

//indoor-monitor
Route::get('/indoor-monitor', [IndoorMonitoringController::class, 'index']);
Route::get('/indoor-monitor-data-tables', [IndoorMonitoringController::class, 'tables']);
Route::get('/indoor-dose-rate-chart', [IndoorMonitoringController::class, 'getDataChart'])->middleware('verifyApiKey');
Route::get('/latest-indoor-temperature', [IndoorMonitoringController::class, 'getLatestData'])->middleware('verifyApiKey');
Route::get('/indoor-temperature-chart', [IndoorMonitoringController::class, 'getDataChart'])->middleware('verifyApiKey');
Route::get('/latest-indoor-humidity', [IndoorMonitoringController::class, 'getLatestData'])->middleware('verifyApiKey');
Route::get('/indoor-humidity-chart', [IndoorMonitoringController::class, 'getDataChart'])->middleware('verifyApiKey');