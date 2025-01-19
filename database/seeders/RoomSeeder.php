<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rooms;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [];
        $types = ['suite', 'deluxe', 'standard'];
        $statuses = ['tersedia', 'terisi'];

        for ($i = 1; $i <= 20; $i++) {
            $rooms[] = [
                'no_room' => str_pad($i, 3, '0', STR_PAD_LEFT), 
                'facilities' => json_encode(['Wi-Fi', 'TV', 'AC']),
                'type_room' => $types[array_rand($types)], 
                'price' => rand(500000, 2000000), 
                'status' => $statuses[array_rand($statuses)], 
                'img' => 'room-' . $i . '.jpg', 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // DB::table('rooms')->insert($rooms);
        foreach ($rooms as $room) {
            Rooms::create($room);
        }
    }
}
