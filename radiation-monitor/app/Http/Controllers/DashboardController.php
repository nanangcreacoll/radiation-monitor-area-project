<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\IndoorMonitoring;
use App\Models\OutdoorMonitoring;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $currentDate = Carbon::now()->isoFormat('D MMMM YYYY');
        $currentDay = Carbon::now()->isoFormat('dddd');

        return view('dashboard', [
            "title" => "Dashboard",
            "currentDate" => $currentDate,
            "currentDay" => $currentDay
        ]);
    }

    public function getDoseRateDataChart() {
        $doseRateIndoor = IndoorMonitoring::select('time', 'dose_rate')
                            ->latest('time')
                            ->take(30)
                            ->get()
                            ->reverse()
                            ->values();
        $doseRateOutdoor = OutdoorMonitoring::select('time', 'dose_rate')
                            ->latest('time')
                            ->take(30)
                            ->get()
                            ->reverse()
                            ->values();

        return response()->json([
            'dose_rate_outdoor' => $doseRateOutdoor,
            'dose_rate_indoor' => $doseRateIndoor
        ]);
    }
}
