@extends('layouts.app')

@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div id="map" style="height: 500px; border-radius: 10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map with default coordinates (Lagos) and a more appropriate zoom level
            const map = L.map('map').setView([6.5244, 3.3792], 13); // Lagos coordinates and zoom level

            // Add a tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Example report data from Laravel
            const report = @json($report);

            // Create a feature group for all markers
            const markers = L.featureGroup().addTo(map);

            if (report.latitude && report.longitude) {
                var popupContent = `
                <div style="width: 150px;">
                    <img src="${report.captured_image}" alt="Report Image" style="width: 100%; height: auto; border-radius: 5px;"/>
                    <p><strong>Area:</strong> ${report.area}</p>
                    <p><strong>LGA:</strong> ${report.lga}</p>
                    <hr>
                    <p>
                        <strong>Status:</strong> ${report.status || 'Not Attended'}
                        <a href="/home/report/${report.id}">View Details</a>
                    </p>
                </div>
            `;

                // Create a marker for each report
                L.marker([report.latitude, report.longitude])
                    .addTo(markers)
                    .bindPopup(popupContent);
            }

            // Fit the map to the markers
            if (markers.getBounds().isValid()) {
                map.fitBounds(markers.getBounds());
            }
        });


    </script>

@endsection
