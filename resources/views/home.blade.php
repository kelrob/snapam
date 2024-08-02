@extends('layouts.app')

@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-10">
                @if($lga || $area)
                    <h3>Showing results of {{ $lga ?: $area }}</h3>
                @endif
                <div class="row">
                    <div class="col-lg-6">
                        <form action="" method="GET" class="mb-2">
                            <label for="filter_lga">Filter by LGA</label>
                            <select id="filter_lga" required name="lga" style="width: 30%;">
                                <option value="">Please Select
                                <option value="All">All</option>
                                <option value="Agege">Agege</option>
                                <option value="Ajeromi-Ifelodun">Ajeromi-Ifelodun</option>
                                <option value="Alimosho">Alimosho</option>
                                <option value="Amuwo-Odofin">Amuwo-Odofin</option>
                                <option value="Apapa">Apapa</option>
                                <option value="Badagry">Badagry</option>
                                <option value="Epe">Epe</option>
                                <option value="Eti-Osa">Eti-Osa</option>
                                <option value="Ibeju-Lekki">Ibeju-Lekki</option>
                                <option value="Ikeja">Ikeja</option>
                                <option value="Ikorodu">Ikorodu</option>
                                <option value="Ilaje">Ilaje</option>
                                <option value="Isolo">Isolo</option>
                                <option value="Kosofe">Kosofe</option>
                                <option value="Lagos Island">Lagos Island</option>
                                <option value="Lagos Mainland">Lagos Mainland</option>
                                <option value="Mushin">Mushin</option>
                                <option value="Ojo">Ojo</option>
                                <option value="Oshodi-Isolo">Oshodi-Isolo</option>
                                <option value="Somolu">Somolu</option>
                                <option value="Surulere">Surulere</option>
                            </select>
                            <input type="submit" class="btn btn-primary btn-sm">
                        </form>
                        <form action="" method="GET" class="mb-2">
                            <label for="filter_lga">Search by Area</label>
                            <input type="search" placeholder="area" name="area">
                            <input type="submit" class="btn btn-primary btn-sm">
                        </form>
                    </div>
                    <div class="col-lg-6 text-right" align="right">
                        <a target="_blank" href=" {{ config('app.url') }}/#contact" class="btn btn-dark btn-sm">Add New
                            Report</a>
                        &nbsp;
                        <a href="{{ route('home.report') }}" class="btn btn-success btn-sm">View All Report</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Reports Dashboard') }}</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <p><b>{{count($reports)}}</b> available reports marked with <b>GPS Markers</b></p>
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(count($reports) > 0)
                            <div id="map" style="height: 400px; border-radius: 10px;"></div>
                        @else
                            No Report
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map with default coordinates (Lagos) and a more appropriate zoom level
            var map = L.map('map').setView([6.5244, 3.3792], 13); // Lagos coordinates and zoom level

            // Add a tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Example report data from Laravel
            var reports = @json($reports); // Assuming $reports is passed to the view

            // Create a feature group for all markers
            var markers = L.featureGroup().addTo(map);

            reports.forEach(function (report) {
                // Ensure latitude and longitude are valid
                if (report.latitude && report.longitude) {
                    // Create a marker for each report
                    L.marker([report.latitude, report.longitude])
                        .addTo(markers)
                        .bindPopup('<b>' + report.area + '</b><br>' + report.lga);
                }
            });

            // Fit the map to the markers
            if (markers.getBounds().isValid()) {
                map.fitBounds(markers.getBounds());
            }
        });

    </script>

@endsection
