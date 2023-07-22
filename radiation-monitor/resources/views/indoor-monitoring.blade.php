@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 ml-3 mb-3 text-gray-800">Dashboard</h1>

        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-2">
                                    Laju Dosis Monitor Utama</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <text id="temperature-data">
                                        20
                                    </text>
                                    <sup class="font-weight-normal">&#181;Sv/jam</sup>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text font-weight-bold text-info text-uppercase mb-2">
                                    Laju Dosis Monitor Dalam</div>
                                <div class="h3 mb-0 font-weight-bold text-gray-800">
                                    <text id="temperature-data">
                                        20
                                    </text>
                                    <sup class="font-weight-normal">&#181;Sv/jam</sup>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection