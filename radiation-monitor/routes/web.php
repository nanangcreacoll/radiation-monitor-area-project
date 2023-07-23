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


Route::get('/', [DashboardController::class, 'index']);
Route::get('/indoor-monitor', [IndoorMonitoringController::class, 'index']);
Route::get('/outdoor-monitor', [OutdoorMonitoringController::class, 'index']);
Route::get('/indoor-monitor-data-tables', [IndoorMonitoringController::class, 'index']);
Route::get('/outdoor-monitor-data-tables', [OutdoorMonitoringController::class, 'index']);