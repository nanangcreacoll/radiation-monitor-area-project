<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
}
