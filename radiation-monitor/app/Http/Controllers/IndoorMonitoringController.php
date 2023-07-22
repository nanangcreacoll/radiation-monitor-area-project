<?php

namespace App\Http\Controllers;

use App\Models\IndoorMonitoring;
use Illuminate\Http\Request;

class IndoorMonitoringController extends Controller
{
    public function index() {
        return view('indoor-monitoring', [
            "title" => "Monitor Dalam",
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
}
