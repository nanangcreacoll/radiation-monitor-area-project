<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\IndoorMonitoring;

class IndoorMonitoringController extends Controller
{
    public function index() {
        $currentDate = Carbon::now()->isoFormat('D MMMM YYYY');
        $currentDay = Carbon::now()->isoFormat('dddd');
        $latestData = $this->getLatestData();

        return view('indoor-monitoring', [
            "title" => "Monitor Dalam",
            "currentDate" => $currentDate,
            "currentDay" => $currentDay,
            "latestData" => $latestData
        ]);
    }

    public function tables() {
        $data = $this->getTablesData();

        return view('indoor-data-tables', [
            "title" => "Minitor Dalam Data Tables",
            "data" => $data
        ]);
    }

    public function storeData(Request $request) {
        $data = new IndoorMonitoring();
        $data->temperature =  $request->input('temperature');
        $data->humidity = $request->input('humidity');
        $data->dose_rate = $request->input('dose_rate');
        $data->save();

        return response()->json([
            'message' => 'Data store succesfully.'
        ]);
    }

    public function getLatestData() {
        $data = IndoorMonitoring::latest('time')->first();
        return response()->json($data);
    }

    public function getTablesData() {
        $data = IndoorMonitoring::all();

        return $data;
    }

    public function getDataChart() {
        $data = IndoorMonitoring::latest('time')
                ->take(30)
                ->get()
                ->reverse()
                ->values();
        return response()->json($data);
    }
}
