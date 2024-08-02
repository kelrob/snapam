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
                        <a target="_blank" href="{{ config('app.url') }}/#contact" class="btn btn-dark btn-sm">Add New
                            Report</a>
                        &nbsp;
                        <a href="#" class="btn btn-success btn-sm">View All Report</a>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">{{ __('Reports Dashboard') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <p><b>{{ count($reports) }}</b> available reports in <b>Table</b></p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Waste Type</th>
                                            <th>LGA</th>
                                            <th>Area</th>
                                            <th>Longitude</th>
                                            <th>Latitude</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reports as $report)
                                            <tr>
                                                <td>{{ $report->id }}</td>
                                                <td><a target="_blank"
                                                       href="{{ config('app.url') . '/' .$report->captured_image }}">View
                                                        Image</a></td>
                                                <td>{{ $report->waste_type }}</td>
                                                <td>{{ $report->lga }}</td>
                                                <td>{{ $report->area }}</td>
                                                <td>{{ $report->longitude }}</td>
                                                <td>{{ $report->latitude }}</td>
                                                <td>{{ $report->phone_number }}</td>
                                                <td>{{ $report->status }}</td>
                                                <td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                                type="button" id="dropdownMenuButton{{ $report->id }}"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                            &#8942;
                                                        </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton{{ $report->id }}">
                                                            <li>
                                                                <form
                                                                    action="{{ route('home.report.updateAction', $report) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="action" value="assigned">
                                                                    <button type="submit" class="dropdown-item">Mark as
                                                                        Assigned
                                                                    </button>
                                                                </form>

                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('home.report.updateAction', $report) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="action" value="cleanup">
                                                                    <button type="submit" class="dropdown-item">Cleanup
                                                                        in Progress
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('home.report.updateAction', $report) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="action"
                                                                           value="completed">
                                                                    <button type="submit" class="dropdown-item">Mark as
                                                                        Completed
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $reports->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
