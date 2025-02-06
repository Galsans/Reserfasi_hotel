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
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kamar</label>
                        <input type="text" class="form-control"
                            value="Room {{ $rooms->no_room }} - {{ $rooms->type_room }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Check-in</label>
                        <input type="date" id="check_in" name="check_in" class="form-control"
                            value="{{ date('Y-m-d') }}" required disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Check-out</label>
                        <input type="date" id="check_out" name="check_out" class="form-control"
                            value="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga per Malam</label>
                        <input type="text" id="price_per_night" class="form-control"
                            value="Rp {{ number_format($rooms->price, 0, ',', '.') }}" disabled>
                        <input type="hidden" id="room_price" value="{{ $rooms->price }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Harga</label>
                        <input type="text" id="total_price" class="form-control"
                            value="Rp {{ number_format($rooms->price, 0, ',', '.') }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Tamu</label>
                        <input type="number" name="qty_person" class="form-control" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="confirm">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Konfirmasi Check Out</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Script untuk Menghitung Total Harga --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let checkIn = document.getElementById("check_in");
            let checkOut = document.getElementById("check_out");
            let roomPrice = document.getElementById("room_price").value;
            let totalPriceInput = document.getElementById("total_price");

            function calculateTotalPrice() {
                let checkInDate = new Date(checkIn.value);
                let checkOutDate = new Date(checkOut.value);
                let oneDay = 24 * 60 * 60 * 1000; // Konversi satu hari ke milidetik

                let diffDays = Math.round(Math.max(1, (checkOutDate - checkInDate) / oneDay)); // Minimal 1 hari
                let totalPrice = diffDays * roomPrice;

                totalPriceInput.value = "Rp " + new Intl.NumberFormat("id-ID").format(totalPrice);
            }

            checkIn.addEventListener("change", calculateTotalPrice);
            checkOut.addEventListener("change", calculateTotalPrice);
        });
    </script>
@endsection
