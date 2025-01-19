@extends('dashboard.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    {{-- <i class="mdi mdi-home"></i> --}}
                    <i class="fa fa-hotel"></i>
                </span> <a href="{{ route('rooms.index') }}" class="text-dark text-decoration-none">Rooms</a>

            </h3>
        </div>
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title mb-4 text-center">Room Details</h4>

                    <!-- Room Image -->
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ Storage::url($rooms->img) }}" alt="Room Image"
                                class="img-fluid rounded shadow-sm mb-4 w-100">
                        </div>
                    </div>

                    <!-- Room Information -->
                    <div class="col-12">
                        <!-- Styling for alignment -->
                        <style>
                            .details-row {
                                display: flex;
                                align-items: center;
                                margin-bottom: 1rem;
                            }

                            .details-label {
                                width: 120px;
                                /* Adjust width for alignment */
                                font-weight: bold;
                            }

                            .details-value {
                                flex: 1;
                            }

                            .details-icon {
                                margin-right: 1rem;
                                font-size: 1.25rem;
                            }
                        </style>

                        <!-- Room Number -->
                        <div class="details-row">
                            <i class="mdi mdi-door text-primary details-icon"></i>
                            <div class="details-label">Room No</div>
                            <div class="details-value">: {{ $rooms->no_room }}</div>
                        </div>

                        <!-- Room Type -->
                        <div class="details-row">
                            <i class="mdi mdi-bed-outline text-success details-icon"></i>
                            <div class="details-label">Type</div>
                            <div class="details-value">: {{ $rooms->type_room }}</div>
                        </div>

                        <!-- Room Price -->
                        <div class="details-row">
                            <i class="mdi mdi-cash-multiple text-warning details-icon"></i>
                            <div class="details-label">Price</div>
                            <div class="details-value">: Rp. {{ number_format($rooms->price, 0, ',', '.') }}</div>
                        </div>

                        <!-- Room Status -->
                        <div class="details-row">
                            <i class="mdi mdi-check-circle-outline text-success details-icon"></i>
                            <div class="details-label">Status</div>
                            <div class="details-value">: {{ $rooms->status }}</div>
                        </div>

                        <!-- Room Facilities -->
                        <div class="details-row">
                            <i class="mdi mdi-clipboard-text-outline text-muted details-icon"></i>
                            <div class="details-label">Facilities</div>
                            <div class="details-value">
                                @php
                                    $facilities = json_decode($rooms->facilities, true);

                                @endphp
                                @if (!empty($facilities))
                                    <ul>
                                        @foreach ($facilities as $facility)
                                            <li>{{ $facility }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>Facilities not available</span>
                                @endif

                            </div>
                        </div>
                    </div>


                    <!-- Action Buttons -->
                    <div class="mt-4 text-center">
                        <a href="/book/{{ $rooms->id }}" class="btn btn-primary btn-lg me-2">
                            <i class="mdi mdi-calendar-check me-2"></i>Book Now
                        </a>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary btn-lg">
                            <i class="mdi mdi-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
