@extends('layouts.app')

@section('content')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3>Report view</h3>
                <div class="card mt-4">
                    <div class="card-header">{{ __('Reports Dashboard') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12" align="center">
                                <img src="{{ $reportInfo->captured_image }}"
                                     class="img-fluid"
                                     style="max-height: 400px; border-radius: 10px;" alt="">
                            </div>
                            <div class="col-lg-12 mt-4" align="">
                                <p>
                                    <b> Address:</b> <br/>
                                    {{$reportInfo->address ?? 'N/A'}}
                                </p>

                                <p>
                                    <b> Area:</b> <br/>
                                    {{$reportInfo->area ?? 'N/A'}}
                                </p>

                                <p>
                                    <b> LGA:</b> <br/>
                                    {{$reportInfo->lga ?? 'N/A'}}
                                </p>

                                <p>
                                    <b> Location:</b> <br/>
                                    <a href="/home/map/{{$reportInfo->id}}">Open
                                        in
                                        Google
                                        Map</a>
                                </p>

                                <p>
                                    <b> Type of Waste:</b> <br/>
                                    {{$reportInfo->waste_type ?? 'N/A'}}
                                </p>

                                <p>
                                    <b> Reporter Tel:</b> <br/>
                                    {{$reportInfo->phone ?? 'N/A'}}
                                </p>

                                <p>
                                    <b> Status:</b> <br/>
                                    {{$reportInfo->status ?? 'N/A'}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
