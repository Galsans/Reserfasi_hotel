<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms Available</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Pojok Kanan Atas -->
    <div class="absolute top-4 right-4">
        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <span class="text-sm font-semibold text-gray-600">Halo, {{ Auth::user()->name }}</span>
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-blue-600 hover:underline">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-blue-600 hover:underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-semibold text-blue-600 hover:underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <!-- Konten Utama -->
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Kamar Tersedia</h1>

        @if ($rooms->isEmpty())
            <p class="text-center">Tidak ada kamar yang tersedia saat ini.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($rooms as $room)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-2">Kamar {{ $room->no_room }}</h2>
                        <p><strong>Tipe:</strong> {{ ucfirst($room->type_room) }}</p>
                        <p><strong>Harga:</strong> Rp{{ number_format($room->price, 0, ',', '.') }}</p>
                        <p><strong>Fasilitas:</strong></p>
                        <ul class="list-disc ml-6">
                            @php
                                $facilities = json_decode($room->facilities, true);
                            @endphp
                            @foreach ($facilities as $facility)
                                <li>{{ $facility }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
