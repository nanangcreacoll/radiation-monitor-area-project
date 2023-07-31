@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 ml-3 mb-1 text-gray-800">
                Dashboard
            </h1>
            <div class="d-none d-sm-inline-block shadow-sm">
                <p class="mr-3 ml-3 mb-2 mt-2">
                    {{ $currentDay }}, {{ $currentDate }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-2">
                                    Laju Dosis Monitor Utama</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <text id="outdoor-dose-rate">
                                        {{ trim(json_encode($latestDoseRate->original['doseRateOutdoor']->dose_rate),'"')  }}
                                    </text>
                                    <sup class="font-weight-normal">&#181;Sv/jam</sup>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-2">
                                    Laju Dosis Monitor Dalam</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <text id="indoor-dose-rate">
                                        {{ trim(json_encode($latestDoseRate->original['doseRateIndoor']->dose_rate),'"')  }}
                                    </text>
                                    <sup class="font-weight-normal">&#181;Sv/jam</sup>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-2">
                                    Laju Dosis Tertinggi</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <text id="highest-dose-rate">
                                        {{ trim(json_encode($highestDoseRate->original['highest_dose_rate']),'"') }}
                                    </text>
                                    <sup class="font-weight-normal">&#181;Sv/jam</sup>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-info">Laju Dosis</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="dose-rate-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection