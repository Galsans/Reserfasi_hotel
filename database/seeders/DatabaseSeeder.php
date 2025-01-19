<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rooms;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);


        // Rooms::create([
        //     "no_room" => '10202',
        //     "facilities" => 'lorem ipsum dolor sit emet',
        //     "type_room" => 'deluxe',
        //     "price" => '200000',
        //     "status" => 'tersedia',
        //     "img" => 'public/rooms/UZle6uk2pw2CQFd2OnHqYilLFIx6Lv05zid2bS7W.jpg',
        // ]);
        $this->call(RoomSeeder::class);
    }
}
