@extends('dashboard.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="fa fa-cash-register"></i>
                </span> Checkout - Hotel Reservation
            </h3>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-4">Detail Pemesanan</h4>

                <form action="#" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Kode Booking</label>
                        <input type="text" class="form-control" value="{{ $kode_bookings }}" disabled>
                        <input type="text" name="" value="{{ $rooms->id }}" id="">
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" value="{{ $rooms->user_id }}" disabled>
                    </div> --}}

                    <div class="mb-3">
                        <label class="form-label">Kamar</label>
                        <input type="text" class="form-control"
                            value="Room {{ $rooms->no_room }} - {{ $rooms->type_room }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Check-in</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Check-out</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="input" class="form-control" value="Rp {{ number_format($rooms->price, 0, ',', '.') }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Tamu</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Harga Permalam</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="confirm">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <a href="#" class="btn btn-success">Konfirmasi Check Out</a>
                    {{-- <button type="submit" class="btn btn-success">Konfirmasi Check-out</button> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
