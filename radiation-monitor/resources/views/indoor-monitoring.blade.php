@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 ml-3 mb-1 text-gray-800">
            Monitor Dalam
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
                                Laju Dosis</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">
                                <text id="indoor-dose-rate">
                                    {{ trim(json_encode($latestData->original['dose_rate']),'"') }}
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
                                Suhu</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">
                                <text id="indoor-temperature">
                                    {{ trim(json_encode($latestData->original['temperature']),'"')  }}
                                </text>
                                <sup class="font-weight-normal">&#8451;</sup>
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
                                Kelembapan</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">
                                <text id="indoor-humidity">
                                    {{ trim(json_encode($latestData->original['humidity']),'"')  }}
                                </text>
                                <sup class="font-weight-normal">%</sup>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">Laju Dosis</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="indoor-dose-rate-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-success">Suhu</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="indoor-temperature-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Kelembapan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="indoor-humidity-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection