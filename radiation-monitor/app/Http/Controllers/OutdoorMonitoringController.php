<?php

namespace App\Http\Controllers;

use App\Models\IndoorMonitoring;
use App\Models\OutdoorMonitoring;
use Illuminate\Http\Request;

class OutdoorMonitoringController extends Controller
{
    public function index() {
        return view('outdoor-monitoring', [
            "title" => "Monitor Utama",
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

        return response()->json([
            $data
        ]);
    }
}
