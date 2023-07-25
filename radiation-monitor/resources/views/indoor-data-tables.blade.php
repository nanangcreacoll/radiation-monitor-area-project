@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <h1 class="h3 ml-3 mb-3 text-gray-800">Data Table</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Monitor Dalam</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Laju Dosis (&#181;Sv/jam)</th>
                            <th>Suhu (&#8451;)</th>
                            <th>Kelembapan (%)</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Waktu</th>
                            <th>Laju Dosis</th>
                            <th>Suhu</th>
                            <th>Kelembapan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->time }}</td>
                                <td>{{ $item->dose_rate }}</td>
                                <td>{{ $item->temperature }}</td>
                                <td>{{ $item->humidity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection