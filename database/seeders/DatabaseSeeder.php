<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Room;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ---- USERS ----
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'customer1@example.com',
            'password' => bcrypt('password123'),
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'sama@example.com',
            'password' => bcrypt('password123'),
        ]);

        // ---- ROOMS ----
        $room1 = Room::create([
            'name' => 'Deluxe Room',
            'description' => 'A luxurious room with a king-size bed, ensuite bathroom, and city view.',
            'price' => 150.00,
            'status' => 'available',
            'image' => 'deluxe_room.jpg',
        ]);

        $room2 = Room::create([
            'name' => 'Standard Room',
            'description' => 'A comfortable room with a queen-size bed and basic amenities.',
            'price' => 100.00,
            'status' => 'available',
            'image' => 'standard_room.jpg',

        ]);

        $room3 = Room::create([
            'name' => 'Suite',
            'description' => 'A spacious suite with a living area, kitchenette, and premium furnishings.',
            'price' => 250.00,
            'status' => 'unavailable',
            'image' => 'suite_room.jpg',
        ]);

        // ---- BOOKINGS ----
        Booking::create([
            'id_user' => $user1->id,
            'id_room' => $room1->id_room,
            'date' => now()->addDay()->toDateString(),
            'start_time' => '09:00:00',
            'end_time' => '11:00:00',
            'status' => 'confirmed','id_user' => 1,
            'id_room' => 1,
            'start_time' => '2023-10-01 10:00:00',
            'end_time' => '2023-10-01 12:00:00',
            'status' => 'confirmed',
        ]);

        Booking::create([
            'name' => 'Suite',
            'description' => 'A spacious suite with a living area, kitchenette, and premium furnishings.',
            'price' => 250.00,
            'status' => 'unavailable',
            'image' => 'suite_room.jpg',
        ]);
    }
}
