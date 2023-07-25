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

        $latestDoseRate = $this->getLatestDoseRate();

        return view('dashboard', [
            "title" => "Dashboard",
            "currentDate" => $currentDate,
            "currentDay" => $currentDay,
            'latestDoseRate' => $latestDoseRate
        ]);
    }

    public function getDoseRateChart() {
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
            'doseRateOutdoor' => $doseRateOutdoor,
            'doseRateIndoor' => $doseRateIndoor
        ]);
    }

    public function getLatestDoseRate() {
        $doseRateOutdoor = OutdoorMonitoring::latest('time')->first();
        $doseRateIndoor = IndoorMonitoring::latest('time')->first();

        return response()->json([
            'doseRateOutdoor' => $doseRateOutdoor,
            'doseRateIndoor' => $doseRateIndoor
        ]);
    }
}
