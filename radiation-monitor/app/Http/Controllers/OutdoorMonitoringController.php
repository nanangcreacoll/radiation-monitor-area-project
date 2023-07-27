<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\IndoorMonitoring;
use App\Models\OutdoorMonitoring;

class OutdoorMonitoringController extends Controller
{
    public function index() {
        $currentDate = Carbon::now()->isoFormat('D MMMM YYYY');
        $currentDay = Carbon::now()->isoFormat('dddd');
        $latestData = $this->getLatestData();
        
        return view('outdoor-monitoring', [
            "title" => "Monitor Utama",
            "currentDate" => $currentDate,
            "currentDay" => $currentDay,
            "latestData" => $latestData
        ]);
    }

    public function tables() {
        $data = $this->getTablesData();

        return view('outdoor-data-tables', [
            "title" => "Minitor Utama Data Tables",
            "data" => $data
        ]);
    }

    public function storeData(Request $request) {
        $data = new OutdoorMonitoring();
        $data->temperature =  $request->input('temperature');
        $data->humidity = $request->input('humidity');
        $data->dose_rate = $request->input('dose_rate');
        $data->save();

        return response()->json([
            'message' => 'Data store succesfully.'
        ]);
    }

    public function fetchDataIndoorMonitor() {
        $data = IndoorMonitoring::latest('time')->first();
        return response()->json($data);
    }

    public function getLatestData() {
        $data = OutdoorMonitoring::latest('time')->first();
        return response()->json($data);
    }

    public function getTablesData() {
        $data = OutdoorMonitoring::all();
        return $data;
    }
    
    public function getDataChart() {
        $data = OutdoorMonitoring::latest('time')
                ->take(30)
                ->get()
                ->reverse()
                ->values();
        return response()->json($data);
    }
}
